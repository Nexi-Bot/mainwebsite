<?php
require_once 'includes/config.php';
require_once 'includes/header.php';
?>

<div class="min-h-screen bg-black text-white">
    <!-- Hero Section -->
    <section class="relative py-20 px-4 sm:px-6 lg:px-8 overflow-hidden">
        <div 
            class="absolute inset-0 bg-cover bg-center bg-no-repeat opacity-10"
            style="background-image: url('images/lovable-uploads/20533282-c1e8-49e0-a3b6-ffb5dc6ea189.png'); background-size: contain; background-position: center;"
        ></div>
        <div class="absolute inset-0 bg-gradient-to-br from-orange-900/20 via-orange-800/20 to-black/20"></div>
        <div class="relative max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-orange-400 via-orange-500 to-orange-300 bg-clip-text text-transparent">
                Your Server, Supercharged
            </h1>
            <p class="text-xl md:text-2xl text-gray-300 mb-8 max-w-3xl mx-auto">
                Transform your Discord server with Nexi's powerful automation, moderation, and engagement tools. 
                Join lots of communities already using Nexi to enhance their server experience.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a
                    href="features"
                    class="bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2"
                >
                    Explore Features
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
                <a
                    href="https://discord.com/invite/nexibot"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="border border-orange-500 text-orange-400 hover:bg-orange-500 hover:text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 flex items-center justify-center gap-2"
                >
                    Join Discord
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-black/50">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-orange-400 mb-2">
                        9
                    </div>
                    <div class="text-gray-300 font-medium">
                        Active Servers
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-orange-400 mb-2">
                        50
                    </div>
                    <div class="text-gray-300 font-medium">
                        Total Users
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-orange-400 mb-2">
                        200+
                    </div>
                    <div class="text-gray-300 font-medium">
                        Commands Processed
                    </div>
                </div>
                <div class="text-center">
                    <div class="text-3xl md:text-4xl font-bold text-orange-400 mb-2">
                        100%
                    </div>
                    <div class="text-gray-300 font-medium">
                        Uptime
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Preview -->
    <section class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">
                    Why Choose Nexi?
                </h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Discover the powerful features that make Nexi the perfect choice for Discord server management.
                </p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-black/50 border border-orange-500/20 rounded-xl p-6 hover:border-orange-500/50 transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-600 to-orange-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Advanced Communication</h3>
                    <p class="text-gray-300">Custom embeds, welcome messages, and announcement systems to keep your community engaged.</p>
                </div>
                <div class="bg-black/50 border border-orange-500/20 rounded-xl p-6 hover:border-orange-500/50 transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-600 to-orange-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Powerful Moderation</h3>
                    <p class="text-gray-300">Comprehensive moderation tools with logging, auto-moderation, and staff management features.</p>
                </div>
                <div class="bg-black/50 border border-orange-500/20 rounded-xl p-6 hover:border-orange-500/50 transition-all duration-300">
                    <div class="w-12 h-12 bg-gradient-to-r from-orange-600 to-orange-500 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-5 5-5-5h5zM15 7h5l-5-5-5 5h5zm-5 10V7m0 10a2 2 0 01-2-2V9a2 2 0 012-2m0 10a2 2 0 002-2V9a2 2 0 00-2-2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-white">Smart Notifications</h3>
                    <p class="text-gray-300">Keep your community informed with intelligent notification systems and server statistics.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-orange-900/20 to-orange-800/20">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6 text-white">
                Ready to Join Our Team?
            </h2>
            <p class="text-xl text-gray-300 mb-8">
                We're always looking for talented individuals to help us build the future of Discord server management.
            </p>
            <a
                href="careers"
                class="bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 inline-flex items-center gap-2"
            >
                View Open Positions
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </section>
</div>

<?php require_once 'includes/footer.php'; ?>
