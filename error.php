<?php
require_once 'includes/config.php';

// Get the error code from query parameter or default to 'Unknown'
$error_code = isset($_GET['code']) ? (int)$_GET['code'] : 'Unknown';
$error_message = isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'An unexpected error occurred';

// Define error messages for common codes
$error_descriptions = [
    400 => 'The request could not be understood by the server due to malformed syntax.',
    401 => 'Authentication is required to access this resource.',
    403 => 'You don\'t have permission to access this resource.',
    404 => 'The page you\'re looking for doesn\'t exist or has been moved.',
    405 => 'The request method is not allowed for this resource.',
    408 => 'The server timed out waiting for the request.',
    429 => 'Too many requests have been sent in a given amount of time.',
    500 => 'Something went wrong on our server.',
    502 => 'The server received an invalid response from an upstream server.',
    503 => 'The server is temporarily unavailable due to maintenance or overload.',
    504 => 'The server did not receive a timely response from an upstream server.'
];

$description = isset($error_descriptions[$error_code]) ? $error_descriptions[$error_code] : $error_message;
$page_title = $error_code . ' - Error';

include 'includes/header.php';
?>

<div class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md mx-auto text-center">
        <div class="mb-8">
            <h1 class="text-6xl font-bold text-orange-400 mb-4"><?php echo $error_code; ?></h1>
            <h2 class="text-2xl font-bold text-white mb-4">Error Occurred</h2>
            <p class="text-gray-400 mb-8">
                <?php echo $description; ?>
            </p>
        </div>
        
        <div class="space-y-4">
            <a
                href="/home"
                class="bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 inline-flex items-center gap-2"
            >
                <i data-lucide="home" class="w-5 h-5"></i>
                Go Home
            </a>
            
            <div class="text-center">
                <p class="text-gray-400 mb-4">Or try refreshing the page:</p>
                <button
                    onclick="window.location.reload()"
                    class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg font-semibold transition-all duration-200 inline-flex items-center gap-2"
                >
                    <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                    Refresh Page
                </button>
            </div>
            
            <div class="text-center">
                <p class="text-gray-400 mb-4">Or explore these pages:</p>
                <div class="flex flex-wrap justify-center gap-2">
                    <?php foreach ($nav_items as $page => $name): ?>
                        <a
                            href="/<?php echo $page; ?>"
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
