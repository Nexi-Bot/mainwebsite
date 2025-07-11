<?php
require_once 'includes/config.php';
require_once 'includes/header.php';

// Check if user is authenticated for premium purchase
$user_authenticated = isset($_SESSION['discord_user']);
$discord_user = $user_authenticated ? $_SESSION['discord_user'] : null;
?>

<!-- Premium Pricing Section -->
<section class="relative py-20 px-4 sm:px-6 lg:px-8 bg-gradient-to-br from-gray-900 via-black to-gray-800">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center px-4 py-2 bg-orange-500/20 border border-orange-500/30 rounded-full text-orange-400 text-sm font-medium mb-6">
                <i data-lucide="zap" class="w-4 h-4 mr-2"></i>
                Early Access Presale - Limited Time
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent">
                The Best Features at the Best Prices
            </h2>
            <div class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-yellow-600/20 to-orange-600/20 border border-yellow-500/30 rounded-xl text-yellow-400 font-semibold text-lg mb-8">
                <i data-lucide="star" class="w-5 h-5 mr-2"></i>
                Nexi Premium Early Access - Available July 20th, 2025
            </div>
        </div>

        <!-- Pricing Cards -->
        <div class="grid md:grid-cols-3 gap-8 mb-12">
            <!-- Monthly Plan -->
            <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-8 relative">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-white mb-4">Monthly</h3>
                    <div class="mb-6">
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <span class="text-3xl font-bold text-orange-400">£2.99</span>
                            <span class="text-gray-400">/month</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="line-through">£4.99</span> first month only
                        </div>
                        <div class="text-sm text-green-400 font-medium">Save £2.00</div>
                    </div>
                    <p class="text-gray-400 mb-8">Perfect for trying premium features</p>
                    <button 
                        onclick="startCheckout('monthly')" 
                        class="w-full bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200"
                        <?php echo !$user_authenticated ? 'disabled' : ''; ?>
                    >
                        <?php echo $user_authenticated ? 'Get Early Access' : 'Login Required'; ?>
                    </button>
                </div>
            </div>

            <!-- Yearly Plan - Most Popular -->
            <div class="bg-gray-900/50 border-2 border-orange-500 rounded-2xl p-8 relative">
                <div class="absolute -top-4 left-1/2 transform -translate-x-1/2">
                    <span class="bg-orange-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                        Most Popular
                    </span>
                </div>
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-white mb-4">Yearly</h3>
                    <div class="mb-6">
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <span class="text-3xl font-bold text-orange-400">£24</span>
                            <span class="text-gray-400">/year</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="line-through">£35</span> first year only
                        </div>
                        <div class="text-sm text-green-400 font-medium">Save £11 (31%)</div>
                    </div>
                    <p class="text-gray-400 mb-8">Best value for long-term use</p>
                    <button 
                        onclick="startCheckout('yearly')" 
                        class="w-full bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200"
                        <?php echo !$user_authenticated ? 'disabled' : ''; ?>
                    >
                        <?php echo $user_authenticated ? 'Get Early Access' : 'Login Required'; ?>
                    </button>
                </div>
            </div>

            <!-- Lifetime Plan -->
            <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-8 relative">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-white mb-4">Lifetime</h3>
                    <div class="mb-6">
                        <div class="flex items-center justify-center gap-2 mb-2">
                            <span class="text-3xl font-bold text-orange-400">£79</span>
                            <span class="text-gray-400">one-time</span>
                        </div>
                        <div class="text-sm text-gray-500">
                            <span class="line-through">£120</span> normal price
                        </div>
                        <div class="text-sm text-green-400 font-medium">Save £41 (34%)</div>
                    </div>
                    <p class="text-gray-400 mb-8">Pay once, use forever</p>
                    <button 
                        onclick="startCheckout('lifetime')" 
                        class="w-full bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200"
                        <?php echo !$user_authenticated ? 'disabled' : ''; ?>
                    >
                        <?php echo $user_authenticated ? 'Get Early Access' : 'Login Required'; ?>
                    </button>
                </div>
            </div>
        </div>

        <!-- Important Notice -->
        <div class="bg-yellow-900/20 border border-yellow-500/30 rounded-xl p-6 mb-8">
            <div class="flex items-start gap-3">
                <i data-lucide="alert-triangle" class="w-6 h-6 text-yellow-400 mt-1 flex-shrink-0"></i>
                <div>
                    <h4 class="font-semibold text-yellow-400 mb-2">Important Pricing Information</h4>
                    <ul class="text-yellow-200 text-sm space-y-1">
                        <li>• Early access pricing is only guaranteed for your first billing period (month/year) or lifetime purchase</li>
                        <li>• Regular pricing applies after the initial period ends (unless you purchase lifetime access)</li>
                        <li>• Monthly: £2.99 first month, then £4.99/month from August 20th, 2025</li>
                        <li>• Yearly: £24 first year, then £35/year from July 20th, 2026</li>
                        <li>• Lifetime: £79 one-time payment, never billed again</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Billing Schedule -->
        <div class="bg-blue-900/20 border border-blue-500/30 rounded-xl p-6">
            <div class="flex items-start gap-3">
                <i data-lucide="calendar" class="w-6 h-6 text-blue-400 mt-1 flex-shrink-0"></i>
                <div>
                    <h4 class="font-semibold text-blue-400 mb-2">Billing Schedule</h4>
                    <ul class="text-blue-200 text-sm space-y-1">
                        <li>• <strong>Today:</strong> Pay discounted rate for early access</li>
                        <li>• <strong>July 20th, 2025:</strong> Get access to Nexi Bot Premium features</li>
                        <li>• <strong>Monthly:</strong> Next billing on August 20th, 2025 at regular price</li>
                        <li>• <strong>Yearly:</strong> Next billing on July 20th, 2026 at regular price</li>
                        <li>• <strong>Lifetime:</strong> No future billing, you own it forever</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Login Prompt for Non-authenticated Users -->
        <?php if (!$user_authenticated): ?>
        <div class="text-center mt-12">
            <div class="bg-gray-900/50 border border-gray-700 rounded-xl p-8 max-w-md mx-auto">
                <i data-lucide="user-check" class="w-12 h-12 text-orange-400 mx-auto mb-4"></i>
                <h3 class="text-xl font-semibold text-white mb-4">Discord Login Required</h3>
                <p class="text-gray-400 mb-6">Please login with Discord to purchase Nexi Premium</p>
                <a 
                    href="/auth/discord-login"
                    class="inline-flex items-center gap-2 bg-[#5865F2] hover:bg-[#4752C4] text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200"
                >
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    Login with Discord
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<script>
function startCheckout(planType) {
    <?php if ($user_authenticated): ?>
    // Redirect to checkout page with plan type
    window.location.href = `/premium/checkout?plan=${planType}`;
    <?php else: ?>
    // Redirect to Discord login
    window.location.href = '/auth/discord-login';
    <?php endif; ?>
}
</script>

