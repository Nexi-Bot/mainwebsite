<?php
require_once '../includes/config.php';
require_once '../includes/database.php';

// Set content type and disable output buffering
header('Content-Type: application/json');
ob_start();

try {
    // Initialize Stripe
    require_once '../vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    // Get webhook payload
    $payload = file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
    
    // You'll need to set this in your Stripe webhook settings in the Stripe Dashboard
    $endpoint_secret = STRIPE_WEBHOOK_SECRET; // Now using config constant

    try {
        // Verify webhook signature
        $event = \Stripe\Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
    } catch (\UnexpectedValueException $e) {
        // Invalid payload
        http_response_code(400);
        echo json_encode(['error' => 'Invalid payload']);
        exit;
    } catch (\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        http_response_code(400);
        echo json_encode(['error' => 'Invalid signature']);
        exit;
    }

    // Handle the event
    switch ($event['type']) {
        case 'payment_intent.succeeded':
            handlePaymentSuccess($event['data']['object']);
            break;
        
        case 'invoice.payment_succeeded':
            handleSubscriptionRenewal($event['data']['object']);
            break;
        
        case 'customer.subscription.deleted':
            handleSubscriptionCancellation($event['data']['object']);
            break;
        
        default:
            // Unhandled event type
            error_log('Unhandled event type: ' . $event['type']);
    }

    echo json_encode(['status' => 'success']);

} catch (Exception $e) {
    error_log('Webhook error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
}

function handlePaymentSuccess($payment_intent) {
    global $db;
    
    $discord_user_id = $payment_intent->metadata->discord_user_id ?? null;
    $premium_type = $payment_intent->metadata->premium_type ?? null;
    $purchase_type = $payment_intent->metadata->purchase_type ?? 'user';
    
    if (!$discord_user_id || !$premium_type) {
        error_log('Missing metadata in payment intent: ' . $payment_intent->id);
        return;
    }

    try {
        // Calculate expiration date
        $expires_at = null;
        if ($premium_type === 'monthly') {
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 month'));
        } elseif ($premium_type === 'yearly') {
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 year'));
        }
        // lifetime = null (never expires)

        // Update user premium status
        $db->query(
            "UPDATE users SET 
                premium = TRUE,
                premium_type = ?,
                premium_expires_at = ?,
                stripe_customer_id = ?,
                updated_at = NOW()
            WHERE user_id = ?",
            [
                $premium_type,
                $expires_at,
                $payment_intent->customer ?? null,
                $discord_user_id
            ]
        );

        // Log the successful purchase
        error_log("Premium activated for user {$discord_user_id}: {$premium_type}");
        
        // Send webhook notification to Discord (optional)
        sendDiscordNotification($discord_user_id, $premium_type, $payment_intent->amount_received);

    } catch (Exception $e) {
        error_log("Failed to update user premium status: " . $e->getMessage());
    }
}

function handleSubscriptionRenewal($invoice) {
    global $db;
    
    $customer_id = $invoice->customer;
    
    try {
        // Find user by Stripe customer ID
        $user = $db->fetch(
            "SELECT user_id, premium_type FROM users WHERE stripe_customer_id = ?",
            [$customer_id]
        );
        
        if ($user) {
            // Calculate new expiration date
            $expires_at = null;
            if ($user['premium_type'] === 'monthly') {
                $expires_at = date('Y-m-d H:i:s', strtotime('+1 month'));
            } elseif ($user['premium_type'] === 'yearly') {
                $expires_at = date('Y-m-d H:i:s', strtotime('+1 year'));
            }
            
            // Update expiration date
            $db->query(
                "UPDATE users SET premium_expires_at = ?, updated_at = NOW() WHERE user_id = ?",
                [$expires_at, $user['user_id']]
            );
            
            error_log("Premium renewed for user {$user['user_id']}: {$user['premium_type']}");
        }
        
    } catch (Exception $e) {
        error_log("Failed to handle subscription renewal: " . $e->getMessage());
    }
}

function handleSubscriptionCancellation($subscription) {
    global $db;
    
    $customer_id = $subscription->customer;
    
    try {
        // Set premium to false when subscription is cancelled
        $db->query(
            "UPDATE users SET premium = FALSE, updated_at = NOW() WHERE stripe_customer_id = ?",
            [$customer_id]
        );
        
        error_log("Premium cancelled for customer: {$customer_id}");
        
    } catch (Exception $e) {
        error_log("Failed to handle subscription cancellation: " . $e->getMessage());
    }
}

function sendDiscordNotification($user_id, $premium_type, $amount_paid) {
    $webhook_url = WEBHOOK_URL;
    
    $amount_pounds = $amount_paid / 100;
    $embed = [
        'title' => '💎 New Premium Purchase!',
        'description' => "User <@{$user_id}> purchased **{$premium_type}** premium for £{$amount_pounds}",
        'color' => 0xF97316, // Orange color
        'timestamp' => date('c'),
        'fields' => [
            [
                'name' => 'Plan Type',
                'value' => ucfirst($premium_type),
                'inline' => true
            ],
            [
                'name' => 'Amount',
                'value' => "£{$amount_pounds}",
                'inline' => true
            ],
            [
                'name' => 'User ID',
                'value' => $user_id,
                'inline' => true
            ]
        ]
    ];
    
    $data = [
        'embeds' => [$embed]
    ];
    
    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}
?>
