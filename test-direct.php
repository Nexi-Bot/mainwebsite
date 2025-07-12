<?php
// Simple test of the payment intent creation
echo "🔍 Testing payment intent creation directly...\n\n";

// Set up session
session_start();
$_SESSION['discord_user'] = [
    'id' => '123456789',
    'username' => 'testuser#1234'
];

// Include files directly with correct paths
require_once 'includes/config.php';
require_once 'includes/database.php';

echo "✅ Config loaded successfully\n";
echo "✅ Database file loaded\n";

// Test Stripe connection
try {
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
    
    $account = \Stripe\Account::retrieve();
    echo "✅ Stripe connected: " . $account->id . "\n";
} catch (Exception $e) {
    echo "❌ Stripe error: " . $e->getMessage() . "\n";
}

// Test payment intent creation logic
$plan = 'monthly';
$email = 'test@example.com';
$full_name = 'Test User';
$postcode = 'SW1A 1AA';

$plans = [
    'monthly' => [
        'presale_amount' => 299,
        'regular_amount' => 499,
        'currency' => 'gbp',
        'interval' => 'month',
        'description' => 'Nexi Premium Monthly'
    ],
    'yearly' => [
        'presale_amount' => 2400,
        'regular_amount' => 3500,
        'currency' => 'gbp',
        'interval' => 'year',
        'description' => 'Nexi Premium Yearly'
    ],
    'lifetime' => [
        'presale_amount' => 7900,
        'regular_amount' => 7900,
        'currency' => 'gbp',
        'interval' => null,
        'description' => 'Nexi Premium Lifetime'
    ]
];

$selected_plan = $plans[$plan];
$user = $_SESSION['discord_user'];

echo "\n🧪 Testing lifetime payment intent...\n";

try {
    $payment_intent_data = [
        'amount' => 7900, // Test with lifetime
        'currency' => 'gbp',
        'description' => 'Nexi Premium Lifetime',
        'receipt_email' => $email,
        'metadata' => [
            'discord_user_id' => $user['id'],
            'discord_username' => $user['username'],
            'premium_type' => 'lifetime',
            'purchase_type' => 'lifetime',
            'customer_name' => $full_name,
            'postcode' => $postcode
        ]
    ];
    
    $payment_intent = \Stripe\PaymentIntent::create($payment_intent_data);
    echo "✅ Payment intent created: " . $payment_intent->id . "\n";
    echo "✅ Client secret: " . substr($payment_intent->client_secret, 0, 20) . "...\n";
    echo "✅ Amount: £" . ($payment_intent->amount / 100) . "\n";
    
} catch (Exception $e) {
    echo "❌ Payment intent error: " . $e->getMessage() . "\n";
}

echo "\n🧪 Testing monthly subscription...\n";

try {
    // Create customer
    $customer = \Stripe\Customer::create([
        'email' => $email,
        'name' => $full_name,
        'metadata' => [
            'discord_id' => $user['id'],
            'discord_username' => $user['username'],
            'postcode' => $postcode
        ]
    ]);
    echo "✅ Customer created: " . $customer->id . "\n";
    
    // Create price
    $price = \Stripe\Price::create([
        'unit_amount' => 299,
        'currency' => 'gbp',
        'recurring' => [
            'interval' => 'month',
            'interval_count' => 1
        ],
        'product_data' => [
            'name' => 'Test Nexi Premium Monthly',
            'metadata' => [
                'type' => 'presale',
                'plan' => 'monthly'
            ]
        ]
    ]);
    echo "✅ Price created: " . $price->id . "\n";
    
    // Deactivate test price
    \Stripe\Price::update($price->id, ['active' => false]);
    echo "✅ Test price deactivated\n";
    
} catch (Exception $e) {
    echo "❌ Subscription error: " . $e->getMessage() . "\n";
}

echo "\n🎉 Direct test complete!\n";
?>
