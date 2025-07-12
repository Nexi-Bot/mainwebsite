<?php
// Debug script to check current setup
header('Content-Type: text/plain');

echo "=== NEXI PAYMENT SYSTEM DEBUG ===\n\n";

// Check PHP version
echo "PHP Version: " . phpversion() . "\n";

// Check if required extensions are loaded
echo "\nRequired Extensions:\n";
echo "- curl: " . (extension_loaded('curl') ? "✓ Loaded" : "✗ Missing") . "\n";
echo "- json: " . (extension_loaded('json') ? "✓ Loaded" : "✗ Missing") . "\n";
echo "- mbstring: " . (extension_loaded('mbstring') ? "✓ Loaded" : "✗ Missing") . "\n";
echo "- openssl: " . (extension_loaded('openssl') ? "✓ Loaded" : "✗ Missing") . "\n";

// Check file permissions
echo "\nFile Permissions:\n";
$files_to_check = [
    'premium/create-payment-intent.php',
    'premium/webhook.php',
    'includes/config.php',
    'includes/database.php',
    'vendor/autoload.php'
];

foreach ($files_to_check as $file) {
    if (file_exists($file)) {
        echo "- $file: " . (is_readable($file) ? "✓ Readable" : "✗ Not readable") . "\n";
    } else {
        echo "- $file: ✗ Not found\n";
    }
}

// Check Stripe SDK
echo "\nStripe SDK:\n";
if (file_exists('vendor/autoload.php')) {
    require_once 'vendor/autoload.php';
    echo "- Autoloader: ✓ Found\n";
    
    if (class_exists('\Stripe\Stripe')) {
        echo "- Stripe class: ✓ Available\n";
        echo "- Stripe SDK version: " . \Stripe\Stripe::VERSION . "\n";
    } else {
        echo "- Stripe class: ✗ Not available\n";
    }
} else {
    echo "- Autoloader: ✗ Not found\n";
}

// Check configuration
echo "\nConfiguration:\n";
if (file_exists('includes/config.php')) {
    require_once 'includes/config.php';
    echo "- Config file: ✓ Loaded\n";
    echo "- Stripe publishable key: " . (defined('STRIPE_PUBLISHABLE_KEY') && !empty(STRIPE_PUBLISHABLE_KEY) ? "✓ Set" : "✗ Missing") . "\n";
    echo "- Stripe secret key: " . (defined('STRIPE_SECRET_KEY') && !empty(STRIPE_SECRET_KEY) ? "✓ Set" : "✗ Missing") . "\n";
    echo "- Webhook secret: " . (defined('STRIPE_WEBHOOK_SECRET') && !empty(STRIPE_WEBHOOK_SECRET) ? "✓ Set" : "✗ Missing") . "\n";
} else {
    echo "- Config file: ✗ Not found\n";
}

// Check database connection
echo "\nDatabase Connection:\n";
try {
    require_once 'includes/database.php';
    $pdo = get_database_connection();
    echo "- Database: ✓ Connected\n";
} catch (Exception $e) {
    echo "- Database: ✗ Error - " . $e->getMessage() . "\n";
}

// Test basic Stripe API call
echo "\nStripe API Test:\n";
try {
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
    $account = \Stripe\Account::retrieve();
    echo "- API Call: ✓ Success (Account: " . $account->id . ")\n";
} catch (Exception $e) {
    echo "- API Call: ✗ Error - " . $e->getMessage() . "\n";
}

echo "\n=== DEBUG COMPLETE ===\n";
?>
