<?php
require_once dirname(__DIR__) . '/includes/session.php';
require_once dirname(__DIR__) . '/includes/config.php';

// Set security headers
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Allow requests from the same origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    $origin = $_SERVER['HTTP_ORIGIN'];
    if (strpos($origin, 'nexibot.uk') !== false || strpos($origin, 'localhost') !== false) {
        header("Access-Control-Allow-Origin: $origin");
    }
}

// Check if user is authenticated
if (!isset($_SESSION['discord_user'])) {
    http_response_code(401);
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

// Get request data
$input = json_decode(file_get_contents('php://input'), true);
$coupon_code = $input['coupon'] ?? null;

if (!$coupon_code) {
    http_response_code(400);
    echo json_encode(['error' => 'Coupon code required']);
    exit;
}

try {
    // Initialize Stripe
    require_once dirname(__DIR__) . '/vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    // Validate coupon with Stripe
    $coupon = \Stripe\Coupon::retrieve($coupon_code);
    
    // Check if coupon is valid (not expired and within redemption limits)
    $is_valid = true;
    $error_message = '';
    
    if (!$coupon) {
        $is_valid = false;
        $error_message = 'Coupon not found';
    } elseif (isset($coupon->max_redemptions) && $coupon->max_redemptions && 
              isset($coupon->times_redeemed) && $coupon->times_redeemed >= $coupon->max_redemptions) {
        $is_valid = false;
        $error_message = 'Coupon has reached its redemption limit';
    } elseif (isset($coupon->redeem_by) && $coupon->redeem_by && $coupon->redeem_by < time()) {
        $is_valid = false;
        $error_message = 'Coupon has expired';
    }
    
    if ($is_valid) {
        $description = '';
        
        if ($coupon->percent_off) {
            $description = $coupon->percent_off . '% off';
        } elseif ($coupon->amount_off) {
            $amount = $coupon->amount_off / 100; // Convert from pence to pounds
            $description = '£' . number_format($amount, 2) . ' off';
        }
        
        if ($coupon->duration === 'once') {
            $description .= ' (one-time)';
        } elseif ($coupon->duration === 'repeating') {
            $description .= ' for ' . $coupon->duration_in_months . ' months';
        } elseif ($coupon->duration === 'forever') {
            $description .= ' (recurring)';
        }

        echo json_encode([
            'valid' => true,
            'description' => $description,
            'coupon_id' => $coupon->id
        ]);
    } else {
        echo json_encode([
            'valid' => false,
            'error' => $error_message
        ]);
    }

} catch (\Stripe\Exception\InvalidRequestException $e) {
    // Coupon doesn't exist or is invalid
    echo json_encode([
        'valid' => false,
        'error' => 'Invalid coupon code: ' . $e->getMessage()
    ]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'valid' => false,
        'error' => 'Error validating coupon: ' . $e->getMessage()
    ]);
}
?>