<?php
$features = [
    ['name' => 'Welcome Messages', 'free' => true, 'premium' => true],
    ['name' => 'Server Stats', 'free' => true, 'premium' => true],
    ['name' => 'Custom embeds with buttons and drop-down menus', 'free' => true, 'premium' => true],
    ['name' => 'Sticky Messages', 'free' => true, 'premium' => true],
    ['name' => 'LOA Requests', 'free' => true, 'premium' => true],
    ['name' => 'Question of the Day', 'free' => true, 'premium' => true],
    ['name' => 'Staff Feedback System', 'free' => true, 'premium' => true],
    ['name' => 'Give review command', 'free' => true, 'premium' => true],
    ['name' => '/promote and /infract commands', 'free' => true, 'premium' => true],
    ['name' => '/suggest and staff feedback commands', 'free' => true, 'premium' => true],
    ['name' => '/suggest Command with Voting', 'free' => true, 'premium' => true],
    ['name' => 'Logging system', 'free' => true, 'premium' => true],
    ['name' => 'Advanced Moderation & Server Management', 'free' => true, 'premium' => true],
    ['name' => 'Economy', 'free' => true, 'premium' => true],
    ['name' => 'Limited Support Ticket Functions', 'free' => true, 'premium' => true],
    ['name' => '/announce command', 'free' => true, 'premium' => true],
    ['name' => 'Spotify music bot & connect to shockwaves radio', 'free' => true, 'premium' => true],
    ['name' => 'Roblox Shift Logging', 'free' => true, 'premium' => true],
    ['name' => 'Giveaways', 'free' => true, 'premium' => true],
    ['name' => 'Roblox Member Counter Webhook', 'free' => true, 'premium' => true],
    ['name' => 'Roblox verification & Role Binding', 'free' => true, 'premium' => true],
    ['name' => 'Full Support Ticket Functions', 'free' => false, 'premium' => true],
    ['name' => 'Google Sheets integration', 'free' => false, 'premium' => true],
    ['name' => 'Order system', 'free' => false, 'premium' => true],
    ['name' => 'Shop integration with Roblox', 'free' => false, 'premium' => true],
    ['name' => 'Roblox & Discord Ban Appeals', 'free' => false, 'premium' => true],
    ['name' => 'AI Moderation', 'free' => false, 'premium' => true],
    ['name' => 'Roblox application centre integration', 'free' => false, 'premium' => true],
    ['name' => 'Jotform, Google Calendar & Google form integrations', 'free' => false, 'premium' => true],
    ['name' => 'ERLC Integrations', 'free' => false, 'premium' => true],
    ['name' => 'Custom Commands', 'free' => false, 'premium' => true],
];

