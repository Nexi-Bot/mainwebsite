<?php
session_start();
require_once '../includes/config.php';

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
$coupon_code = $input['coupon'] ?? null;

if (!$coupon_code) {
    http_response_code(400);
    echo json_encode(['error' => 'Coupon code required']);
    exit;
}

try {
    // Initialize Stripe
    require_once '../vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    // Validate coupon with Stripe
    $coupon = \Stripe\Coupon::retrieve($coupon_code);
    
    if ($coupon->valid) {
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
            'error' => 'Coupon is not valid or has expired'
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
