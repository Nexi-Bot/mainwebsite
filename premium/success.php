<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/header.php';

// Check if user is authenticated
if (!isset($_SESSION['discord_user'])) {
    header('Location: /auth/discord-login');
    exit;
}

$user = $_SESSION['discord_user'];

// Get payment intent from URL parameters
$payment_intent_id = $_GET['payment_intent'] ?? null;
$payment_intent_client_secret = $_GET['payment_intent_client_secret'] ?? null;

if (!$payment_intent_id) {
    header('Location: /features');
    exit;
}

// Verify payment status with Stripe (optional - for extra security)
$payment_verified = true; // You can implement Stripe verification here
?>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Success Icon -->
        <div class="mb-8">
            <div class="w-24 h-24 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="check" class="w-12 h-12 text-white"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-green-400 to-emerald-400 bg-clip-text text-transparent">
                Payment Successful!
            </h1>
            <p class="text-xl text-gray-400">
                Thank you for your purchase, <?php echo htmlspecialchars($user['username']); ?>!
            </p>
        </div>

        <!-- Purchase Details -->
        <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-8 mb-8 max-w-2xl mx-auto">
            <h2 class="text-2xl font-semibold text-white mb-6">What's Next?</h2>
            
            <div class="grid md:grid-cols-2 gap-6 mb-8">
                <!-- Timeline -->
                <div class="text-left">
                    <h3 class="text-lg font-medium text-orange-400 mb-4">Timeline</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i data-lucide="check" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <div class="text-white font-medium">Payment Processed</div>
                                <div class="text-gray-400 text-sm">Just now</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                                <i data-lucide="clock" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <div class="text-white font-medium">Bot Access Available</div>
                                <div class="text-gray-400 text-sm">July 20th, 2025</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center">
                                <i data-lucide="bell" class="w-4 h-4 text-white"></i>
                            </div>
                            <div>
                                <div class="text-white font-medium">Access Notification</div>
                                <div class="text-gray-400 text-sm">We'll notify you when ready</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Important Info -->
                <div class="text-left">
                    <h3 class="text-lg font-medium text-orange-400 mb-4">Important Information</h3>
                    <div class="space-y-3 text-sm text-gray-300">
                        <div class="flex items-start gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-orange-400 mt-0.5 flex-shrink-0"></i>
                            <span>Confirmation email sent to your Discord email</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <i data-lucide="calendar" class="w-4 h-4 text-orange-400 mt-0.5 flex-shrink-0"></i>
                            <span>Premium access begins July 20th, 2025</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <i data-lucide="users" class="w-4 h-4 text-orange-400 mt-0.5 flex-shrink-0"></i>
                            <span>Premium features work in all your Discord servers</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <i data-lucide="shield" class="w-4 h-4 text-orange-400 mt-0.5 flex-shrink-0"></i>
                            <span>Billing handled securely by Stripe</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Access Date Highlight -->
            <div class="bg-orange-900/20 border border-orange-500/30 rounded-xl p-6">
                <div class="flex items-center justify-center gap-3 mb-4">
                    <i data-lucide="calendar-days" class="w-6 h-6 text-orange-400"></i>
                    <h3 class="text-xl font-semibold text-orange-400">Estimated Bot Access Date</h3>
                </div>
                <div class="text-3xl font-bold text-white mb-2">July 20th, 2025</div>
                <p class="text-orange-200">
                    We're working hard to bring you Nexi Premium. You'll be notified via Discord DM when the bot is ready for premium users.
                </p>
            </div>
        </div>

        <!-- Next Steps -->
        <div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto mb-8">
            <!-- Join Discord -->
            <div class="bg-[#5865F2]/10 border border-[#5865F2]/30 rounded-xl p-6">
                <div class="text-center">
                    <i data-lucide="message-circle" class="w-12 h-12 text-[#5865F2] mx-auto mb-4"></i>
                    <h3 class="text-lg font-semibold text-white mb-2">Join Our Discord</h3>
                    <p class="text-gray-400 mb-4">Stay updated with development progress and get support</p>
                    <a 
                        href="<?php echo DISCORD_INVITE; ?>" 
                        target="_blank"
                        class="inline-flex items-center gap-2 bg-[#5865F2] hover:bg-[#4752C4] text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200"
                    >
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                        Join Discord Server
                    </a>
                </div>
            </div>

            <!-- Documentation -->
            <div class="bg-blue-900/20 border border-blue-500/30 rounded-xl p-6">
                <div class="text-center">
                    <i data-lucide="book-open" class="w-12 h-12 text-blue-400 mx-auto mb-4"></i>
                    <h3 class="text-lg font-semibold text-white mb-2">View Documentation</h3>
                    <p class="text-gray-400 mb-4">Learn about all the premium features you'll get access to</p>
                    <a 
                        href="<?php echo DOCUMENTATION_URL; ?>" 
                        target="_blank"
                        class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200"
                    >
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                        Read Documentation
                    </a>
                </div>
            </div>
        </div>

        <!-- Receipt Info -->
        <div class="bg-gray-900/30 border border-gray-700 rounded-xl p-6 max-w-md mx-auto">
            <h3 class="text-lg font-semibold text-white mb-4">Receipt Information</h3>
            <div class="text-sm text-gray-400 space-y-2">
                <div class="flex justify-between">
                    <span>Payment ID:</span>
                    <span class="text-white"><?php echo htmlspecialchars(substr($payment_intent_id, -8)); ?></span>
                </div>
                <div class="flex justify-between">
                    <span>Date:</span>
                    <span class="text-white"><?php echo date('M j, Y'); ?></span>
                </div>
                <div class="flex justify-between">
                    <span>Discord ID:</span>
                    <span class="text-white"><?php echo htmlspecialchars($user['id']); ?></span>
                </div>
            </div>
        </div>

        <!-- Return to Site -->
        <div class="mt-12">
            <a 
                href="/features" 
                class="inline-flex items-center gap-2 bg-gray-700 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-semibold transition-all duration-200"
            >
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Return to Features
            </a>
        </div>
    </div>
</div>

<script>
// Initialize Lucide icons
lucide.createIcons();

// Optional: Add confetti effect or other celebration animations
console.log('🎉 Payment successful! Welcome to Nexi Premium!');
</script>

<?php require_once '../includes/footer.php'; ?>