$pricingTiers = [
    [
        'name' => 'Monthly',
        'price' => '£3.99',
        'period' => '/month',
        'description' => 'Perfect for trying premium features',
        'popular' => false,
    ],
    [
        'name' => 'Yearly',
        'price' => '£31',
        'period' => '/year',
        'description' => '35% savings compared to monthly',
        'popular' => true,
    ],
    [
        'name' => 'Lifetime',
        'price' => '£100',
        'period' => 'one-time',
        'description' => 'Pay once, use forever',
        'popular' => false,
    ],
];
?>

<div class="min-h-screen py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent">
                The Most Features in a Discord Bot
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto">
                Compare our free and premium features to see what Nexi can do for your Discord server.
            </p>
        </div>

        <!-- Pricing Section -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                The Best Features at the Best Prices
            </h2>
            <div class="bg-yellow-500/20 border border-yellow-500/50 rounded-lg p-4 max-w-md mx-auto mb-8">
                <p class="text-yellow-300 font-semibold">Nexi Premium Coming Soon!</p>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <?php foreach ($pricingTiers as $index => $tier): ?>
                <div class="relative bg-gray-900/50 border rounded-xl p-8 transition-all duration-300 hover:scale-105 <?php echo $tier['popular'] ? 'border-orange-500 ring-2 ring-orange-500/20' : 'border-gray-800 hover:border-orange-500/50'; ?>">
                    <?php if ($tier['popular']): ?>
                        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                            <span class="bg-gradient-to-r from-orange-600 to-red-600 text-white px-4 py-1 rounded-full text-sm font-semibold">
                                Most Popular
                            </span>
                        </div>
                    <?php endif; ?>
                    <div class="text-center">
                        <h3 class="text-xl font-semibold mb-4"><?php echo htmlspecialchars($tier['name']); ?></h3>
                        <div class="mb-4">
                            <span class="text-3xl font-bold text-orange-400"><?php echo htmlspecialchars($tier['price']); ?></span>
                            <span class="text-gray-400"><?php echo htmlspecialchars($tier['period']); ?></span>
                            <?php if ($tier['name'] === 'Yearly'): ?>
                                <div class="text-green-400 text-sm font-medium mt-1">Save 35%</div>
                            <?php endif; ?>
                        </div>
                        <p class="text-gray-400 mb-6"><?php echo htmlspecialchars($tier['description']); ?></p>
                        <button
                            disabled
                            class="w-full bg-gray-700 text-gray-400 px-6 py-3 rounded-lg font-semibold cursor-not-allowed"
                        >
                            Coming Soon
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Features Table -->
        <div class="bg-gray-900/50 border border-gray-800 rounded-xl overflow-hidden mb-16">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-800/50">
                        <tr>
                            <th class="text-left py-4 px-6 font-semibold text-white">FEATURE</th>
                            <th class="text-center py-4 px-6 font-semibold text-white">FREE</th>
                            <th class="text-center py-4 px-6 font-semibold text-orange-400">PREMIUM</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        <?php foreach ($features as $index => $feature): ?>
                            <tr class="hover:bg-gray-800/30 transition-colors duration-200">
                                <td class="py-4 px-6 text-gray-300"><?php echo htmlspecialchars($feature['name']); ?></td>
                                <td class="py-4 px-6 text-center">
                                    <?php if ($feature['free']): ?>
                                        <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    <?php else: ?>
                                        <svg class="w-5 h-5 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    <?php endif; ?>
                                </td>
                                <td class="py-4 px-6 text-center">
                                    <?php if ($feature['premium']): ?>
                                        <svg class="w-5 h-5 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    <?php else: ?>
                                        <svg class="w-5 h-5 text-red-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
