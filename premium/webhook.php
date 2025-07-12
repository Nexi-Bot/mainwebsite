<?php
require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/includes/database.php';

// Set content type and disable output buffering
header('Content-Type: application/json');
ob_start();

// Check if this is a POST request (webhooks are always POST)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed. Webhooks must be POST requests.']);
    exit;
}

try {
    // Initialize Stripe
    require_once dirname(__DIR__) . '/vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    // Initialize database connection
    $db = new Database();

    // Get webhook payload
    $payload = file_get_contents('php://input');
    $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';
    
    // Check if we have the required signature header
    if (!$sig_header) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing Stripe signature header']);
        exit;
    }
    
    // Check if we have payload
    if (!$payload) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing payload']);
        exit;
    }
    
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
            handleInvoicePaymentSuccess($event['data']['object']);
            break;
        
        case 'customer.subscription.deleted':
            handleSubscriptionCancellation($event['data']['object']);
            break;
            
        case 'customer.subscription.updated':
            handleSubscriptionUpdate($event['data']['object']);
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
        // Only handle lifetime payments here (subscriptions are handled in invoice.payment_succeeded)
        if ($purchase_type === 'lifetime') {
            // Update user premium status for lifetime
            $db->query(
                "UPDATE users SET 
                    premium_status = 'active',
                    premium_type = 'lifetime',
                    premium_expires_at = NULL,
                    stripe_customer_id = ?,
                    premium_billing_amount = ?,
                    updated_at = NOW()
                WHERE user_id = ?",
                [
                    $payment_intent->customer ?? null,
                    $payment_intent->amount,
                    $discord_user_id
                ]
            );

            // Record payment
            $db->query(
                "INSERT INTO payments (user_id, stripe_payment_intent_id, amount_paid, plan_type, status, created_at) 
                 VALUES (?, ?, ?, ?, 'completed', NOW())",
                [
                    $discord_user_id,
                    $payment_intent->id,
                    $payment_intent->amount,
                    'lifetime'
                ]
            );

            error_log("Lifetime premium activated for user: {$discord_user_id}");
        }

    } catch (Exception $e) {
        error_log("Failed to process payment success for {$discord_user_id}: " . $e->getMessage());
    }
}

function handleInvoicePaymentSuccess($invoice) {
    global $db;
    
    // This handles subscription payments (both initial and recurring)
    $subscription_id = $invoice->subscription ?? null;
    
    if (!$subscription_id) {
        return; // Not a subscription payment
    }

    try {
        // Get subscription details from Stripe
        require_once '../vendor/autoload.php';
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
        
        $subscription = \Stripe\Subscription::retrieve($subscription_id);
        
        $discord_user_id = $subscription->metadata->discord_user_id ?? null;
        $premium_type = $subscription->metadata->premium_type ?? null;
        
        if (!$discord_user_id || !$premium_type) {
            error_log('Missing metadata in subscription: ' . $subscription_id);
            return;
        }

        // Calculate next billing date
        $next_billing = date('Y-m-d H:i:s', $subscription->current_period_end);
        
        // Update user premium status
        $db->query(
            "UPDATE users SET 
                premium_status = 'active',
                premium_type = ?,
                premium_expires_at = ?,
                stripe_customer_id = ?,
                stripe_subscription_id = ?,
                premium_billing_amount = ?,
                updated_at = NOW()
            WHERE user_id = ?",
            [
                $premium_type,
                $next_billing,
                $subscription->customer,
                $subscription_id,
                $invoice->amount_paid,
                $discord_user_id
            ]
        );

        // Record payment
        $db->query(
            "INSERT INTO payments (user_id, stripe_payment_intent_id, stripe_subscription_id, amount_paid, plan_type, status, created_at) 
             VALUES (?, ?, ?, ?, ?, 'completed', NOW())",
            [
                $discord_user_id,
                $invoice->payment_intent,
                $subscription_id,
                $invoice->amount_paid,
                $premium_type
            ]
        );

        error_log("Subscription payment processed for user: {$discord_user_id}, type: {$premium_type}");

    } catch (Exception $e) {
        error_log("Failed to process subscription payment for {$subscription_id}: " . $e->getMessage());
    }
}

function handleSubscriptionUpdate($subscription) {
    global $db;
    
    $discord_user_id = $subscription->metadata->discord_user_id ?? null;
    
    if (!$discord_user_id) {
        return;
    }

    try {
        // Update subscription details in database
        $next_billing = date('Y-m-d H:i:s', $subscription->current_period_end);
        
        $db->query(
            "UPDATE users SET 
                premium_expires_at = ?,
                updated_at = NOW()
            WHERE user_id = ?",
            [
                $next_billing,
                $discord_user_id
            ]
        );

        error_log("Subscription updated for user: {$discord_user_id}");

    } catch (Exception $e) {
        error_log("Failed to handle subscription update: " . $e->getMessage());
    }
}

function handleSubscriptionCancellation($subscription) {
    global $db;
    
    $discord_user_id = $subscription->metadata->discord_user_id ?? null;
    
    if (!$discord_user_id) {
        return;
    }
    
    try {
        // Set premium status to cancelled when subscription is cancelled
        $db->query(
            "UPDATE users SET 
                premium_status = 'cancelled',
                updated_at = NOW() 
            WHERE user_id = ?",
            [$discord_user_id]
        );
        
        error_log("Premium cancelled for user: {$discord_user_id}");
        
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
