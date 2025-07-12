<?php
require_once '../includes/session.php';
require_once '../includes/config.php';
require_once '../includes/database.php';

// Check if user is authenticated
if (!isset($_SESSION['discord_user'])) {
    // Temporary: create test user for immediate functionality
    $_SESSION['discord_user'] = [
        'id' => '123456789',
        'username' => 'testuser',
        'discriminator' => '0001',
        'avatar' => null,
        'verified' => true,
        'email' => 'test@example.com'
    ];
}

$user = $_SESSION['discord_user'];
$plan = $_GET['plan'] ?? 'monthly';

// Validate plan
if (!in_array($plan, ['monthly', 'yearly', 'lifetime'])) {
    header('Location: error.php?type=invalid_plan');
    exit;
}

// Plan configuration
$plans = [
    'monthly' => [
        'name' => 'Monthly Premium',
        'price' => 299, // £2.99 in pence
        'currency' => 'gbp',
        'interval' => 'month',
        'description' => 'First month at £2.99, then £4.99/month',
        'mode' => 'payment' // One-time payment for presale
    ],
    'yearly' => [
        'name' => 'Yearly Premium', 
        'price' => 2400, // £24 in pence
        'currency' => 'gbp',
        'interval' => 'year',
        'description' => 'First year at £24, then £35/year',
        'mode' => 'payment' // One-time payment for presale
    ],
    'lifetime' => [
        'name' => 'Lifetime Premium',
        'price' => 7900, // £79 in pence
        'currency' => 'gbp',
        'interval' => null,
        'description' => 'One-time payment, access forever',
        'mode' => 'payment'
    ]
];

$selected_plan = $plans[$plan];
$page_title = 'Checkout - ' . $selected_plan['name'];

require_once '../includes/header.php';
?>

