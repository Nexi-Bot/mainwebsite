<?php
// Test payment flow
session_start();
require_once 'includes/config.php';
require_once 'includes/database.php';

echo "🧪 Testing Payment Flow...\n\n";

// Test 1: Check Stripe configuration
try {
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
    
    $account = \Stripe\Account::retrieve();
    echo "✅ Stripe API working - Account: " . $account->id . "\n";
} catch (Exception $e) {
    echo "❌ Stripe API failed: " . $e->getMessage() . "\n";
    exit(1);
}

// Test 2: Simulate user session
$_SESSION['discord_user'] = [
    'id' => '123456789',
    'username' => 'testuser#1234'
];
echo "✅ Discord user session simulated\n";

// Test 3: Test payment intent creation for each plan
$test_data = [
    'email' => 'test@example.com',
    'full_name' => 'Test User',
    'postcode' => 'SW1A 1AA'
];

foreach (['monthly', 'yearly', 'lifetime'] as $plan) {
    echo "\n🔍 Testing $plan plan...\n";
    
    // Simulate the request data
    $input_data = array_merge($test_data, ['plan' => $plan]);
    
    // Test the payment creation logic
    try {
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
        
        if ($plan === 'lifetime') {
            // Test lifetime payment intent creation
            $payment_intent_data = [
                'amount' => $selected_plan['presale_amount'],
                'currency' => $selected_plan['currency'],
                'description' => $selected_plan['description'],
                'receipt_email' => $input_data['email'],
                'metadata' => [
                    'discord_user_id' => $user['id'],
                    'discord_username' => $user['username'],
                    'premium_type' => $plan,
                    'purchase_type' => 'lifetime',
                    'customer_name' => $input_data['full_name'],
                    'postcode' => $input_data['postcode']
                ]
            ];
            
            $payment_intent = \Stripe\PaymentIntent::create($payment_intent_data);
            echo "  ✅ Payment intent created: " . substr($payment_intent->id, 0, 20) . "...\n";
            echo "  ✅ Amount: £" . number_format($payment_intent->amount / 100, 2) . "\n";
            echo "  ✅ Metadata: " . count($payment_intent->metadata) . " fields\n";
            
        } else {
            // Test subscription creation
            $customer_data = [
                'email' => $input_data['email'],
                'name' => $input_data['full_name'],
                'metadata' => [
                    'discord_id' => $user['id'],
                    'discord_username' => $user['username'],
                    'postcode' => $input_data['postcode']
                ]
            ];
            
            $customer = \Stripe\Customer::create($customer_data);
            echo "  ✅ Customer created: " . $customer->id . "\n";
            
            // Create test price
            $presale_price = \Stripe\Price::create([
                'unit_amount' => $selected_plan['presale_amount'],
                'currency' => $selected_plan['currency'],
                'recurring' => [
                    'interval' => $selected_plan['interval'],
                    'interval_count' => 1
                ],
                'product_data' => [
                    'name' => "Test Nexi Premium {$plan} - Presale",
                    'metadata' => [
                        'type' => 'presale',
                        'plan' => $plan
                    ]
                ]
            ]);
            echo "  ✅ Presale price created: " . $presale_price->id . "\n";
            
            // Clean up test data
            \Stripe\Price::update($presale_price->id, ['active' => false]);
            echo "  🧹 Test price deactivated\n";
        }
        
    } catch (Exception $e) {
        echo "  ❌ Error: " . $e->getMessage() . "\n";
    }
}

echo "\n🎉 Payment flow test complete!\n";
echo "\n💡 To test the full checkout:\n";
echo "1. Visit: https://nexibot.uk/features\n";
echo "2. Click 'Get Premium'\n";
echo "3. Login with Discord\n";
echo "4. Complete checkout form\n";
echo "5. Use test card: 4242424242424242\n";
?>
