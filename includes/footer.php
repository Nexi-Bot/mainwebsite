    <footer class="bg-black border-t border-orange-500/20 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid md:grid-cols-4 gap-8">
                <!-- Logo and Description -->
                <div class="md:col-span-2">
                    <div class="flex items-center mb-4">
                        <img 
                            src="images/lovable-uploads/e76a24f5-4bd9-4d5d-8f70-e1940b40a17c.png" 
                            alt="Nexi" 
                            class="h-12 w-auto"
                        />
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Supercharge your Discord server with Nexi's powerful automation, moderation, and engagement tools.
                    </p>
                    <div class="flex space-x-4">
                        <a 
                            href="<?php echo DISCORD_INVITE; ?>" 
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-orange-400 hover:text-orange-300 transition-colors duration-200"
                        >
                            <i data-lucide="message-square" class="w-6 h-6"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <?php foreach ($nav_items as $page => $name): ?>
                            <li>
                                <a 
                                    href="<?php echo $page; ?>.php"
                                    class="text-gray-400 hover:text-orange-400 transition-colors duration-200"
                                >
                                    <?php echo $name; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- External Links -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Resources</h3>
                    <ul class="space-y-2">
                        <?php foreach ($external_links as $link): ?>
                            <?php
                            $is_external = strpos($link['url'], 'http') === 0;
                            $target = $is_external ? 'target="_blank" rel="noopener noreferrer"' : '';
                            ?>
                            <li>
                                <a 
                                    href="<?php echo $link['url']; ?>"
                                    <?php echo $target; ?>
                                    class="text-gray-400 hover:text-orange-400 transition-colors duration-200 flex items-center gap-1"
                                >
                                    <?php echo $link['name']; ?>
                                    <?php if ($is_external): ?>
                                        <i data-lucide="external-link" class="w-3 h-3"></i>
                                    <?php endif; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                        <li>
                            <a 
                                href="<?php echo DISCORD_INVITE; ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="text-gray-400 hover:text-orange-400 transition-colors duration-200 flex items-center gap-1"
                            >
                                Join Discord
                                <i data-lucide="external-link" class="w-3 h-3"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="mt-8 pt-8 border-t border-orange-500/20 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © <?php echo date('Y'); ?> <?php echo SITE_NAME; ?>. All rights reserved.
                </p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="legal.php" class="text-gray-400 hover:text-orange-400 text-sm transition-colors duration-200">
                        Privacy Policy
                    </a>
                    <a href="legal.php" class="text-gray-400 hover:text-orange-400 text-sm transition-colors duration-200">
                        Terms of Service
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Reinitialize Lucide icons for footer
        lucide.createIcons();
    </script>
</body>
</html>
