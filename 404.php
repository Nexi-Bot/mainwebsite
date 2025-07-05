<?php
require_once 'includes/config.php';
$page_title = '404 - Page Not Found';
include 'includes/header.php';
?>

<div class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto text-center">
        <div class="mb-8">
            <h1 class="text-6xl font-bold text-orange-400 mb-4">404</h1>
            <h2 class="text-2xl font-bold text-white mb-4">Page Not Found</h2>
            <p class="text-gray-400 mb-8">
                The page you're looking for doesn't exist or has been moved.
            </p>
        </div>
        
        <div class="space-y-4">
            <a
                href="index.php"
                class="bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 inline-flex items-center gap-2"
            >
                <i data-lucide="home" class="w-5 h-5"></i>
                Go Home
            </a>
            
            <div class="text-center">
                <p class="text-gray-400 mb-4">Or explore these pages:</p>
                <div class="flex flex-wrap justify-center gap-2">
                    <?php foreach ($nav_items as $page => $name): ?>
                        <a
                            href="<?php echo $page; ?>.php"
                            class="text-orange-400 hover:text-orange-300 px-3 py-1 rounded transition-colors duration-200"
                        >
                            <?php echo $name; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize Lucide icons
    lucide.createIcons();
</script>

<?php include 'includes/footer.php'; ?>
