<?php
session_start();
header('Content-Type: application/json');

// Get the plan from URL like the checkout page does
$plan = $_GET['plan'] ?? 'monthly';

// Simulate the exact request that the JavaScript makes
$test_request_data = [
    'plan' => $plan,
    'email' => 'test@browser.com',
    'full_name' => 'Browser Test User',
    'postcode' => 'BR123'
];

echo json_encode([
    'session_exists' => isset($_SESSION['discord_user']),
    'user_data' => $_SESSION['discord_user'] ?? null,
    'get_params' => $_GET,
    'extracted_plan' => $plan,
    'session_id' => session_id(),
    'test_request_data' => $test_request_data,
    'current_url' => $_SERVER['REQUEST_URI'] ?? 'unknown',
    'current_time' => date('Y-m-d H:i:s'),
    'php_session_dir' => session_save_path(),
    'cookies_sent' => $_COOKIE ?? []
]);
?>
