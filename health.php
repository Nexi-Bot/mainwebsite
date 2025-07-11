<?php
/**
 * Health Check Endpoint for Monitoring
 * Returns JSON status of critical system components
 */

header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

$health = [
    'status' => 'healthy',
    'timestamp' => date('c'),
    'checks' => []
];

try {
    // Database check
    require_once 'includes/config.php';
    require_once 'includes/database.php';
    $result = $db->query("SELECT 1");
    $health['checks']['database'] = ['status' => 'ok', 'message' => 'Connected'];
} catch (Exception $e) {
    $health['checks']['database'] = ['status' => 'error', 'message' => $e->getMessage()];
    $health['status'] = 'unhealthy';
}

try {
    // Stripe API check
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
    \Stripe\Account::retrieve();
    $health['checks']['stripe'] = ['status' => 'ok', 'message' => 'API accessible'];
} catch (Exception $e) {
    $health['checks']['stripe'] = ['status' => 'error', 'message' => $e->getMessage()];
    $health['status'] = 'unhealthy';
}

// Configuration checks
$config_checks = [
    'discord_oauth' => DISCORD_CLIENT_ID !== 'YOUR_DISCORD_CLIENT_ID',
    'stripe_keys' => !empty(STRIPE_SECRET_KEY) && !empty(STRIPE_PUBLISHABLE_KEY),
    'webhook_secret' => defined('STRIPE_WEBHOOK_SECRET') && STRIPE_WEBHOOK_SECRET !== 'whsec_your_webhook_secret_here'
];

foreach ($config_checks as $check => $valid) {
    $health['checks'][$check] = [
        'status' => $valid ? 'ok' : 'error',
        'message' => $valid ? 'Configured' : 'Not configured'
    ];
    if (!$valid) {
        $health['status'] = 'unhealthy';
    }
}

// File system checks
$required_files = [
    'premium/checkout.php',
    'premium/webhook.php',
    'auth/discord-login.php',
    'auth/discord-callback.php'
];

$missing_files = array_filter($required_files, function($file) {
    return !file_exists($file);
});

$health['checks']['files'] = [
    'status' => empty($missing_files) ? 'ok' : 'error',
    'message' => empty($missing_files) ? 'All required files present' : 'Missing: ' . implode(', ', $missing_files)
];

if (!empty($missing_files)) {
    $health['status'] = 'unhealthy';
}

// Return appropriate HTTP status code
http_response_code($health['status'] === 'healthy' ? 200 : 503);

echo json_encode($health, JSON_PRETTY_PRINT);
?>
