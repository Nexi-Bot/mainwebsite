<?php
// Test both payment endpoints for runtime errors
echo "Testing endpoints...\n";

// Test 1: Test the create-payment-intent endpoint
echo "\n1. Testing create-payment-intent.php:\n";
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mock a session for testing
session_start();
$_SESSION['discord_user'] = [
    'id' => 'test123',
    'username' => 'testuser'
];

// Mock the request
$_SERVER['REQUEST_METHOD'] = 'POST';
file_put_contents('php://memory', json_encode([
    'plan' => 'monthly',
    'email' => 'test@example.com',
    'full_name' => 'Test User',
    'postcode' => 'SW1A 1AA'
]));

try {
    include 'premium/create-payment-intent.php';
    echo "✓ No fatal errors in create-payment-intent.php\n";
} catch (Exception $e) {
    echo "✗ Error in create-payment-intent.php: " . $e->getMessage() . "\n";
}
ob_end_clean();

// Test 2: Test the webhook endpoint
echo "\n2. Testing webhook.php:\n";
ob_start();

try {
    // Mock webhook data
    $_SERVER['HTTP_STRIPE_SIGNATURE'] = 'test_signature';
    file_put_contents('php://memory', json_encode(['type' => 'test.event']));
    
    include 'premium/webhook.php';
    echo "✓ No fatal errors in webhook.php\n";
} catch (Exception $e) {
    echo "✗ Error in webhook.php: " . $e->getMessage() . "\n";
}
ob_end_clean();

echo "\nTest completed.\n";
?>
