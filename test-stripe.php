<?php
require_once 'includes/config.php';

echo "🧪 Testing Stripe Integration...\n\n";

try {
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
    
    echo "✅ Stripe SDK loaded successfully\n";
    
    // Test API connection
    $account = \Stripe\Account::retrieve();
    echo "✅ Stripe API connection working\n";
    echo "   Account ID: " . $account->id . "\n";
    echo "   Country: " . $account->country . "\n";
    echo "   Business Type: " . $account->business_type . "\n";
    
    // Test creating a test coupon (will fail if it already exists)
    try {
        $coupon = \Stripe\Coupon::create([
            'id' => 'NEXI_TEST_10',
            'percent_off' => 10,
            'duration' => 'once',
            'name' => 'Nexi Test Discount'
        ]);
        echo "✅ Test coupon created: NEXI_TEST_10 (10% off)\n";
    } catch (Exception $e) {
        if (strpos($e->getMessage(), 'already exists') !== false) {
            echo "ℹ️  Test coupon NEXI_TEST_10 already exists\n";
        } else {
            echo "⚠️  Could not create test coupon: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n🎉 Stripe integration test complete!\n";
    echo "\nRemember to:\n";
    echo "1. Set up webhooks in Stripe Dashboard\n";
    echo "2. Configure the webhook secret in premium/webhook.php\n";
    echo "3. Test with Stripe test cards: 4242424242424242\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "\nPlease check:\n";
    echo "1. Stripe API keys in includes/config.php\n";
    echo "2. Composer dependencies are installed\n";
    echo "3. Internet connection is working\n";
}
?>
