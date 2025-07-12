<?php
require_once '../includes/session.php';
header('Content-Type: application/json');

// Just check authentication like the payment intent endpoint does
if (!isset($_SESSION['discord_user'])) {
    http_response_code(401);
    echo json_encode([
        'error' => 'User not authenticated',
        'session_id' => session_id(),
        'session_data' => $_SESSION,
        'cookies' => $_COOKIE
    ]);
    exit;
}

echo json_encode([
    'status' => 'authenticated',
    'user' => $_SESSION['discord_user'],
    'session_id' => session_id(),
    'message' => 'Authentication successful - payment intent should work'
]);
?>
