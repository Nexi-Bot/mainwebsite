# Nexi Bot Premium Payment System Setup Guide

## Overview
This guide will help you complete the setup of the Nexi Bot Premium payment system using Stripe and Discord OAuth.

## 🔧 Required Configuration

### 1. Discord OAuth Application Setup

1. Go to https://discord.com/developers/applications
2. Create a new application or select your existing Nexi Bot application
3. Go to OAuth2 → General
4. Add redirect URI: `https://nexibot.uk/auth/discord-callback`
5. Note down your Client ID and Client Secret
6. Update `/includes/config.php`:

```php
define('DISCORD_CLIENT_ID', 'your_actual_client_id_here');
define('DISCORD_CLIENT_SECRET', 'your_actual_client_secret_here');
```

### 2. Stripe Webhook Configuration

1. Go to https://dashboard.stripe.com/webhooks
2. Click "Add endpoint"
3. Set endpoint URL: `https://nexibot.uk/premium/webhook`
4. Select these events:
   - `payment_intent.succeeded`
   - `invoice.payment_succeeded` 
   - `customer.subscription.deleted`
5. Copy the webhook signing secret
6. Update `/premium/webhook.php`:

```php
$endpoint_secret = 'whsec_your_actual_webhook_secret_here';
```

### 3. Database Setup

The database tables will be created automatically when the first user logs in. If you want to create them manually:

```sql
-- Run these commands in your MySQL database

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(20) UNIQUE NOT NULL,
    username VARCHAR(255),
    discriminator VARCHAR(10),
    avatar VARCHAR(255),
    premium BOOLEAN DEFAULT FALSE,
    premium_type ENUM('monthly', 'yearly', 'lifetime') DEFAULT NULL,
    premium_expires_at DATETIME NULL,
    stripe_customer_id VARCHAR(255),
    stripe_subscription_id VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_user_id (user_id),
    INDEX idx_premium (premium),
    INDEX idx_stripe_customer (stripe_customer_id)
);

CREATE TABLE IF NOT EXISTS guild_config (
    id INT AUTO_INCREMENT PRIMARY KEY,
    guild_id VARCHAR(20) UNIQUE NOT NULL,
    premium BOOLEAN DEFAULT FALSE,
    premium_expires_at DATETIME NULL,
    premium_type ENUM('monthly', 'yearly', 'lifetime') DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_guild_id (guild_id),
    INDEX idx_premium (premium)
);
```

## 🎯 How It Works

### Payment Flow
1. User visits `/features` page
2. User clicks "Login with Discord" (if not logged in)
3. Discord OAuth authenticates user and stores info
4. User selects a premium plan and clicks purchase
5. User is redirected to `/premium/checkout?plan=monthly/yearly/lifetime`
6. User enters payment details and submits form
7. Stripe processes payment and sends webhook to `/premium/webhook`
8. Webhook updates database with premium status
9. User is redirected to `/premium/success` page

### Pricing Structure
- **Monthly**: £2.99 first month (then £4.99/month from Aug 20, 2025)
- **Yearly**: £24 first year (then £35/year from Jul 20, 2026)  
- **Lifetime**: £79 one-time (normally £120)

### Database Updates
When payment succeeds, the webhook will:
1. Set `premium = TRUE` for the user
2. Set `premium_type` to the purchased plan
3. Set `premium_expires_at` to the expiration date (NULL for lifetime)
4. Store Stripe customer ID for future billing

## 🛠 Files Created/Modified

### New Files:
- `/premium/checkout.php` - Custom payment page with Stripe Elements
- `/premium/create-payment-intent.php` - Creates Stripe payment intent
- `/premium/validate-coupon.php` - Validates Stripe coupon codes
- `/premium/webhook.php` - Handles Stripe webhook events
- `/premium/success.php` - Payment confirmation page
- `/auth/discord-login.php` - Initiates Discord OAuth
- `/auth/discord-callback.php` - Handles Discord OAuth callback
- `/includes/database.php` - Database connection and helpers
- `/composer.json` - Stripe PHP SDK dependency

### Modified Files:
- `/features.php` - Added premium pricing section at top
- `/includes/config.php` - Added database, Stripe, and Discord config

## 🚀 Testing

### Test the Flow:
1. Visit `/features` page
2. Click "Login with Discord" 
3. Complete Discord OAuth flow
4. Try to purchase a plan (use Stripe test cards)
5. Verify database is updated correctly
6. Check webhook logs for any errors

### Stripe Test Cards:
- Success: `4242424242424242`
- Decline: `4000000000000002`
- Require 3D Secure: `4000002500003155`

## 🔒 Security Considerations

1. **Never commit real API keys** - Use environment variables in production
2. **Verify webhook signatures** - The webhook.php validates Stripe signatures
3. **Use HTTPS** - Required for Stripe and Discord OAuth
4. **Validate user sessions** - All payment endpoints check user authentication
5. **Sanitize inputs** - All user inputs are properly escaped

## 📋 Deployment Checklist

- [ ] Update Discord OAuth credentials in config.php
- [ ] Update Stripe webhook secret in webhook.php
- [ ] Test Discord login flow
- [ ] Test payment flow with Stripe test cards
- [ ] Verify webhook receives events correctly
- [ ] Check database updates after payment
- [ ] Test coupon code functionality
- [ ] Verify email notifications work
- [ ] Test on mobile devices
- [ ] Set up monitoring for webhook endpoint

## 🎉 What Users Get

### Immediate Benefits:
- Confirmation of purchase
- Early access guaranteed for July 20th, 2025
- Receipt and payment confirmation
- Access to premium Discord channels (if applicable)

### On July 20th, 2025:
- Full access to all premium bot features
- Priority support
- Advanced moderation tools
- Custom commands and integrations

## 📞 Support

If you encounter any issues:
1. Check webhook logs in Stripe Dashboard
2. Check server error logs for PHP errors
3. Verify database connections are working
4. Test Discord OAuth separately
5. Use Stripe test mode for debugging

The system is now ready for production use once you configure the Discord and Stripe credentials!
