<?php
session_start();
require_once '../includes/config.php';
require_once '../includes/header.php';

$error_type = $_GET['type'] ?? 'unknown';
$error_message = $_GET['message'] ?? 'An unexpected error occurred.';

$errors = [
    'auth_required' => [
        'title' => 'Authentication Required',
        'message' => 'Please log in with Discord to purchase premium.',
        'action' => 'Login with Discord',
        'action_url' => '/auth/discord-login',
        'icon' => 'user-x'
    ],
    'invalid_plan' => [
        'title' => 'Invalid Plan',
        'message' => 'The selected plan is not valid.',
        'action' => 'View Plans',
        'action_url' => '/features',
        'icon' => 'alert-triangle'
    ],
    'payment_failed' => [
        'title' => 'Payment Failed',
        'message' => $error_message,
        'action' => 'Try Again',
        'action_url' => '/features',
        'icon' => 'credit-card'
    ],
    'stripe_error' => [
        'title' => 'Payment Processing Error',
        'message' => 'There was an issue processing your payment. Please try again.',
        'action' => 'Try Again',
        'action_url' => '/features',
        'icon' => 'alert-circle'
    ]
];

$error = $errors[$error_type] ?? $errors['payment_failed'];
?>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto text-center">
        <!-- Error Icon -->
        <div class="mb-8">
            <div class="w-24 h-24 bg-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <i data-lucide="<?php echo $error['icon']; ?>" class="w-12 h-12 text-white"></i>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4 text-red-400">
                <?php echo htmlspecialchars($error['title']); ?>
            </h1>
            <p class="text-xl text-gray-400">
                <?php echo htmlspecialchars($error['message']); ?>
            </p>
        </div>

        <!-- Error Details -->
        <div class="bg-red-900/20 border border-red-500/30 rounded-2xl p-8 mb-8">
            <h2 class="text-xl font-semibold text-red-400 mb-4">What happened?</h2>
            <div class="text-left text-gray-300 space-y-2">
                <?php if ($error_type === 'auth_required'): ?>
                    <p>• Discord authentication is required to purchase premium</p>
                    <p>• This helps us link your purchase to your Discord account</p>
                    <p>• Your Discord information is kept secure and private</p>
                <?php elseif ($error_type === 'invalid_plan'): ?>
                    <p>• The plan you selected is not available</p>
                    <p>• Please choose from our available premium plans</p>
                    <p>• All plans include the same premium features</p>
                <?php elseif ($error_type === 'payment_failed'): ?>
                    <p>• Your payment could not be processed</p>
                    <p>• This could be due to insufficient funds or card issues</p>
                    <p>• No charge has been made to your account</p>
                <?php else: ?>
                    <p>• There was a technical issue with the payment system</p>
                    <p>• Your payment information was not compromised</p>
                    <p>• Our team has been notified of this issue</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-4">
            <a 
                href="<?php echo $error['action_url']; ?>"
                class="inline-flex items-center gap-2 bg-orange-600 hover:bg-orange-700 text-white px-8 py-4 rounded-lg font-semibold transition-all duration-200"
            >
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                <?php echo htmlspecialchars($error['action']); ?>
            </a>
            
            <div class="text-center">
                <a 
                    href="/features" 
                    class="inline-flex items-center gap-2 text-gray-400 hover:text-white transition-colors"
                >
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    Back to Features
                </a>
            </div>
        </div>

        <!-- Support Info -->
        <div class="mt-12 bg-gray-900/50 border border-gray-800 rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Need Help?</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <a 
                    href="<?php echo DISCORD_INVITE; ?>" 
                    target="_blank"
                    class="flex items-center gap-3 p-4 bg-[#5865F2]/20 border border-[#5865F2]/30 rounded-lg hover:bg-[#5865F2]/30 transition-colors"
                >
                    <i data-lucide="message-circle" class="w-6 h-6 text-[#5865F2]"></i>
                    <div class="text-left">
                        <div class="text-white font-medium">Discord Support</div>
                        <div class="text-gray-400 text-sm">Get help from our team</div>
                    </div>
                </a>
                
                <a 
                    href="<?php echo DOCUMENTATION_URL; ?>" 
                    target="_blank"
                    class="flex items-center gap-3 p-4 bg-blue-900/20 border border-blue-500/30 rounded-lg hover:bg-blue-900/30 transition-colors"
                >
                    <i data-lucide="book-open" class="w-6 h-6 text-blue-400"></i>
                    <div class="text-left">
                        <div class="text-white font-medium">Documentation</div>
                        <div class="text-gray-400 text-sm">View help articles</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Initialize Lucide icons
lucide.createIcons();
</script>

<?php require_once '../includes/footer.php'; ?>
