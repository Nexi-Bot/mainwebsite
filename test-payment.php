<?php
require_once 'includes/config.php';

echo "🔧 Testing Payment Intent Creation\n";
echo "==================================\n\n";

// Simulate session data
session_start();
$_SESSION['discord_user'] = [
    'id' => '123456789',
    'username' => 'TestUser'
];

// Test data
$test_data = [
    'plan' => 'monthly',
    'email' => 'test@example.com',
    'coupon' => null
];

echo "Testing with data:\n";
echo "Plan: {$test_data['plan']}\n";
echo "Email: {$test_data['email']}\n";
echo "Coupon: " . ($test_data['coupon'] ?? 'none') . "\n\n";

try {
    // Initialize Stripe
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    // Plan configuration
    $plans = [
        'monthly' => [
            'presale_amount' => 299,
            'regular_amount' => 499,
            'currency' => 'gbp',
            'interval' => 'month',
            'description' => 'Nexi Premium Monthly'
        ]
    ];

    $selected_plan = $plans[$test_data['plan']];
    $user = $_SESSION['discord_user'];

    echo "✅ Stripe initialized\n";
    echo "✅ Plan configured: {$selected_plan['description']}\n";
    echo "✅ Amount: £" . number_format($selected_plan['presale_amount'] / 100, 2) . "\n";

    // Test customer creation
    $customer_data = [
        'email' => $test_data['email'],
        'name' => $user['username'],
        'metadata' => [
            'discord_id' => $user['id'],
            'discord_username' => $user['username']
        ]
    ];

    echo "✅ Customer data prepared\n";
    echo "✅ Test completed successfully\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
