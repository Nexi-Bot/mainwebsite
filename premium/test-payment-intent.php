<?php
// Quick test script to check payment intent creation
require_once dirname(__DIR__) . '/includes/session.php';
require_once dirname(__DIR__) . '/includes/config.php';

// Set test user for session
$_SESSION['discord_user'] = [
    'id' => '123456789',
    'username' => 'TestUser',
    'discriminator' => '0001',
    'avatar' => null,
    'verified' => true,
    'email' => 'test@example.com'
];

// Test data
$test_data = [
    'plan' => 'monthly',
    'email' => 'test@example.com',
    'full_name' => 'Test User',
    'postcode' => 'SW1A 1AA'
];

echo "<h3>Testing Payment Intent Creation</h3>";
echo "<p><strong>Test Data:</strong> " . json_encode($test_data) . "</p>";

// Make curl request to create-payment-intent.php
$url = 'http://localhost/nexi-php-website/premium/create-payment-intent.php';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($test_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'X-Requested-With: XMLHttpRequest',
    'Cookie: PHPSESSID=' . session_id()
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);

$response = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

echo "<p><strong>HTTP Status:</strong> " . $httpcode . "</p>";
echo "<p><strong>Response:</strong></p>";
echo "<pre>" . htmlspecialchars($response) . "</pre>";
?>
