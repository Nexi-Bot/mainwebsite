<?php
session_start();

// Create a test user session for debugging
$_SESSION['discord_user'] = [
    'id' => '123456789',
    'username' => 'testuser',
    'discriminator' => '0001',
    'avatar' => null,
    'verified' => true,
    'email' => 'test@example.com'
];

echo json_encode([
    'status' => 'success',
    'message' => 'Test user session created',
    'user' => $_SESSION['discord_user'],
    'session_id' => session_id()
]);
?>
