<?php
require_once 'includes/config.php';
require_once 'includes/database.php';

// Simple admin authentication (in production, use proper auth)
session_start();
if (!isset($_GET['admin_key']) || $_GET['admin_key'] !== 'nexi_admin_2025') {
    http_response_code(401);
    exit('Unauthorized');
}

// Get statistics
try {
    $stats = [];
    
    // User statistics
    $result = $db->query("SELECT 
        COUNT(*) as total_users,
        COUNT(CASE WHEN premium_status = 'active' THEN 1 END) as premium_users,
        COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR) THEN 1 END) as new_users_24h
        FROM users");
    $user_stats = $result->fetch();
    
    // Payment statistics
    $result = $db->query("SELECT 
        COUNT(*) as total_payments,
        SUM(amount_paid) as total_revenue,
        COUNT(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR) THEN 1 END) as payments_24h,
        SUM(CASE WHEN created_at >= DATE_SUB(NOW(), INTERVAL 24 HOUR) THEN amount_paid ELSE 0 END) as revenue_24h
        FROM payments WHERE status = 'completed'");
    $payment_stats = $result->fetch();
    
    // Recent activity
    $result = $db->query("SELECT p.*, u.discord_username 
        FROM payments p 
        LEFT JOIN users u ON p.user_id = u.id 
        ORDER BY p.created_at DESC 
        LIMIT 10");
    $recent_payments = $result->fetchAll();
    
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexi Premium Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Auto-refresh every 30 seconds
        setTimeout(() => location.reload(), 30000);
    </script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Nexi Premium Admin Dashboard</h1>
            <div class="text-sm text-gray-600">
                Last updated: <?php echo date('Y-m-d H:i:s'); ?>
                <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Auto-refresh: 30s</span>
            </div>
        </div>

        <?php if (isset($error)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong>Error:</strong> <?php echo htmlspecialchars($error); ?>
            </div>
        <?php else: ?>
            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Users</p>
                            <p class="text-3xl font-bold text-gray-900"><?php echo number_format($user_stats['total_users']); ?></p>
                        </div>
                        <div class="p-3 bg-blue-100 rounded-full">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">+<?php echo $user_stats['new_users_24h']; ?> in last 24h</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Premium Users</p>
                            <p class="text-3xl font-bold text-green-600"><?php echo number_format($user_stats['premium_users']); ?></p>
                        </div>
                        <div class="p-3 bg-green-100 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2"><?php echo round(($user_stats['premium_users'] / max($user_stats['total_users'], 1)) * 100, 1); ?>% conversion</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Revenue</p>
                            <p class="text-3xl font-bold text-purple-600">£<?php echo number_format($payment_stats['total_revenue'] / 100, 2); ?></p>
                        </div>
                        <div class="p-3 bg-purple-100 rounded-full">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">+£<?php echo number_format($payment_stats['revenue_24h'] / 100, 2); ?> in 24h</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Payments</p>
                            <p class="text-3xl font-bold text-indigo-600"><?php echo number_format($payment_stats['total_payments']); ?></p>
                        </div>
                        <div class="p-3 bg-indigo-100 rounded-full">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">+<?php echo $payment_stats['payments_24h']; ?> in 24h</p>
                </div>
            </div>

            <!-- Recent Payments -->
            <div class="bg-white rounded-lg shadow">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Recent Payments</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($recent_payments as $payment): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?php echo htmlspecialchars($payment['discord_username'] ?? 'Unknown'); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo htmlspecialchars($payment['plan_type']); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        £<?php echo number_format($payment['amount_paid'] / 100, 2); ?>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            <?php echo $payment['status'] === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800'; ?>">
                                            <?php echo htmlspecialchars($payment['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <?php echo date('M j, Y H:i', strtotime($payment['created_at'])); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>

        <!-- System Status -->
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">System Health</h3>
            <div id="health-status">Loading...</div>
        </div>
    </div>

    <script>
        // Load health status
        fetch('health.php')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('health-status');
                const isHealthy = data.status === 'healthy';
                
                container.innerHTML = `
                    <div class="flex items-center mb-4">
                        <div class="w-3 h-3 rounded-full ${isHealthy ? 'bg-green-500' : 'bg-red-500'} mr-2"></div>
                        <span class="font-medium ${isHealthy ? 'text-green-700' : 'text-red-700'}">
                            System ${isHealthy ? 'Healthy' : 'Unhealthy'}
                        </span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        ${Object.entries(data.checks).map(([key, check]) => `
                            <div class="p-3 border rounded ${check.status === 'ok' ? 'border-green-200 bg-green-50' : 'border-red-200 bg-red-50'}">
                                <div class="flex items-center">
                                    <div class="w-2 h-2 rounded-full ${check.status === 'ok' ? 'bg-green-500' : 'bg-red-500'} mr-2"></div>
                                    <span class="font-medium capitalize">${key.replace('_', ' ')}</span>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">${check.message}</p>
                            </div>
                        `).join('')}
                    </div>
                `;
            })
            .catch(error => {
                document.getElementById('health-status').innerHTML = 
                    '<div class="text-red-600">Failed to load health status: ' + error.message + '</div>';
            });
    </script>
</body>
</html>
