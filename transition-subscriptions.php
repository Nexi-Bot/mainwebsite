<?php
/**
 * Subscription Price Transition Script
 * Run this script to transition subscriptions from presale to regular pricing
 * Should be run as a cron job on the transition dates
 */

require_once 'includes/config.php';
require_once 'includes/database.php';

echo "🔄 Nexi Premium Subscription Price Transition\n";
echo "=============================================\n\n";

try {
    // Initialize Stripe
    require_once 'vendor/autoload.php';
    \Stripe\Stripe::setApiKey(STRIPE_SECRET_KEY);

    $today = date('Y-m-d');
    $transitioned = 0;
    $errors = 0;

    // Get all active subscriptions that need price transitions
    $subscriptions = \Stripe\Subscription::all([
        'status' => 'active',
        'limit' => 100
    ]);

    foreach ($subscriptions->data as $subscription) {
        // Check if this subscription needs transition based on metadata
        $transition_date = $subscription->metadata->transition_date ?? null;
        $regular_price_id = $subscription->metadata->regular_price_id ?? null;
        $premium_type = $subscription->metadata->premium_type ?? null;

        if (!$transition_date || !$regular_price_id || !$premium_type) {
            continue; // Skip if no transition data
        }

        // Check if it's time to transition
        if ($today >= $transition_date) {
            try {
                // Get current subscription item
                $current_item = $subscription->items->data[0];

                // Update subscription to use regular pricing
                \Stripe\Subscription::update($subscription->id, [
                    'items' => [
                        [
                            'id' => $current_item->id,
                            'price' => $regular_price_id
                        ]
                    ],
                    'metadata' => [
                        'discord_user_id' => $subscription->metadata->discord_user_id,
                        'discord_username' => $subscription->metadata->discord_username,
                        'premium_type' => $premium_type,
                        'price_transitioned' => $today,
                        'previous_price_id' => $current_item->price->id
                    ]
                ]);

                echo "✅ Transitioned {$premium_type} subscription {$subscription->id} to regular pricing\n";
                $transitioned++;

                // Update database record
                try {
                    $db->query(
                        "UPDATE users SET 
                         premium_billing_amount = ?, 
                         updated_at = NOW() 
                         WHERE user_id = ?",
                        [
                            $premium_type === 'monthly' ? 499 : 3500, // Regular amounts
                            $subscription->metadata->discord_user_id
                        ]
                    );
                } catch (Exception $e) {
                    echo "⚠️  Database update failed for user {$subscription->metadata->discord_user_id}: {$e->getMessage()}\n";
                }

            } catch (Exception $e) {
                echo "❌ Failed to transition subscription {$subscription->id}: {$e->getMessage()}\n";
                $errors++;
            }
        }
    }

    echo "\n📊 Transition Summary:\n";
    echo "- Subscriptions transitioned: {$transitioned}\n";
    echo "- Errors encountered: {$errors}\n";

    if ($transitioned > 0) {
        echo "\n🎉 Price transitions completed successfully!\n";
    } else {
        echo "\n💡 No subscriptions needed transition today.\n";
    }

} catch (Exception $e) {
    echo "❌ Script failed: {$e->getMessage()}\n";
    exit(1);
}

echo "\n💡 Schedule this script to run daily via cron:\n";
echo "0 9 * * * /usr/bin/php " . __DIR__ . "/transition-subscriptions.php\n";
?>
