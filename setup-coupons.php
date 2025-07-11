<?php
require_once 'includes/config.php';

echo "🎟️  Setting up Stripe Coupons for Nexi Premium\n";
echo "=============================================\n\n";

try {
    // Initialize Stripe
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    // Test coupons to create
    $coupons = [
        [
            'id' => 'TEST1212',
            'percent_off' => 10,
            'duration' => 'once',
            'name' => 'Test 10% Off'
        ],
        [
            'id' => 'WELCOME20',
            'percent_off' => 20,
            'duration' => 'once',
            'name' => 'Welcome 20% Off'
        ],
        [
            'id' => 'SAVE50',
            'amount_off' => 5000, // £50 in pence
            'currency' => 'gbp',
            'duration' => 'once',
            'name' => '£50 Off Coupon'
        ],
        [
            'id' => 'EARLY25',
            'percent_off' => 25,
            'duration' => 'once',
            'name' => 'Early Access 25% Off'
        ],
        [
            'id' => 'STUDENT15',
            'percent_off' => 15,
            'duration' => 'once',
            'name' => 'Student Discount 15% Off'
        ]
    ];

    foreach ($coupons as $coupon_data) {
        try {
            // Check if coupon already exists
            try {
                $existing = \Stripe\Coupon::retrieve($coupon_data['id']);
                echo "✅ Coupon '{$coupon_data['id']}' already exists\n";
                continue;
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                // Coupon doesn't exist, create it
            }

            // Create the coupon
            $coupon = \Stripe\Coupon::create($coupon_data);
            
            $discount_text = '';
            if (isset($coupon_data['percent_off'])) {
                $discount_text = $coupon_data['percent_off'] . '% off';
            } else {
                $discount_text = '£' . ($coupon_data['amount_off'] / 100) . ' off';
            }
            
            echo "✅ Created coupon: {$coupon->id} - {$discount_text}\n";
            
        } catch (Exception $e) {
            echo "❌ Failed to create coupon '{$coupon_data['id']}': " . $e->getMessage() . "\n";
        }
    }

    echo "\n🎯 Test Coupons Summary:\n";
    echo "- TEST1212: 10% off (one-time)\n";
    echo "- WELCOME20: 20% off (one-time)\n";
    echo "- SAVE50: £50 off (one-time)\n";
    echo "- EARLY25: 25% off (one-time)\n";
    echo "- STUDENT15: 15% off (one-time)\n";

    echo "\n💡 You can now test these coupon codes in your checkout!\n";
    echo "To create more coupons, visit: https://dashboard.stripe.com/coupons\n";

} catch (Exception $e) {
    echo "❌ Error setting up coupons: " . $e->getMessage() . "\n";
    echo "Please check your Stripe API configuration.\n";
}
?>
