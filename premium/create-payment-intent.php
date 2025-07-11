<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/database.php';

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

// Validate plan
if (!in_array($plan, ['monthly', 'yearly', 'lifetime'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid plan selected']);
    exit;
}

// Plan configuration
$plans = [
    'monthly' => [
        'amount' => 299, // £2.99 in pence
        'currency' => 'gbp',
        'description' => 'Nexi Premium Monthly (Early Access)'
    ],
    'yearly' => [
        'amount' => 2400, // £24 in pence
        'currency' => 'gbp',
        'description' => 'Nexi Premium Yearly (Early Access)'
    ],
    'lifetime' => [
        'amount' => 7900, // £79 in pence
        'currency' => 'gbp',
        'description' => 'Nexi Premium Lifetime'
    ]
];

$selected_plan = $plans[$plan];
$user = $_SESSION['discord_user'];

try {
    // Initialize Stripe
    require_once '../vendor/autoload.php'; // You'll need to install Stripe SDK
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    // Create payment intent data
    $payment_intent_data = [
        'amount' => $selected_plan['amount'],
        'currency' => $selected_plan['currency'],
        'description' => $selected_plan['description'],
        'metadata' => [
            'discord_user_id' => $user['id'],
            'discord_username' => $user['username'],
            'premium_type' => $plan,
            'purchase_type' => 'user'
        ]
    ];

    // Apply coupon if provided and valid
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

    // Create payment intent
    $payment_intent = \Stripe\PaymentIntent::create($payment_intent_data);

    echo json_encode([
        'clientSecret' => $payment_intent->client_secret
    ]);

} catch (Exception $e) {
    error_log('Payment intent creation failed: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => 'Failed to create payment intent. Please try again later.']);
}
?>
