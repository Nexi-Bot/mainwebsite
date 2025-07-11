<?php
require_once 'includes/config.php';

// Simple admin authentication
session_start();
if (!isset($_GET['admin_key']) || $_GET['admin_key'] !== 'nexi_admin_2025') {
    http_response_code(401);
    exit('Unauthorized');
}

// Handle coupon creation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        require_once 'vendor/autoload.php';
        \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

        $coupon_data = [
            'id' => $_POST['coupon_id'],
            'duration' => $_POST['duration'],
            'name' => $_POST['name']
        ];

        if ($_POST['discount_type'] === 'percent') {
            $coupon_data['percent_off'] = (int)$_POST['discount_value'];
        } else {
            $coupon_data['amount_off'] = (int)($_POST['discount_value'] * 100); // Convert to pence
            $coupon_data['currency'] = 'gbp';
        }

        if ($_POST['duration'] === 'repeating') {
            $coupon_data['duration_in_months'] = (int)$_POST['duration_months'];
        }

        $coupon = \Stripe\Coupon::create($coupon_data);
        $success_message = "Coupon '{$coupon->id}' created successfully!";

    } catch (Exception $e) {
        $error_message = "Error creating coupon: " . $e->getMessage();
    }
}

// Get existing coupons
$existing_coupons = [];
try {
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);
    
    $coupons = \Stripe\Coupon::all(['limit' => 50]);
    $existing_coupons = $coupons->data;
} catch (Exception $e) {
    $error_message = "Error fetching coupons: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nexi Premium Coupon Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Nexi Premium Coupon Manager</h1>

        <?php if (isset($success_message)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error_message)): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Create New Coupon -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Create New Coupon</h2>
                
                <form method="POST" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Coupon ID</label>
                        <input type="text" name="coupon_id" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                               placeholder="e.g., SUMMER2025" pattern="[A-Z0-9]+" title="Use uppercase letters and numbers only">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Coupon Name</label>
                        <input type="text" name="name" required 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                               placeholder="e.g., Summer 2025 Discount">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Discount Type</label>
                        <select name="discount_type" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                                onchange="toggleDiscountInput(this.value)">
                            <option value="percent">Percentage Off</option>
                            <option value="amount">Fixed Amount Off (£)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            <span id="discount-label">Percentage Off</span>
                        </label>
                        <input type="number" name="discount_value" required min="1" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                               placeholder="10" id="discount-input">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Duration</label>
                        <select name="duration" required 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                                onchange="toggleDurationMonths(this.value)">
                            <option value="once">One-time use</option>
                            <option value="repeating">Repeating (specify months)</option>
                            <option value="forever">Forever</option>
                        </select>
                    </div>

                    <div id="duration-months" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Duration in Months</label>
                        <input type="number" name="duration_months" min="1" max="12" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-500"
                               placeholder="3">
                    </div>

                    <button type="submit" 
                            class="w-full bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-md font-semibold transition-colors">
                        Create Coupon
                    </button>
                </form>
            </div>

            <!-- Existing Coupons -->
            <div class="bg-white rounded-lg shadow p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Existing Coupons</h2>
                
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    <?php foreach ($existing_coupons as $coupon): ?>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-800"><?php echo htmlspecialchars($coupon->id); ?></h3>
                                    <p class="text-sm text-gray-600"><?php echo htmlspecialchars($coupon->name ?: 'No name'); ?></p>
                                </div>
                                <span class="px-2 py-1 text-xs rounded-full <?php echo $coupon->valid ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?>">
                                    <?php echo $coupon->valid ? 'Active' : 'Inactive'; ?>
                                </span>
                            </div>
                            
                            <div class="mt-2 text-sm text-gray-700">
                                <?php if ($coupon->percent_off): ?>
                                    <span class="font-medium"><?php echo $coupon->percent_off; ?>% off</span>
                                <?php else: ?>
                                    <span class="font-medium">£<?php echo number_format($coupon->amount_off / 100, 2); ?> off</span>
                                <?php endif; ?>
                                
                                <?php if ($coupon->duration === 'once'): ?>
                                    <span class="text-gray-500"> • One-time</span>
                                <?php elseif ($coupon->duration === 'repeating'): ?>
                                    <span class="text-gray-500"> • <?php echo $coupon->duration_in_months; ?> months</span>
                                <?php else: ?>
                                    <span class="text-gray-500"> • Forever</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                    <?php if (empty($existing_coupons)): ?>
                        <p class="text-gray-500 text-center py-8">No coupons found</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDiscountInput(type) {
            const label = document.getElementById('discount-label');
            const input = document.getElementById('discount-input');
            
            if (type === 'percent') {
                label.textContent = 'Percentage Off';
                input.placeholder = '10';
                input.max = '100';
            } else {
                label.textContent = 'Amount Off (£)';
                input.placeholder = '5.00';
                input.max = '';
            }
        }

        function toggleDurationMonths(duration) {
            const monthsDiv = document.getElementById('duration-months');
            if (duration === 'repeating') {
                monthsDiv.classList.remove('hidden');
            } else {
                monthsDiv.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
