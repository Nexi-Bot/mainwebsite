<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' . SITE_NAME : SITE_NAME; ?></title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16.png">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        orange: {
                            300: '#fed7aa',
                            400: '#fb923c',
                            500: '#f97316',
                            600: '#ea580c',
                            700: '#c2410c',
                            800: '#9a3412',
                            900: '#7c2d12'
                        }
                    }
                }
            }
        }
    </script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        body {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>
<body class="bg-black text-white">
    <header class="bg-black border-b border-orange-500/20 sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="index.php" class="flex items-center bg-black px-4 py-2 rounded">
                        <img 
                            src="images/lovable-uploads/e76a24f5-4bd9-4d5d-8f70-e1940b40a17c.png" 
                            alt="Nexi" 
                            class="h-16 w-auto"
                        />
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <?php foreach ($nav_items as $page => $name): ?>
                            <a
                                href="<?php echo $page; ?>.php"
                                class="px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 <?php echo ($current_page === $page) ? 'bg-orange-600 text-white' : 'text-white hover:bg-orange-500/20 hover:text-orange-400'; ?>"
                            >
                                <?php echo $name; ?>
                            </a>
                        <?php endforeach; ?>
                        
                        <!-- External Links -->
                        <?php foreach ($external_links as $link): ?>
                            <?php
                            $is_external = strpos($link['url'], 'http') === 0;
                            $target = $is_external ? 'target="_blank" rel="noopener noreferrer"' : '';
                            ?>
                            <a
                                href="<?php echo $link['url']; ?>"
                                <?php echo $target; ?>
                                class="px-3 py-2 rounded-md text-sm font-medium text-white hover:bg-orange-500/20 hover:text-orange-400 transition-colors duration-200 flex items-center gap-1"
                            >
                                <?php echo $link['name']; ?>
                                <?php if ($is_external): ?>
                                    <i data-lucide="external-link" class="w-4 h-4"></i>
                                <?php endif; ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button 
                        type="button" 
                        class="bg-black inline-flex items-center justify-center p-2 rounded-md text-orange-400 hover:text-white hover:bg-orange-500/20 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        id="mobile-menu-button"
                    >
                        <span class="sr-only">Open main menu</span>
                        <i data-lucide="menu" class="block h-6 w-6" id="menu-icon"></i>
                        <i data-lucide="x" class="hidden h-6 w-6" id="close-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-black border-t border-orange-500/20">
                    <?php foreach ($nav_items as $page => $name): ?>
                        <a
                            href="<?php echo $page; ?>.php"
                            class="block px-3 py-2 rounded-md text-base font-medium <?php echo ($current_page === $page) ? 'bg-orange-600 text-white' : 'text-white hover:bg-orange-500/20 hover:text-orange-400'; ?>"
                        >
                            <?php echo $name; ?>
                        </a>
                    <?php endforeach; ?>
                    
                    <!-- External Links Mobile -->
                    <?php foreach ($external_links as $link): ?>
                        <?php
                        $is_external = strpos($link['url'], 'http') === 0;
                        $target = $is_external ? 'target="_blank" rel="noopener noreferrer"' : '';
                        ?>
                        <a
                            href="<?php echo $link['url']; ?>"
                            <?php echo $target; ?>
                            class="block px-3 py-2 rounded-md text-base font-medium text-white hover:bg-orange-500/20 hover:text-orange-400 flex items-center gap-2"
                        >
                            <?php echo $link['name']; ?>
                            <?php if ($is_external): ?>
                                <i data-lucide="external-link" class="w-4 h-4"></i>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </nav>
    </header>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            menu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
        
        // Initialize Lucide icons
        lucide.createIcons();
    </script>