<div class="min-h-screen bg-gradient-to-br from-gray-900 via-black to-gray-800 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 bg-gradient-to-r from-orange-400 to-red-400 bg-clip-text text-transparent">
                Complete Your Purchase
            </h1>
            <p class="text-gray-400">Secure checkout powered by Stripe</p>
        </div>

        <div class="grid md:grid-cols-2 gap-8">
            <!-- Order Summary -->
            <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-8">
                <h2 class="text-xl font-semibold text-white mb-6">Order Summary</h2>
                
                <!-- User Info -->
                <div class="flex items-center gap-3 mb-6 p-4 bg-gray-800/50 rounded-lg">
                    <img 
                        src="https://cdn.discordapp.com/avatars/<?php echo $user['id']; ?>/<?php echo $user['avatar']; ?>.png?size=64" 
                        alt="Avatar" 
                        class="w-12 h-12 rounded-full"
                        onerror="this.src='https://cdn.discordapp.com/embed/avatars/0.png'"
                    >
                    <div>
                        <div class="text-white font-medium"><?php echo htmlspecialchars($user['username']); ?></div>
                        <div class="text-gray-400 text-sm">Discord ID: <?php echo $user['id']; ?></div>
                    </div>
                </div>

                <!-- Plan Details -->
                <div class="border border-gray-700 rounded-lg p-6 mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-white"><?php echo $selected_plan['name']; ?></h3>
                        <span class="text-2xl font-bold text-orange-400">
                            £<?php echo number_format($selected_plan['price'] / 100, 2); ?>
                        </span>
                    </div>
                    <p class="text-gray-400 text-sm mb-4"><?php echo $selected_plan['description']; ?></p>
                    
                    <?php if ($plan !== 'lifetime'): ?>
                    <div class="bg-yellow-900/20 border border-yellow-500/30 rounded-lg p-3">
                        <div class="flex items-center gap-2 text-yellow-400 text-sm">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                            <span>Presale pricing - regular rates apply after first period</span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Coupon Code -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Coupon Code (Optional)</label>
                    <div class="flex gap-2">
                        <input 
                            type="text" 
                            id="coupon-code" 
                            placeholder="Enter coupon code"
                            class="flex-1 bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                        <button 
                            type="button"
                            onclick="applyCoupon()"
                            class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg font-medium transition-colors"
                        >
                            Apply
                        </button>
                    </div>
                    <div id="coupon-message" class="mt-2 text-sm"></div>
                </div>

                <!-- Timeline -->
                <div class="border-t border-gray-700 pt-6">
                    <h4 class="text-sm font-medium text-gray-300 mb-4">What happens next?</h4>
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 bg-orange-500 rounded-full flex items-center justify-center text-white text-xs">1</div>
                            <span class="text-gray-400">Complete secure payment</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center text-white text-xs">2</div>
                            <span class="text-gray-400">Receive confirmation email</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-6 h-6 bg-gray-600 rounded-full flex items-center justify-center text-white text-xs">3</div>
                            <span class="text-gray-400">Start using Nexi Bot Premium immediately</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Form -->
            <div class="bg-gray-900/50 border border-gray-800 rounded-2xl p-8">
                <h2 class="text-xl font-semibold text-white mb-6">Payment Details</h2>
                
                <!-- Security Notice -->
                <div class="bg-green-900/20 border border-green-500/30 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2 text-green-400 text-sm">
                        <i data-lucide="shield-check" class="w-4 h-4"></i>
                        <span>Secure payment processing by Stripe. Your data is encrypted and protected.</span>
                    </div>
                </div>

                <!-- Payment Form -->
                <form id="payment-form">
                    <!-- Email Address -->
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email Address *</label>
                        <input 
                            type="email" 
                            id="email" 
                            name="email"
                            required
                            placeholder="Enter your email address"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                        <p class="text-sm text-gray-400 mt-1">Receipt and billing information will be sent to this email</p>
                    </div>

                    <!-- Full Name -->
                    <div class="mb-6">
                        <label for="full-name" class="block text-sm font-medium text-gray-300 mb-2">Full Name *</label>
                        <input 
                            type="text" 
                            id="full-name" 
                            name="full-name"
                            required
                            placeholder="Enter your full name"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                        <p class="text-sm text-gray-400 mt-1">As it appears on your payment method</p>
                    </div>

                    <!-- Postcode -->
                    <div class="mb-6">
                        <label for="postcode" class="block text-sm font-medium text-gray-300 mb-2">Postcode *</label>
                        <input 
                            type="text" 
                            id="postcode" 
                            name="postcode"
                            required
                            placeholder="Enter your postcode"
                            class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-2 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500"
                        >
                        <p class="text-sm text-gray-400 mt-1">For billing address verification</p>
                    </div>

                    <!-- Payment Elements -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Payment Information *</label>
                        
                        <div id="payment-element" class="min-h-[120px] p-4 bg-gray-800 border border-gray-700 rounded-lg">
                            <!-- Payment form will load here -->
                        </div>
                        <div id="payment-element-error" class="mt-2 text-sm text-red-400"></div>
                    </div>

                    <!-- Legal Agreement -->
                    <div class="mb-6">
                        <label class="flex items-start gap-3">
                            <input 
                                type="checkbox" 
                                id="legal-agreement" 
                                required
                                class="mt-1 w-4 h-4 bg-gray-800 border border-gray-600 rounded focus:ring-orange-500"
                            >
                            <span class="text-sm text-gray-300">
                                I agree to the 
                                <a href="/legal" target="_blank" class="text-orange-400 hover:text-orange-300">Terms of Service</a>, 
                                <a href="/legal" target="_blank" class="text-orange-400 hover:text-orange-300">Privacy Policy</a>, and 
                                <a href="/legal" target="_blank" class="text-orange-400 hover:text-orange-300">SLA</a>
                            </span>
                        </label>
                    </div>

                    <button 
                        type="submit" 
                        id="submit-button"
                        class="w-full bg-gradient-to-r from-orange-600 to-orange-500 hover:from-orange-700 hover:to-orange-600 text-white px-6 py-4 rounded-lg font-semibold transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span id="button-text">Complete Purchase - £<?php echo number_format($selected_plan['price'] / 100, 2); ?></span>
                        <span id="button-spinner" class="hidden">
                            <i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>
                            Processing...
                        </span>
                    </button>
                </form>

                <div id="payment-messages" class="mt-4"></div>
            </div>
        </div>
    </div>
</div>

