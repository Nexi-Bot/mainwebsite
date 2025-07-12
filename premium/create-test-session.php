<?php
require_once '../includes/session.php';

// Create a test user session for debugging
$_SESSION['discord_user'] = [
    'id' => '123456789',
    'username' => 'testuser',
    'discriminator' => '0001',
    'avatar' => null,
    'verified' => true,
    'email' => 'test@example.com'
];

// Force session write
session_write_close();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Session Created</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #1a1a1a; color: white; }
        .success { color: #51cf66; background: #333; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .button { padding: 10px 20px; margin: 10px; background: #007cba; color: white; text-decoration: none; border-radius: 5px; display: inline-block; }
    </style>
</head>
<body>
    <div class="success">
        <h2>✅ Test User Session Created</h2>
        <p><strong>Session ID:</strong> <?php echo session_id(); ?></p>
        <p><strong>User:</strong> <?php echo $_SESSION['discord_user']['username']; ?></p>
        <p><strong>Discord ID:</strong> <?php echo $_SESSION['discord_user']['id']; ?></p>
    </div>
    
    <h3>Next Steps:</h3>
    <a href="checkout.php?plan=monthly" class="button">Test Monthly Checkout</a>
    <a href="checkout.php?plan=yearly" class="button">Test Yearly Checkout</a>
    <a href="checkout.php?plan=lifetime" class="button">Test Lifetime Checkout</a>
    <a href="debug-console.html" class="button">Back to Debug Console</a>
</body>
</html>
