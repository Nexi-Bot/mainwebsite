<?php
/**
 * Production Deployment Script for Nexi Premium Payment System
 * Run this script after deploying to production to set up the environment
 */

echo "🚀 Nexi Premium Payment System - Production Deployment\n";
echo "=====================================================\n\n";

// Check PHP version
$php_version = phpversion();
echo "📋 Environment Check:\n";
echo "- PHP Version: {$php_version}\n";

if (version_compare($php_version, '7.4.0', '<')) {
    echo "❌ PHP 7.4+ required for Stripe SDK\n";
    exit(1);
} else {
    echo "✅ PHP version compatible\n";
}

// Check required extensions
$required_extensions = ['pdo', 'pdo_mysql', 'curl', 'json', 'openssl'];
$missing_extensions = [];

foreach ($required_extensions as $ext) {
    if (!extension_loaded($ext)) {
        $missing_extensions[] = $ext;
    }
}

if (empty($missing_extensions)) {
    echo "✅ All required PHP extensions loaded\n";
} else {
    echo "❌ Missing PHP extensions: " . implode(', ', $missing_extensions) . "\n";
    exit(1);
}

// Check if Composer dependencies are installed
if (!file_exists('vendor/autoload.php')) {
    echo "\n📦 Installing Composer dependencies...\n";
    exec('composer install --no-dev --optimize-autoloader', $output, $return_code);
    
    if ($return_code === 0) {
        echo "✅ Composer dependencies installed\n";
    } else {
        echo "❌ Failed to install Composer dependencies\n";
        echo "Please run: composer install --no-dev --optimize-autoloader\n";
        exit(1);
    }
} else {
    echo "✅ Composer dependencies found\n";
}

// Initialize database
echo "\n🗄️  Initializing database...\n";
try {
    require_once 'includes/config.php';
    require_once 'includes/database.php';
    echo "✅ Database connection successful\n";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    exit(1);
}

// Set proper file permissions
echo "\n🔐 Setting file permissions...\n";
$directories = ['premium/', 'auth/', 'includes/'];
foreach ($directories as $dir) {
    if (is_dir($dir)) {
        chmod($dir, 0755);
        echo "✅ Set permissions for {$dir}\n";
    }
}

// Create a test webhook endpoint check
echo "\n🔗 Testing webhook configuration...\n";
$webhook_url = 'https://nexibot.uk/premium/webhook';
echo "Webhook URL: {$webhook_url}\n";
echo "⚠️  Don't forget to configure this URL in your Stripe Dashboard!\n";

// Final status check
echo "\n🔍 Running final status check...\n";
require_once 'status-check.php';

echo "\n🎯 DEPLOYMENT COMPLETE!\n";
echo "======================\n";
echo "Your Nexi Premium Payment System is ready for production.\n\n";

echo "📋 Final Checklist:\n";
echo "□ Configure Stripe webhook endpoint: https://nexibot.uk/premium/webhook\n";
echo "□ Test payment flow with Stripe test cards\n";
echo "□ Update Discord OAuth redirect URI in Discord Developer Portal\n";
echo "□ Test Discord login flow\n";
echo "□ Verify database backups are configured\n";
echo "□ Set up monitoring for webhook failures\n";
echo "□ Test coupon codes (if using)\n";

echo "\n💳 Test Cards for Stripe:\n";
echo "- Success: 4242 4242 4242 4242\n";
echo "- Decline: 4000 0000 0000 0002\n";
echo "- Auth Required: 4000 0025 0000 3155\n";

echo "\n🔧 Stripe Dashboard Setup:\n";
echo "1. Go to: https://dashboard.stripe.com/webhooks\n";
echo "2. Add endpoint: https://nexibot.uk/premium/webhook\n";
echo "3. Select events: payment_intent.succeeded, invoice.payment_succeeded, customer.subscription.deleted\n";
echo "4. Copy webhook secret to config.php (STRIPE_WEBHOOK_SECRET)\n";

echo "\n✨ You're all set! Good luck with your premium launch!\n";
?>
