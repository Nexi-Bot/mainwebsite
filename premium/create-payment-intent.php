<?php
session_start();
require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/includes/database.php';

// Set content type to JSON
header('Content-Type: application/json');

// Check if user is authenticated
if (!isset($_SESSION['discord_user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

// Get request data
$input = json_decode(file_get_contents('php://input'), true);
$plan = $input['plan'] ?? null;
$coupon = $input['coupon'] ?? null;
$email = $input['email'] ?? null;
$full_name = $input['full_name'] ?? null;
$postcode = $input['postcode'] ?? null;

// Validate required fields
if (!$plan) {
    http_response_code(400);
    echo json_encode(['error' => 'Plan is required']);
    exit;
}

if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Valid email address is required']);
    exit;
}

if (!$full_name || strlen(trim($full_name)) < 2) {
    http_response_code(400);
    echo json_encode(['error' => 'Full name is required']);
    exit;
}

if (!$postcode || strlen(trim($postcode)) < 3) {
    http_response_code(400);
    echo json_encode(['error' => 'Valid postcode is required']);
    exit;
}

// Validate plan
if (!in_array($plan, ['monthly', 'yearly', 'lifetime'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid plan selected']);
    exit;
}

// Plan configuration with presale and regular pricing
$plans = [
    'monthly' => [
        'presale_amount' => 299,   // £2.99 first month
        'regular_amount' => 499,   // £4.99 recurring
        'currency' => 'gbp',
        'interval' => 'month',
        'description' => 'Nexi Premium Monthly'
    ],
    'yearly' => [
        'presale_amount' => 2400,  // £24 first year
        'regular_amount' => 3500,  // £35 recurring
        'currency' => 'gbp',
        'interval' => 'year',
        'description' => 'Nexi Premium Yearly'
    ],
    'lifetime' => [
        'presale_amount' => 7900,  // £79 one-time
        'regular_amount' => 7900,  // Same (lifetime)
        'currency' => 'gbp',
        'interval' => null,        // No recurring
        'description' => 'Nexi Premium Lifetime'
    ]
];

$selected_plan = $plans[$plan];
$user = $_SESSION['discord_user'];

try {
    // Initialize Stripe
    require_once dirname(__DIR__) . '/vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    if ($plan === 'lifetime') {
        // Handle lifetime payment (one-time payment)
        $payment_intent_data = [
            'amount' => $selected_plan['presale_amount'],
            'currency' => $selected_plan['currency'],
            'description' => $selected_plan['description'],
            'receipt_email' => $email,
            'metadata' => [
                'discord_user_id' => $user['id'],
                'discord_username' => $user['username'],
                'premium_type' => $plan,
                'purchase_type' => 'lifetime',
                'customer_name' => $full_name,
                'postcode' => $postcode
            ]
        ];

        // Apply coupon if provided
        if ($coupon) {
            try {
                $coupon_obj = \Stripe\Coupon::retrieve($coupon);
                if ($coupon_obj->valid) {
                    $payment_intent_data['discounts'] = [['coupon' => $coupon]];
                }
            } catch (Exception $e) {
                // Invalid coupon, continue without it
            }
        }

        $payment_intent = \Stripe\PaymentIntent::create($payment_intent_data);

        echo json_encode([
            'clientSecret' => $payment_intent->client_secret,
            'type' => 'payment'
        ]);

    } else {
        // Handle subscription (monthly/yearly) with presale pricing
        
        // First, create or get customer
        $customer_data = [
            'email' => $email,
            'name' => $full_name,
            'metadata' => [
                'discord_id' => $user['id'],
                'discord_username' => $user['username'],
                'postcode' => $postcode
            ]
        ];

        // Check if customer already exists by email
        $existing_customers = \Stripe\Customer::all([
            'email' => $email,
            'limit' => 1
        ]);

        if (count($existing_customers->data) > 0) {
            $customer = $existing_customers->data[0];
            // Update customer with new information
            \Stripe\Customer::update($customer->id, [
                'name' => $full_name,
                'metadata' => $customer_data['metadata']
            ]);
        } else {
            $customer = \Stripe\Customer::create($customer_data);
        }

        // Create prices for presale and regular billing
        $presale_price = \Stripe\Price::create([
            'unit_amount' => $selected_plan['presale_amount'],
            'currency' => $selected_plan['currency'],
            'recurring' => [
                'interval' => $selected_plan['interval'],
                'interval_count' => 1
            ],
            'product_data' => [
                'name' => "Nexi Premium {$plan} - Presale",
                'metadata' => [
                    'type' => 'presale',
                    'plan' => $plan
                ]
            ]
        ]);

        $regular_price = \Stripe\Price::create([
            'unit_amount' => $selected_plan['regular_amount'],
            'currency' => $selected_plan['currency'],
            'recurring' => [
                'interval' => $selected_plan['interval'],
                'interval_count' => 1
            ],
            'product_data' => [
                'name' => "Nexi Premium {$plan} - Regular",
                'metadata' => [
                    'type' => 'regular',
                    'plan' => $plan
                ]
            ]
        ]);

        // Create subscription with presale price
        $subscription_data = [
            'customer' => $customer->id,
            'items' => [
                ['price' => $presale_price->id]
            ],
            'metadata' => [
                'discord_user_id' => $user['id'],
                'discord_username' => $user['username'],
                'premium_type' => $plan,
                'regular_price_id' => $regular_price->id,
                'transition_date' => $plan === 'monthly' ? '2025-08-20' : '2026-07-20'
            ],
            'payment_behavior' => 'default_incomplete',
            'payment_settings' => [
                'save_default_payment_method' => 'on_subscription'
            ],
            'expand' => ['latest_invoice.payment_intent']
        ];

        // Apply coupon if provided
        if ($coupon) {
            try {
                $coupon_obj = \Stripe\Coupon::retrieve($coupon);
                if ($coupon_obj->valid) {
                    $subscription_data['coupon'] = $coupon;
                }
            } catch (Exception $e) {
                // Invalid coupon, continue without it
            }
        }

        $subscription = \Stripe\Subscription::create($subscription_data);

        echo json_encode([
            'clientSecret' => $subscription->latest_invoice->payment_intent->client_secret,
            'subscriptionId' => $subscription->id,
            'type' => 'subscription'
        ]);
    }

} catch (Exception $e) {
    error_log('Payment creation failed: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create payment. Please try again later.']);
}
?>
