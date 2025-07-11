<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

echo "🔧 Initializing Nexi Premium Database...\n\n";

try {
    // Create database tables
    $db->createTables();
    echo "✅ Database tables created successfully!\n";
    
    // Test database connection
    $result = $db->query("SELECT COUNT(*) as count FROM users");
    $count = $result->fetch()['count'];
    echo "✅ Database connection working! Users table has {$count} records.\n";
    
    echo "\n🎉 Database initialization complete!\n";
    echo "\nNext steps:\n";
    echo "1. Configure Discord OAuth credentials in includes/config.php\n";
    echo "2. Configure Stripe webhook secret in premium/webhook.php\n";
    echo "3. Test the payment flow on your website\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "\nPlease check your database credentials in includes/config.php\n";
}
?>
