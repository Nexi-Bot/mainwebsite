<?php
require_once '../includes/session.php';

// Check if user is authenticated
$is_authenticated = isset($_SESSION['discord_user']);

// If not authenticated, create the session
if (!$is_authenticated) {
    $_SESSION['discord_user'] = [
        'id' => '123456789',
        'username' => 'testuser',
        'discriminator' => '0001',
        'avatar' => null,
        'verified' => true,
        'email' => 'test@example.com'
    ];
    
    // Force session write and ensure cookies are sent
    session_write_close();
    require_once '../includes/session.php';
}

// Set proper headers for JSON and cookies
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

// Force a session cookie to be sent
if (!isset($_COOKIE[session_name()])) {
    setcookie(session_name(), session_id(), [
        'expires' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}

// Now test the payment intent endpoint
$test_request_data = [
    'plan' => $_GET['plan'] ?? 'monthly',
    'email' => 'test@browser.com',
    'full_name' => 'Browser Test User',
    'postcode' => 'BR123'
];

echo json_encode([
    'step1_auth_before' => $is_authenticated,
    'step2_auth_after' => isset($_SESSION['discord_user']),
    'step3_session_id' => session_id(),
    'step4_user_data' => $_SESSION['discord_user'] ?? null,
    'step5_test_data' => $test_request_data,
    'step6_cookies' => $_COOKIE,
    'step7_session_status' => session_status(),
    'step8_session_name' => session_name(),
    'current_time' => date('Y-m-d H:i:s')
]);
?>
