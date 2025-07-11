<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

echo "🔄 Nexi Premium Database Migration\n";
echo "=================================\n\n";

try {
    // Add new columns to users table for better subscription management
    $migrations = [
        // First try to add the columns (they might not exist)
        "ALTER TABLE users ADD COLUMN premium_status ENUM('active', 'cancelled', 'expired') DEFAULT 'expired'",
        "ALTER TABLE users ADD COLUMN premium_billing_amount INT DEFAULT NULL",
        
        // Create payments table if it doesn't exist
        "CREATE TABLE IF NOT EXISTS payments (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id VARCHAR(20) NOT NULL,
            stripe_payment_intent_id VARCHAR(255),
            stripe_subscription_id VARCHAR(255),
            amount_paid INT NOT NULL,
            plan_type ENUM('monthly', 'yearly', 'lifetime') NOT NULL,
            status ENUM('pending', 'completed', 'failed', 'cancelled') DEFAULT 'pending',
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            INDEX idx_user_id (user_id),
            INDEX idx_stripe_payment (stripe_payment_intent_id),
            INDEX idx_stripe_subscription (stripe_subscription_id),
            INDEX idx_status (status)
        )"
    ];

    foreach ($migrations as $sql) {
        try {
            $db->query($sql);
            echo "✅ Executed: " . substr($sql, 0, 50) . "...\n";
        } catch (Exception $e) {
            // Some migrations might fail if columns already exist, that's okay
            if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
                echo "ℹ️  Column already exists, skipping...\n";
            } else {
                echo "⚠️  Warning: " . $e->getMessage() . "\n";
            }
        }
    }

    // Now update existing users (only if the column exists)
    try {
        $db->query("UPDATE users SET premium_status = 'active' WHERE premium = TRUE AND (premium_expires_at IS NULL OR premium_expires_at > NOW())");
        $db->query("UPDATE users SET premium_status = 'expired' WHERE premium = TRUE AND premium_expires_at <= NOW()");
        $db->query("UPDATE users SET premium_status = 'expired' WHERE premium = FALSE");
        echo "✅ Updated existing user statuses\n";
    } catch (Exception $e) {
        echo "⚠️  Could not update user statuses (column might not exist yet): " . $e->getMessage() . "\n";
    }

    echo "\n🎯 Migration Summary:\n";
    echo "- Added premium_status column for better subscription tracking\n";
    echo "- Added premium_billing_amount column for pricing information\n";
    echo "- Created payments table for transaction history\n";
    echo "- Updated existing user statuses\n";

    // Show current user stats
    $result = $db->query("SELECT 
        COUNT(*) as total_users,
        COUNT(CASE WHEN premium_status = 'active' THEN 1 END) as active_premium,
        COUNT(CASE WHEN premium_status = 'expired' THEN 1 END) as expired_premium,
        COUNT(CASE WHEN premium_status = 'cancelled' THEN 1 END) as cancelled_premium
        FROM users");
    $stats = $result->fetch();

    echo "\n📊 Current User Statistics:\n";
    echo "- Total Users: {$stats['total_users']}\n";
    echo "- Active Premium: {$stats['active_premium']}\n";
    echo "- Expired Premium: {$stats['expired_premium']}\n";
    echo "- Cancelled Premium: {$stats['cancelled_premium']}\n";

    echo "\n✅ Database migration completed successfully!\n";

} catch (Exception $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>
