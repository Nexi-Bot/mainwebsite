<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

echo "🔍 Nexi Premium Payment System Status Check\n";
echo "==========================================\n\n";

$status = [
    'database' => false,
    'stripe' => false,
    'discord_oauth' => false,
    'webhook' => false,
    'files' => false
];

// Test Database Connection
try {
    $result = $db->query("SELECT COUNT(*) as count FROM users");
    $user_count = $result->fetch()['count'];
    echo "✅ Database: Connected ({$user_count} users)\n";
    $status['database'] = true;
} catch (Exception $e) {
    echo "❌ Database: Connection failed - " . $e->getMessage() . "\n";
}

// Test Stripe API
try {
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
    $account = \Stripe\Account::retrieve();
    echo "✅ Stripe: API connected (Account: {$account->id})\n";
    $status['stripe'] = true;
} catch (Exception $e) {
    echo "❌ Stripe: API connection failed - " . $e->getMessage() . "\n";
}

// Check Discord OAuth Configuration
if (DISCORD_CLIENT_ID !== 'YOUR_DISCORD_CLIENT_ID' && DISCORD_CLIENT_SECRET !== 'YOUR_DISCORD_CLIENT_SECRET') {
    echo "✅ Discord OAuth: Configured\n";
    $status['discord_oauth'] = true;
} else {
    echo "⚠️  Discord OAuth: Not configured (update config.php)\n";
}

// Check Webhook File
if (defined('STRIPE_WEBHOOK_SECRET') && STRIPE_WEBHOOK_SECRET !== 'whsec_your_webhook_secret_here') {
    echo "✅ Webhook: Secret configured\n";
    $status['webhook'] = true;
} else {
    echo "⚠️  Webhook: Secret not configured (update STRIPE_WEBHOOK_SECRET in config.php)\n";
}

// Check Required Files
$required_files = [
    'premium/checkout.php',
    'premium/create-payment-intent.php',
    'premium/validate-coupon.php',
    'premium/webhook.php',
    'premium/success.php',
    'auth/discord-login.php',
    'auth/discord-callback.php'
];

$missing_files = [];
foreach ($required_files as $file) {
    if (!file_exists($file)) {
        $missing_files[] = $file;
    }
}

if (empty($missing_files)) {
    echo "✅ Files: All required files present\n";
    $status['files'] = true;
} else {
    echo "❌ Files: Missing - " . implode(', ', $missing_files) . "\n";
}

echo "\n📊 OVERALL STATUS\n";
echo "================\n";

$total_checks = count($status);
$passed_checks = count(array_filter($status));

echo "Passed: {$passed_checks}/{$total_checks} checks\n";

if ($passed_checks === $total_checks) {
    echo "\n🎉 ALL SYSTEMS GO! Your payment system is ready for production.\n";
    echo "\nFinal steps:\n";
    echo "1. Set up Stripe webhook endpoint: https://nexibot.uk/premium/webhook\n";
    echo "2. Test the complete flow with test cards\n";
    echo "3. Go live when ready!\n";
} else {
    echo "\n⚠️  Some configuration needed before going live.\n";
    echo "\nTo fix:\n";
    
    if (!$status['discord_oauth']) {
        echo "- Update Discord OAuth credentials in includes/config.php\n";
    }
    if (!$status['webhook']) {
        echo "- Update webhook secret in premium/webhook.php\n";
    }
    if (!$status['database']) {
        echo "- Fix database connection issues\n";
    }
    if (!$status['stripe']) {
        echo "- Fix Stripe API configuration\n";
    }
    if (!$status['files']) {
        echo "- Restore missing files\n";
    }
}

echo "\n💡 Test URLs:\n";
echo "- Features page: https://nexibot.uk/features\n";
echo "- Discord login: https://nexibot.uk/auth/discord-login\n";
echo "- Checkout: https://nexibot.uk/premium/checkout?plan=monthly\n";
echo "- Webhook: https://nexibot.uk/premium/webhook\n";
?>
