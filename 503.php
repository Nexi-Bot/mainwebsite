<?php
require_once 'includes/config.php';
$page_title = '503 - Service Unavailable';
include 'includes/header.php';
?>

<div class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto text-center">
        <div class="mb-8">
            <h1 class="text-6xl font-bold text-orange-400 mb-4">503</h1>
            <h2 class="text-2xl font-bold text-white mb-4">Service Unavailable</h2>
            <p class="text-gray-400 mb-8">
                The server is temporarily unavailable due to maintenance or overload. Please try again in a few minutes.
            </p>
        </div>
        
        <div class="bg-gray-900/50 border border-gray-800 rounded-xl p-6 mb-8">
            <div class="flex items-center justify-center mb-4">
                <i data-lucide="clock" class="w-8 h-8 text-orange-400"></i>
            </div>
            <p class="text-gray-300 text-sm">
                We're performing scheduled maintenance to improve your experience. We'll be back shortly!
            </p>
        </div>
        
        <div class="space-y-4">
            <a
                href="/home"
                class="bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 inline-flex items-center gap-2"
            >
                <i data-lucide="home" class="w-5 h-5"></i>
                Try Homepage
            </a>
            
            <div class="text-center">
                <p class="text-gray-400 mb-4">Or check our service status:</p>
                <a
                    href="https://status.nexibot.uk"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-semibold transition-all duration-200 inline-flex items-center gap-2"
                >
                    <i data-lucide="external-link" class="w-4 h-4"></i>
                    Service Status
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>

<?php include 'includes/footer.php'; ?>
