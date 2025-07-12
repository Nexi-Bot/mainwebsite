<?php
// Simple payment test to simulate the actual request flow
header('Content-Type: text/plain');
echo "=== TESTING PAYMENT ENDPOINTS ===\n\n";

// Test 1: Create Payment Intent endpoint
echo "1. Testing Create Payment Intent:\n";

// Prepare test data (simulating what the frontend would send)
$postData = json_encode([
    'plan' => 'monthly',
    'email' => 'test@example.com',
    'full_name' => 'Test User',
    'postcode' => 'SW1A 1AA',
    'coupon' => ''
]);

// Mock the session
session_start();
$_SESSION['discord_user'] = [
    'id' => '123456789',
    'username' => 'testuser'
];

// Prepare environment for the payment intent endpoint
$_SERVER['REQUEST_METHOD'] = 'POST';
$_SERVER['CONTENT_TYPE'] = 'application/json';

// Create a temporary file to hold our POST data
$temp_input = tmpfile();
fwrite($temp_input, $postData);
rewind($temp_input);

// Override php://input for our test
$_SERVER['argv'] = ['php://stdin'];

// Start output buffering to capture the response
ob_start();

try {
    // Create a file that will read our test data instead of php://input
    $old_input = 'php://input';
    
    // We need to test this differently since we can't easily mock php://input
    // Let's just check if the file can be included without fatal errors
    
    $test_create = true;
    include_once 'premium/create-payment-intent.php';
    
} catch (Exception $e) {
    echo "✗ Fatal error in create-payment-intent.php: " . $e->getMessage() . "\n";
    $test_create = false;
} catch (ParseError $e) {
    echo "✗ Parse error in create-payment-intent.php: " . $e->getMessage() . "\n";
    $test_create = false;
} catch (Error $e) {
    echo "✗ PHP error in create-payment-intent.php: " . $e->getMessage() . "\n";
    $test_create = false;
}

$create_output = ob_get_clean();

if ($test_create) {
    echo "✓ No fatal errors in create-payment-intent.php\n";
    echo "Response: " . trim($create_output) . "\n";
} else {
    echo "Output: " . trim($create_output) . "\n";
}

// Test 2: Webhook endpoint
echo "\n2. Testing Webhook:\n";

ob_start();

try {
    $_SERVER['HTTP_STRIPE_SIGNATURE'] = 'test_sig';
    
    $test_webhook = true;
    include_once 'premium/webhook.php';
    
} catch (Exception $e) {
    echo "✗ Fatal error in webhook.php: " . $e->getMessage() . "\n";
    $test_webhook = false;
} catch (ParseError $e) {
    echo "✗ Parse error in webhook.php: " . $e->getMessage() . "\n";
    $test_webhook = false;
} catch (Error $e) {
    echo "✗ PHP error in webhook.php: " . $e->getMessage() . "\n";
    $test_webhook = false;
}

$webhook_output = ob_get_clean();

if ($test_webhook) {
    echo "✓ No fatal errors in webhook.php\n";
    echo "Response: " . trim($webhook_output) . "\n";
} else {
    echo "Output: " . trim($webhook_output) . "\n";
}

echo "\n=== TEST COMPLETE ===\n";

// Clean up
if (isset($temp_input)) {
    fclose($temp_input);
}
?>
