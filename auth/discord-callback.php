<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/database.php';

if (!isset($_GET['code'])) {
    header('Location: /features');
    exit;
}

$code = $_GET['code'];

// Exchange code for access token
$token_data = [
    'client_id' => DISCORD_CLIENT_ID,
    'client_secret' => DISCORD_CLIENT_SECRET,
    'grant_type' => 'authorization_code',
    'code' => $code,
    'redirect_uri' => DISCORD_REDIRECT_URI
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://discord.com/api/oauth2/token');
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($token_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded'
]);

$token_response = curl_exec($ch);
curl_close($ch);

$token_json = json_decode($token_response, true);

if (!isset($token_json['access_token'])) {
    header('Location: /features?error=auth_failed');
    exit;
}

$access_token = $token_json['access_token'];

// Get user information
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://discord.com/api/users/@me');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $access_token
]);

$user_response = curl_exec($ch);
curl_close($ch);

$user_data = json_decode($user_response, true);

if (!isset($user_data['id'])) {
    header('Location: /features?error=user_fetch_failed');
    exit;
}

// Get user guilds
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://discord.com/api/users/@me/guilds');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $access_token
]);

$guilds_response = curl_exec($ch);
curl_close($ch);

$guilds_data = json_decode($guilds_response, true);

// Store user data in session
$_SESSION['discord_user'] = [
    'id' => $user_data['id'],
    'username' => $user_data['username'],
    'discriminator' => $user_data['discriminator'] ?? '0',
    'avatar' => $user_data['avatar'],
    'guilds' => $guilds_data ?: []
];

// Store user in database
try {
    $db->query(
        "INSERT INTO users (user_id, username, discriminator, avatar, created_at, updated_at) 
         VALUES (?, ?, ?, ?, NOW(), NOW()) 
         ON DUPLICATE KEY UPDATE 
         username = VALUES(username), 
         discriminator = VALUES(discriminator), 
         avatar = VALUES(avatar), 
         updated_at = NOW()",
        [
            $user_data['id'],
            $user_data['username'],
            $user_data['discriminator'] ?? '0',
            $user_data['avatar']
        ]
    );
} catch (Exception $e) {
    error_log("Failed to store user data: " . $e->getMessage());
}

// Redirect back to features page
header('Location: /features?authenticated=1');
exit;
?>
