<?php
session_start();
require_once dirname(__DIR__) . '/includes/config.php';

header('Content-Type: application/json');

// Debug the current session and URL parameters
echo json_encode([
    'session_exists' => isset($_SESSION['discord_user']),
    'user' => $_SESSION['discord_user'] ?? null,
    'get_params' => $_GET,
    'plan_from_get' => $_GET['plan'] ?? 'not set',
    'current_url' => $_SERVER['REQUEST_URI'] ?? 'unknown',
    'query_string' => $_SERVER['QUERY_STRING'] ?? 'empty',
    'php_plan_variable' => isset($plan) ? $plan : 'not set in this context'
]);
?>
