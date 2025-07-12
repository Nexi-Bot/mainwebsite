<?php
// Test checkout page access
session_start();

// Mock a Discord user session for testing
$_SESSION['discord_user'] = [
    'id' => '123456789',
    'username' => 'testuser',
    'avatar' => 'test_avatar_hash'
];

// Set the plan parameter
$_GET['plan'] = 'monthly';

echo "Testing checkout page load...\n\n";

// Capture output
ob_start();

try {
    // Include the checkout page
    include 'premium/checkout.php';
    $output = ob_get_contents();
    
    // Check if the page loaded successfully
    if (strpos($output, 'Complete Your Purchase') !== false) {
        echo "✅ Checkout page loaded successfully\n";
        echo "✅ Found 'Complete Your Purchase' heading\n";
    } else {
        echo "❌ Checkout page did not load properly\n";
        echo "Output: " . substr($output, 0, 500) . "...\n";
    }
    
    if (strpos($output, 'Stripe') !== false) {
        echo "✅ Stripe integration found in page\n";
    } else {
        echo "❌ Stripe integration not found\n";
    }
    
    if (strpos($output, 'payment-form') !== false) {
        echo "✅ Payment form elements found\n";
    } else {
        echo "❌ Payment form elements not found\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error loading checkout page: " . $e->getMessage() . "\n";
} finally {
    ob_end_clean();
}

echo "\nTest complete.\n";
?>
