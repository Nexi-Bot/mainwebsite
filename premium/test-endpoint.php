<?php
session_start();
require_once dirname(__DIR__) . '/includes/config.php';

// Set security headers
header('Content-Type: application/json');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');

// Allow requests from the same origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    $origin = $_SERVER['HTTP_ORIGIN'];
    if (strpos($origin, 'nexibot.uk') !== false || strpos($origin, 'localhost') !== false) {
        header("Access-Control-Allow-Origin: $origin");
    }
}

// Log the request for debugging
error_log('Test endpoint called - Method: ' . $_SERVER['REQUEST_METHOD']);
error_log('Test endpoint called - Headers: ' . json_encode(getallheaders()));
error_log('Test endpoint called - Input: ' . file_get_contents('php://input'));

// Check if user is authenticated
if (!isset($_SESSION['discord_user'])) {
    http_response_code(401);
    echo json_encode([
        'error' => 'User not authenticated',
        'debug' => [
            'session_id' => session_id(),
            'session_data' => $_SESSION ?? 'No session data'
        ]
    ]);
    exit;
}

// Get request data
$input = json_decode(file_get_contents('php://input'), true);

// Return test response
echo json_encode([
    'success' => true,
    'message' => 'Test endpoint working',
    'user' => $_SESSION['discord_user']['username'] ?? 'Unknown',
    'received_data' => $input,
    'server_info' => [
        'php_version' => phpversion(),
        'server_time' => date('Y-m-d H:i:s'),
        'method' => $_SERVER['REQUEST_METHOD']
    ]
]);
?>
