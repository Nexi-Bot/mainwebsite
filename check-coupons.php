<?php
require_once 'includes/config.php';

echo "🎟️  Checking Stripe Dashboard Coupons\n";
echo "=====================================\n\n";

try {
    // Initialize Stripe
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    // List all coupons from Stripe dashboard
    $coupons = \Stripe\Coupon::all(['limit' => 100]);
    
    echo "📋 Coupons found in Stripe dashboard:\n";
    echo "-------------------------------------\n";
    
    if (count($coupons->data) === 0) {
        echo "❌ No coupons found in Stripe dashboard!\n\n";
        echo "Creating sample coupons...\n";
        
        // Create some test coupons
        $test_coupons = [
            [
                'id' => 'WELCOME20',
                'percent_off' => 20,
                'duration' => 'once',
                'name' => 'Welcome 20% Off'
            ],
            [
                'id' => 'SAVE10',
                'percent_off' => 10,
                'duration' => 'once',
                'name' => 'Save 10%'
            ],
            [
                'id' => 'HALF50',
                'percent_off' => 50,
                'duration' => 'once',
                'name' => 'Half Price Special'
            ]
        ];
        
        foreach ($test_coupons as $coupon_data) {
            try {
                $coupon = \Stripe\Coupon::create($coupon_data);
                echo "✅ Created: {$coupon->id} - {$coupon->percent_off}% off\n";
            } catch (Exception $e) {
                echo "❌ Failed to create {$coupon_data['id']}: " . $e->getMessage() . "\n";
            }
        }
    } else {
        foreach ($coupons->data as $coupon) {
            $discount = '';
            if ($coupon->percent_off) {
                $discount = $coupon->percent_off . '% off';
            } elseif ($coupon->amount_off) {
                $discount = '£' . number_format($coupon->amount_off / 100, 2) . ' off';
            }
            
            $status = '';
            if (isset($coupon->max_redemptions) && $coupon->max_redemptions) {
                $remaining = $coupon->max_redemptions - ($coupon->times_redeemed ?? 0);
                $status = " ({$remaining} uses left)";
            }
            
            echo "✅ {$coupon->id}: {$discount} - {$coupon->duration}{$status}\n";
        }
    }
    
    echo "\n💡 You can also create more coupons at: https://dashboard.stripe.com/coupons\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
