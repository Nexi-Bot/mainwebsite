<?php
require_once 'includes/config.php';

echo "🎟️  Testing Coupon Validation\n";
echo "============================\n\n";

try {
    // Initialize Stripe
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    $test_coupons = ['TEST1212', 'PRESALE25', 'WELCOME20', 'INVALID123'];

    foreach ($test_coupons as $coupon_code) {
        echo "Testing coupon: {$coupon_code}\n";
        
        try {
            $coupon = \Stripe\Coupon::retrieve($coupon_code);
            
            // Check if coupon is valid
            $is_valid = true;
            $error_message = '';
            
            if (!$coupon || $coupon->deleted) {
                $is_valid = false;
                $error_message = 'Coupon not found or has been deleted';
            } elseif ($coupon->max_redemptions && $coupon->times_redeemed >= $coupon->max_redemptions) {
                $is_valid = false;
                $error_message = 'Coupon has reached its redemption limit';
            } elseif ($coupon->redeem_by && $coupon->redeem_by < time()) {
                $is_valid = false;
                $error_message = 'Coupon has expired';
            }
            
            if ($is_valid) {
                $description = '';
                
                if ($coupon->percent_off) {
                    $description = $coupon->percent_off . '% off';
                } elseif ($coupon->amount_off) {
                    $amount = $coupon->amount_off / 100;
                    $description = '£' . number_format($amount, 2) . ' off';
                }
                
                echo "  ✅ Valid: {$description}\n";
            } else {
                echo "  ❌ Invalid: {$error_message}\n";
            }
            
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            echo "  ❌ Not found: " . $e->getMessage() . "\n";
        } catch (Exception $e) {
            echo "  ❌ Error: " . $e->getMessage() . "\n";
        }
        
        echo "\n";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
