<?php
session_start();
header('Content-Type: application/json');

echo json_encode([
    'session_exists' => isset($_SESSION['discord_user']),
    'user_data' => $_SESSION['discord_user'] ?? null,
    'get_params' => $_GET,
    'post_params' => $_POST,
    'raw_input' => file_get_contents('php://input'),
    'current_time' => date('Y-m-d H:i:s'),
    'session_id' => session_id()
]);
?>
