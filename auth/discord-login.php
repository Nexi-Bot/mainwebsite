<?php
session_start();
require_once '../includes/config.php';

// Debug output (remove in production)
if (isset($_GET['debug'])) {
    echo "Discord OAuth Debug Info:<br>";
    echo "Client ID: " . DISCORD_CLIENT_ID . "<br>";
    echo "Redirect URI: " . DISCORD_REDIRECT_URI . "<br>";
    exit;
}

// Discord OAuth URL
$discord_auth_url = 'https://discord.com/api/oauth2/authorize?' . http_build_query([
    'client_id' => DISCORD_CLIENT_ID,
    'redirect_uri' => DISCORD_REDIRECT_URI,
    'response_type' => 'code',
    'scope' => 'identify guilds'
]);

// Redirect to Discord
header('Location: ' . $discord_auth_url);
exit;
?>
