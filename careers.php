<?php
require_once 'includes/config.php';
require_once 'includes/header.php';

$positions = [
    [
        'id' => 'moderator',
        'title' => 'Westgate Server Moderator',
        'description' => 'Ensure the community and roleplay standards are being upheld.',
        'icon' => 'users',
    ],
    [
        'id' => 'development',
        'title' => 'Development Team',
        'description' => 'Develop and maintain the bot or our website to enhance user experience and automate tasks within nexi.',
        'icon' => 'code',
    ],
    [
        'id' => 'analytics',
        'title' => 'Analytics Team',
        'description' => 'The Analytics Team analyzes data and collects customer feedback.',
        'icon' => 'bar-chart',
    ],
    [
        'id' => 'customer-experience',
        'title' => 'Customer Experience Team',
        'description' => 'Provide excellent customer support and ensure smooth communication with our users.',
        'icon' => 'heart',
    ],
    [
        'id' => 'legal',
        'title' => 'Legal Team',
        'description' => 'Be responsible for documents, contracts, paperwork, companies house, finance etc.',
        'icon' => 'file-text',
    ],
    [
        'id' => 'marketing',
        'title' => 'Marketing Team',
        'description' => 'The Marketing Team promotes Nexi\'s brand, drives growth, and manages external communications.',
        'icon' => 'message-square',
    ],
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = [
        'discordUsername' => $_POST['discordUsername'] ?? '',
        'email' => $_POST['email'] ?? '',
        'fullName' => $_POST['fullName'] ?? '',
        'position' => $_POST['position'] ?? '',
        'whyJoin' => $_POST['whyJoin'] ?? '',
        'experience' => $_POST['experience'] ?? '',
        'uniqueSkills' => $_POST['uniqueSkills'] ?? '',
        'hoursPerWeek' => $_POST['hoursPerWeek'] ?? '',
        'portfolio' => $_POST['portfolio'] ?? '',
        'privacyPolicy' => isset($_POST['privacyPolicy']),
        'contractAgreement' => isset($_POST['contractAgreement']),
    ];

    if ($formData['privacyPolicy'] && $formData['contractAgreement']) {
        // Prepare Discord webhook data
        $webhookData = [
            'content' => null,
            'embeds' => [[
                'title' => 'New Career Application',
                'color' => 16776960, // Yellow color
                'fields' => [
                    ['name' => 'Discord Username', 'value' => $formData['discordUsername'], 'inline' => true],
                    ['name' => 'Email', 'value' => $formData['email'], 'inline' => true],
                    ['name' => 'Full Name', 'value' => $formData['fullName'], 'inline' => true],
                    ['name' => 'Position', 'value' => $formData['position'], 'inline' => true],
                    ['name' => 'Hours per Week', 'value' => $formData['hoursPerWeek'], 'inline' => true],
                    ['name' => 'Why Join', 'value' => substr($formData['whyJoin'], 0, 1024), 'inline' => false],
                    ['name' => 'Experience', 'value' => substr($formData['experience'], 0, 1024), 'inline' => false],
                    ['name' => 'Unique Skills', 'value' => substr($formData['uniqueSkills'], 0, 1024), 'inline' => false],
                    ['name' => 'Portfolio', 'value' => $formData['portfolio'] ?: 'Not provided', 'inline' => false],
                ],
                'timestamp' => date('c'),
            ]],
        ];

        // Send to Discord webhook
        $webhookUrl = 'https://discord.com/api/webhooks/1389607927983116370/GlPRFlYzMZLTgiF9eANM5QeGZ1PqP8_mB9XUk7kybxnEzht9oo5FsgIyMyRwwCkx6Vzl';
        $ch = curl_init($webhookUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($webhookData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode === 204) {
            $successMessage = "Thank you for your application! We will review it and get back to you soon.";
        } else {
            $errorMessage = "There was an error submitting your application. Please try again.";
        }
    } else {
        $errorMessage = "Please agree to both the Privacy Policy and Contract terms to submit your application.";
    }
}
?>

<div class="min-h-screen py-20 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">
                Join Our Team
            </h1>
            <p class="text-xl text-gray-400 max-w-3xl mx-auto mb-4">
                We are in need of people to help within nexi. You will be able to work with a friendly and welcoming team to help make sure operations within nexi are running smoothly.
            </p>
            <p class="text-lg text-gray-300 font-medium">
                Find open positions and applications below.
            </p>
        </div>

        <!-- Positions -->
        <div class="grid md:grid-cols-2 gap-6 mb-16">
            <?php foreach ($positions as $position): ?>
                <div class="bg-gray-900/50 border border-gray-800 rounded-xl p-6 hover:border-purple-500/50 transition-all duration-300">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-purple-600 to-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <?php
                            $iconMap = [
                                'users' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
                                'code' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>',
                                'bar-chart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>',
                                'heart' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
                                'file-text' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>',
                                'message-square' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>',
                            ];
                            ?>
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <?php echo $iconMap[$position['icon']]; ?>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2"><?php echo htmlspecialchars($position['title']); ?></h3>
                            <p class="text-gray-400"><?php echo htmlspecialchars($position['description']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (isset($successMessage)): ?>
            <div class="bg-green-500/20 border border-green-500/50 rounded-lg p-4 mb-8">
                <p class="text-green-300 font-semibold"><?php echo $successMessage; ?></p>
            </div>
        <?php endif; ?>

        <?php if (isset($errorMessage)): ?>
            <div class="bg-red-500/20 border border-red-500/50 rounded-lg p-4 mb-8">
                <p class="text-red-300 font-semibold"><?php echo $errorMessage; ?></p>
            </div>
        <?php endif; ?>

        <!-- Application Form -->
        <div class="bg-gray-900/50 border border-gray-800 rounded-xl p-8">
            <h2 class="text-2xl font-bold mb-6 text-center">Application Form</h2>
            
            <form method="POST" class="space-y-6">
                <!-- Personal Information -->
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label for="discordUsername" class="block text-sm font-medium text-gray-300 mb-2">
                            Discord Username *
                        </label>
                        <input
                            type="text"
                            id="discordUsername"
                            name="discordUsername"
                            required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white"
                            placeholder="username#1234"
                        />
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            Email Address *
                        </label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            required
                            class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white"
                            placeholder="your@email.com"
                        />
                    </div>
                </div>

                <div>
                    <label for="fullName" class="block text-sm font-medium text-gray-300 mb-2">
                        Full Name *
                    </label>
                    <input
                        type="text"
                        id="fullName"
                        name="fullName"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white"
                        placeholder="Your full name"
                    />
                </div>

                <p class="text-gray-300 text-center mb-6">
                    To apply for Westgate City Moderator, please use this link:
                    <a
                        href="https://forms.gle/1yfABJDdV5BQF4zd8"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="text-purple-400 hover:text-purple-300 underline"
                    >
                        Apply Here
                    </a>
                </p>

                <!-- Position Selection -->
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-300 mb-2">
                        Position *
                    </label>
                    <select
                        id="position"
                        name="position"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white"
                    >
                        <option value="">Select a position</option>
                        <?php foreach ($positions as $position): ?>
                            <?php if ($position['id'] !== 'moderator'): ?>
                                <option value="<?php echo htmlspecialchars($position['id']); ?>">
                                    <?php echo htmlspecialchars($position['title']); ?>
                                </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Application Questions -->
                <div>
                    <label for="whyJoin" class="block text-sm font-medium text-gray-300 mb-2">
                        Why do you want to join this team? *
                    </label>
                    <textarea
                        id="whyJoin"
                        name="whyJoin"
                        required
                        rows="3"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white"
                        placeholder="Tell us what motivates you to join this team..."
                    ></textarea>
                </div>

                <div>
                    <label for="experience" class="block text-sm font-medium text-gray-300 mb-2">
                        What is your relevant experience? *
                    </label>
                    <textarea
                        id="experience"
                        name="experience"
                        required
                        rows="3"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white"
                        placeholder="Describe your relevant experience and background..."
                    ></textarea>
                </div>

                <div>
                    <label for="uniqueSkills" class="block text-sm font-medium text-gray-300 mb-2">
                        What unique skills or perspective would you bring to Nexi? *
                    </label>
                    <textarea
                        id="uniqueSkills"
                        name="uniqueSkills"
                        required
                        rows="3"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white"
                        placeholder="What makes you unique and valuable to our team..."
                    ></textarea>
                </div>

                <div>
                    <label for="hoursPerWeek" class="block text-sm font-medium text-gray-300 mb-2">
                        How many hours per week can you commit? *
                    </label>
                    <input
                        type="text"
                        id="hoursPerWeek"
                        name="hoursPerWeek"
                        required
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white"
                        placeholder="e.g., 10-15 hours per week"
                    />
                </div>

                <div>
                    <label for="portfolio" class="block text-sm font-medium text-gray-300 mb-2">
                        Portfolio/Previous Work Examples (Optional)
                    </label>
                    <input
                        type="text"
                        id="portfolio"
                        name="portfolio"
                        class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent text-white"
                        placeholder="Link to portfolio, GitHub, or examples of your work"
                    />
                </div>

                <!-- Agreement Checkboxes -->
                <div class="space-y-4 border-t border-gray-700 pt-6">
                    <div class="flex items-start gap-3">
                        <input
                            type="checkbox"
                            id="privacyPolicy"
                            name="privacyPolicy"
                            required
                            class="mt-1 w-4 h-4 text-purple-600 bg-gray-800 border-gray-600 rounded focus:ring-purple-500 focus:ring-2"
                        />
                        <label for="privacyPolicy" class="text-sm text-gray-300">
                            I agree to the <a href="legal" target="_blank" class="text-purple-400 hover:text-purple-300 underline">Privacy Policy</a> *
                        </label>
                    </div>
                    <div class="flex items-start gap-3">
                        <input
                            type="checkbox"
                            id="contractAgreement"
                            name="contractAgreement"
                            required
                            class="mt-1 w-4 h-4 text-purple-600 bg-gray-800 border-gray-600 rounded focus:ring-purple-500 focus:ring-2"
                        />
                        <label for="contractAgreement" class="text-sm text-gray-300">
                            I agree to sign a contract for Nexi Bot LTD, disclosing my full name and date of birth *
                        </label>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button
                        type="submit"
                        class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-200 inline-flex items-center gap-2"
                    >
                        Submit Application
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