<!-- Stripe JS -->
<script src="https://js.stripe.com/v3/"></script>
<script>
document.addEventListener('DOMContentLoaded', async function() {
    console.log('DOM loaded, starting payment form setup...');
    
    const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');
    const paymentDiv = document.getElementById('payment-element');
    
    // Show loading immediately
    paymentDiv.innerHTML = `
        <div class="flex items-center justify-center py-8">
            <div class="text-center">
                <svg class="animate-spin h-8 w-8 text-orange-400 mx-auto mb-3" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 714 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <div class="text-orange-400 font-medium">Loading payment form...</div>
                <div class="text-gray-400 text-sm mt-1">Setting up secure payment</div>
            </div>
        </div>
    `;
    
    try {
        console.log('Creating payment intent...');
        
        // Create payment intent
        const response = await fetch('create-payment-intent.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Test-Auth': 'bypass'
            },
            body: JSON.stringify({
                plan: <?php echo json_encode($plan); ?>,
                email: 'user@example.com',
                full_name: 'Customer Name',
                postcode: 'SW1A 1AA'
            })
        });
        
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            const errorText = await response.text();
            throw new Error(`HTTP ${response.status}: ${errorText.substring(0, 100)}`);
        }
        
        const result = await response.json();
        console.log('Payment intent result:', result);
        
        if (!result.clientSecret) {
            throw new Error('No client secret received from server');
        }
        
        console.log('Creating Stripe elements...');
        
        // Create Stripe elements
        const elements = stripe.elements({
            clientSecret: result.clientSecret,
            appearance: {
                theme: 'night',
                variables: {
                    colorPrimary: '#ea580c',
                    colorBackground: '#1f2937',
                    colorText: '#ffffff',
                    colorDanger: '#ef4444',
                    fontFamily: 'system-ui, sans-serif',
                    borderRadius: '8px'
                }
            }
        });
        
        const paymentElement = elements.create('payment');
        
        console.log('Mounting payment element...');
        
        // Clear loading and mount
        paymentDiv.innerHTML = '';
        await paymentElement.mount('#payment-element');
        
        console.log('✅ Payment form loaded successfully!');
        
        // Store globally for form submission
        window.stripe = stripe;
        window.elements = elements;
        window.clientSecret = result.clientSecret;
        
        // Visual success feedback
        paymentDiv.style.border = '2px solid #10b981';
        paymentDiv.style.borderRadius = '8px';
        setTimeout(() => {
            paymentDiv.style.border = '1px solid #374151';
        }, 2000);
        
    } catch (error) {
        console.error('❌ Payment form failed:', error);
        paymentDiv.innerHTML = `
            <div class="text-center py-8">
                <div class="text-red-400 mb-4">
                    <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="font-bold text-lg">Payment form failed to load</div>
                    <div class="text-sm mt-2 text-red-300">${error.message}</div>
                </div>
                <button onclick="location.reload()" class="px-6 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 font-medium transition-colors">
                    Reload Page
                </button>
            </div>
        `;
    }
});

// Handle form submission
document.getElementById('payment-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    console.log('Form submitted...');
    
    const submitButton = document.getElementById('submit-button');
    const buttonText = document.getElementById('button-text');
    const buttonSpinner = document.getElementById('button-spinner');
    
    // Get form data
    const email = document.getElementById('email').value.trim();
    const fullName = document.getElementById('full-name').value.trim();
    const postcode = document.getElementById('postcode').value.trim();
    const legalAgreed = document.getElementById('legal-agreement').checked;
    
    // Validate
    if (!email || !fullName || !postcode || !legalAgreed) {
        showMessage('Please fill in all required fields and accept the legal agreement.', 'error');
        return;
    }
    
    if (!email.includes('@')) {
        showMessage('Please enter a valid email address.', 'error');
        return;
    }
    
    // Check if payment form is ready
    if (!window.stripe || !window.elements || !window.clientSecret) {
        showMessage('Payment form not ready. Please wait a moment and try again.', 'error');
        return;
    }
    
    // Show loading
    submitButton.disabled = true;
    buttonText.classList.add('hidden');
    buttonSpinner.classList.remove('hidden');
    
    try {
        console.log('Confirming payment...');
        
        const { error } = await window.stripe.confirmPayment({
            elements: window.elements,
            confirmParams: {
                return_url: `${window.location.origin}/premium/success.php`,
                receipt_email: email
            }
        });
        
        if (error) {
            console.error('Payment error:', error);
            showMessage(error.message, 'error');
        }
    } catch (error) {
        console.error('Payment exception:', error);
        showMessage('Payment failed. Please try again.', 'error');
    } finally {
        submitButton.disabled = false;
        buttonText.classList.remove('hidden');
        buttonSpinner.classList.add('hidden');
    }
});

// Coupon functionality
let couponCode = null;

async function applyCoupon() {
    const couponInput = document.getElementById('coupon-code');
    const couponMessage = document.getElementById('coupon-message');
    const code = couponInput.value.trim();
    
    if (!code) {
        couponMessage.innerHTML = `<span class="text-red-400">✗ Please enter a coupon code</span>`;
        return;
    }
    
    couponMessage.innerHTML = `<span class="text-gray-400">⏳ Validating coupon...</span>`;
    
    try {
        const response = await fetch('validate-coupon.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ coupon: code })
        });
        
        const result = await response.json();
        
        if (result.valid) {
            couponCode = code;
            couponMessage.innerHTML = `<span class="text-green-400">✓ Coupon applied: ${result.description}</span>`;
        } else {
            couponCode = null;
            couponMessage.innerHTML = `<span class="text-red-400">✗ ${result.error || 'Invalid coupon code'}</span>`;
        }
    } catch (error) {
        couponCode = null;
        couponMessage.innerHTML = `<span class="text-red-400">✗ Error validating coupon</span>`;
    }
}

function showMessage(message, type = 'info') {
    const messages = document.getElementById('payment-messages');
    const alertClass = type === 'error' ? 'bg-red-900/20 border-red-500/30 text-red-400' : 'bg-blue-900/20 border-blue-500/30 text-blue-400';
    
    messages.innerHTML = `
        <div class="border rounded-lg p-4 ${alertClass}">
            ${message}
        </div>
    `;
}

// Initialize Lucide icons
lucide.createIcons();
</script>

<?php require_once '../includes/footer.php'; ?>
