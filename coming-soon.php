<?php
require_once 'includes/config.php';
require_once 'includes/header.php';
?>

<div class="min-h-screen flex items-center justify-center py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto text-center">
        <!-- Main Content -->
        <div class="mb-16">
            <!-- Icon/Logo -->
            <div class="mb-8">
                <div class="w-24 h-24 mx-auto bg-gradient-to-r from-orange-400 to-red-400 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>

            <!-- Heading -->
            <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent">
                Coming Soon
            </h1>
            
            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-gray-400 mb-8 max-w-2xl mx-auto">
                We're working hard to bring you something amazing. This feature will be available soon!
            </p>

            <!-- Description -->
            <div class="bg-gray-900/50 border border-gray-800 rounded-xl p-8 mb-12 max-w-2xl mx-auto">
                <p class="text-gray-300 text-lg leading-relaxed">
                    Our team is currently developing this feature to provide you with the best possible experience. 
                    Stay tuned for updates and be the first to know when it's ready!
                </p>
            </div>

            <!-- Features Preview -->
            <div class="grid md:grid-cols-3 gap-6 mb-12">
                <div class="bg-gray-900/30 border border-gray-800 rounded-lg p-6">
                    <div class="w-12 h-12 bg-orange-500/20 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Fast & Reliable</h3>
                    <p class="text-gray-400 text-sm">Built for performance and reliability</p>
                </div>

                <div class="bg-gray-900/30 border border-gray-800 rounded-lg p-6">
                    <div class="w-12 h-12 bg-orange-500/20 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 100 4m0-4v2m0-6V4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">User Friendly</h3>
                    <p class="text-gray-400 text-sm">Intuitive design for easy navigation</p>
                </div>

                <div class="bg-gray-900/30 border border-gray-800 rounded-lg p-6">
                    <div class="w-12 h-12 bg-orange-500/20 rounded-lg flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-white mb-2">Secure</h3>
                    <p class="text-gray-400 text-sm">Enterprise-grade security measures</p>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/home" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
                <a href="https://status.nexibot.uk" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center px-6 py-3 border border-gray-600 text-base font-medium rounded-lg text-gray-300 hover:text-white hover:border-gray-500 transition-all duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Service Status
                </a>
            </div>
        </div>

        <!-- Progress Indicator -->
        <div class="max-w-md mx-auto">
            <div class="flex items-center justify-between text-sm text-gray-400 mb-2">
                <span>Progress</span>
                <span>Coming Soon...</span>
            </div>
            <div class="w-full bg-gray-800 rounded-full h-2">
                <div class="bg-gradient-to-r from-orange-400 to-red-400 h-2 rounded-full animate-pulse" style="width: 65%"></div>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
