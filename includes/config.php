<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Site configuration
define('SITE_NAME', 'Nexi');
define('SITE_URL', 'https://your-domain.com');
define('DISCORD_INVITE', 'https://discord.com/invite/nexibot');
define('DASHBOARD_URL', 'https://billing.stripe.com/p/login/14keYK0nd3sk2SA144');
define('DOCUMENTATION_URL', 'https://documentation.nexibot.uk/');
define('WEBHOOK_URL', 'https://discord.com/api/webhooks/1389607927983116370/GlPRFlYzMZLTgiF9eANM5QeGZ1PqP8_mB9XUk7kybxnEzht9oo5FsgIyMyRwwCkx6Vzl');

// Database configuration
define('DB_HOST', '65.21.61.192');
define('DB_PORT', '3306');
define('DB_USER', 'u25473_Y8CkMsMHyp');
define('DB_PASS', 'rlALotgMWdSy^8flYbx0PYS@');
define('DB_NAME', 's25473_NexiBotDatabase');

// Stripe configuration
define('STRIPE_PUBLISHABLE_KEY', 'pk_live_51RgSvsHxd4KTYsDdodmX55cZkcaGwzXGgARw7yvfH4d8iZhUKUiKT7MGHyboIsnoAZkmsSovqrpJh2ajldqcc7te00gdwtNGiB');
define('STRIPE_SECRET_KEY', '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');

// Discord OAuth configuration
define('DISCORD_CLIENT_ID', 'YOUR_DISCORD_CLIENT_ID'); // You'll need to provide this from Discord Developer Portal
define('DISCORD_CLIENT_SECRET', 'YOUR_DISCORD_CLIENT_SECRET'); // You'll need to provide this from Discord Developer Portal
define('DISCORD_REDIRECT_URI', 'https://nexibot.uk/auth/discord-callback');

// Premium pricing configuration
define('PRESALE_END_DATE', '2025-07-20'); // When presale ends
define('EARLY_ACCESS_DATE', '2025-07-20'); // When users get access to the bot

// Get current page for navigation
$current_page = basename($_SERVER['PHP_SELF'], '.php');
// Handle the special case where index.php should be treated as 'home'
if ($current_page === 'index') {
    $current_page = 'home';
}

// Navigation items (using clean URLs)
$nav_items = [
    'home' => 'Home',
    'features' => 'Features',
    'careers' => 'Careers',
    'team' => 'Meet the Team',
    'legal' => 'Legal'
];

// External links (using clean URLs for internal pages)
$external_links = [
    ['name' => 'Dashboard', 'url' => 'coming-soon'],
    ['name' => 'Documentation', 'url' => 'coming-soon'],
    ['name' => 'Status', 'url' => 'https://status.nexibot.uk']
];

// Stats data
$stats = [
    ['label' => 'Active Servers', 'value' => '9'],
    ['label' => 'Total Users', 'value' => '50'],
    ['label' => 'Commands Processed', 'value' => '200+'],
    ['label' => 'Uptime', 'value' => '100%']
];

// Features data
$home_features = [
    [
        'icon' => 'message-square',
        'title' => 'Advanced Communication',
        'description' => 'Custom embeds, welcome messages, and announcement systems to keep your community engaged.'
    ],
    [
        'icon' => 'shield',
        'title' => 'Powerful Moderation',
        'description' => 'Comprehensive moderation tools with logging, auto-moderation, and staff management features.'
    ],
    [
        'icon' => 'bell',
        'title' => 'Smart Notifications',
        'description' => 'Keep your community informed with intelligent notification systems and server statistics.'
    ]
];

// Team members
$team_members = [
    [
        'name' => 'Swift',
        'role' => 'CEO & Founder',
        'description' => 'Visionary leader driving Nexi\'s mission to revolutionize Discord server management.',
        'image' => 'images/lovable-uploads/swift.png'
    ],
    [
        'name' => 'Ben',
        'role' => 'CTO & Co-Founder',
        'description' => 'Technical mastermind behind Nexi\'s powerful features and infrastructure.',
        'image' => 'images/lovable-uploads/ben.png'
    ],
    [
        'name' => 'Ollie',
        'role' => 'Lead Developer',
        'description' => 'Expert developer crafting seamless user experiences and robust bot functionality.',
        'image' => 'images/lovable-uploads/olllie.png'
    ],
    [
        'name' => 'Paige',
        'role' => 'Community Manager',
        'description' => 'Building bridges between Nexi and our amazing community of users.',
        'image' => 'images/lovable-uploads/paige.png'
    ],
    [
        'name' => 'Amida',
        'role' => 'Creative Director',
        'description' => 'Bringing visual excellence and brand consistency to everything Nexi.',
        'image' => 'images/lovable-uploads/amida.png'
    ],
    [
        'name' => 'Chukwuma',
        'role' => 'Quality Assurance Lead',
        'description' => 'Ensuring every feature meets our high standards of reliability and performance.',
        'image' => 'images/lovable-uploads/chukwumam.png'
    ]
];

// Career positions
$positions = [
    [
        'id' => 'moderator',
        'title' => 'Westgate Server Moderator',
        'icon' => 'users',
        'description' => 'Ensure the community and roleplay standards are being upheld.'
    ],
    [
        'id' => 'development',
        'title' => 'Development Team',
        'icon' => 'code',
        'description' => 'Develop and maintain the bot or our website to enhance user experience and automate tasks within nexi.'
    ],
    [
        'id' => 'analytics',
        'title' => 'Analytics Team',
        'icon' => 'bar-chart',
        'description' => 'The Analytics Team analyzes data and collects customer feedback.'
    ],
    [
        'id' => 'customer-experience',
        'title' => 'Customer Experience Team',
        'icon' => 'heart',
        'description' => 'Provide excellent customer support and ensure smooth communication with our users.'
    ],
    [
        'id' => 'legal',
        'title' => 'Legal Team',
        'icon' => 'file-text',
        'description' => 'Be responsible for documents, contracts, paperwork, companies house, finance etc.'
    ],
    [
        'id' => 'marketing',
        'title' => 'Marketing Team',
        'icon' => 'message-square',
        'description' => 'The Marketing Team promotes Nexi\'s brand, drives growth, and manages external communications.'
    ]
];

// Features comparison data
$features_list = [
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
    ['name' => 'Custom Commands', 'free' => false, 'premium' => true]
];

// Pricing tiers
$pricing_tiers = [
    [
        'name' => 'Monthly',
        'price' => '£3.99',
        'period' => '/month',
        'description' => 'Perfect for trying premium features'
    ],
    [
        'name' => 'Yearly',
        'price' => '£31',
        'period' => '/year',
        'description' => 'Best value - Save £16.88!'
    ]
];
?>
