# Nexi Premium Payment System

A complete premium subscription system for Nexi Bot with Stripe payments and Discord OAuth integration.

## 🚀 Quick Start

### Prerequisites
- PHP 7.4+ with extensions: `pdo`, `pdo_mysql`, `curl`, `json`, `openssl`
- MySQL/MariaDB database
- Composer
- Stripe account
- Discord application

### Installation

1. **Clone and setup**
   ```bash
   git clone https://github.com/Nexi-Bot/mainwebsite.git
   cd mainwebsite
   composer install --no-dev --optimize-autoloader
   ```

2. **Configure environment**
   - Update `includes/config.php` with your credentials
   - Set up your database connection
   - Add Stripe API keys
   - Configure Discord OAuth

3. **Initialize database**
   ```bash
   php init-database.php
   ```

4. **Deploy and test**
   ```bash
   php deploy.php
   ```

## 🔧 Configuration

### Database Setup
The system will automatically create the required tables:
- `users` - User accounts and premium status
- `payments` - Payment history and transactions

### Stripe Configuration
1. Get your API keys from [Stripe Dashboard](https://dashboard.stripe.com/apikeys)
2. Set up webhook endpoint: `https://yourdomain.com/premium/webhook`
3. Configure webhook events:
   - `payment_intent.succeeded`
   - `invoice.payment_succeeded` 
   - `customer.subscription.deleted`

### Discord OAuth Setup
1. Create application at [Discord Developer Portal](https://discord.com/developers/applications)
2. Add redirect URI: `https://yourdomain.com/auth/discord-callback`
3. Copy Client ID and Secret to config

## 💳 Features

### Payment System
- **Stripe Integration** - Secure payment processing
- **Multiple Plans** - Monthly, Yearly, Lifetime options
- **Coupon Support** - Discount codes and promotions
- **Webhook Processing** - Automatic premium activation
- **Payment History** - Complete transaction tracking

### User Management
- **Discord OAuth** - Secure authentication
- **Premium Status** - Automatic role management
- **Server Tracking** - Record owned Discord servers
- **Access Control** - Presale pricing and launch dates

### Security Features
- **Webhook Verification** - Stripe signature validation
- **SQL Injection Protection** - PDO prepared statements
- **XSS Protection** - Input sanitization
- **CSRF Protection** - Session validation
- **Security**: Protected against common vulnerabilities with proper headers
- **Performance**: Optimized with caching headers and compression

## File Structure

```
nexi-php-website/
├── includes/
│   ├── config.php          # Site configuration and data
│   ├── header.php          # Header component with navigation
│   └── footer.php          # Footer component
├── images/
│   └── lovable-uploads/    # Image assets
├── index.php               # Home page
├── features.php            # Features page
├── careers.php             # Careers page with application form
├── team.php                # Team page
├── legal.php               # Legal/Privacy page
├── 404.php                 # Error page
├── .htaccess               # Apache configuration
├── robots.txt              # SEO robots file
└── favicon.ico             # Site favicon
```

## Setup Instructions

1. **Upload Files**: Upload all files to your web server's public folder (usually `public_html`, `www`, or `htdocs`)

2. **Configure**: Edit `includes/config.php` to update:
   - Site URL
   - Discord webhook URL
   - Any other site-specific settings

3. **Permissions**: Set proper file permissions:
   - Folders: 755
   - Files: 644

4. **Test**: Visit your domain to ensure everything works correctly

## Requirements

- PHP 7.4 or higher
- Apache web server (for .htaccess support)
- cURL extension (for webhook functionality)

## Features Included

### Pages
- **Home**: Hero section, stats, features preview, CTA
- **Features**: Complete feature comparison table with pricing
- **Careers**: Job positions and working application form
- **Team**: Team member profiles
- **Legal**: Privacy policy and terms of service

### Functionality
- **Responsive Navigation**: Mobile-friendly menu
- **Contact Form**: Working careers application form
- **Discord Integration**: Webhook for form submissions
- **SEO Optimized**: Clean URLs and proper meta tags
- **Security**: XSS protection, frame options, content type headers

## Customization

### Styling
The website uses Tailwind CSS via CDN. The design matches the original exactly with:
- Orange gradient color scheme
- Dark theme
- Modern glassmorphism effects
- Responsive grid layouts

### Content
All content is stored in `includes/config.php` for easy editing:
- Navigation items
- Team members
- Job positions
- Features list
- Stats data

### Colors
The site uses a custom orange color palette:
- Primary: Orange 500 (#f97316)
- Secondary: Orange 400 (#fb923c)
- Accent: Orange 600 (#ea580c)

## Security Features

- XSS protection headers
- Content type sniffing protection
- Frame options to prevent clickjacking
- Secure referrer policy
- Input sanitization for forms
- Hidden sensitive files (.htaccess protection)

## Performance Features

- Static asset caching (1 month)
- GZIP compression
- Optimized images
- Minified CSS via Tailwind
- Efficient PHP code

## Browser Support

- Modern browsers (Chrome, Firefox, Safari, Edge)
- Mobile browsers (iOS Safari, Chrome Mobile)
- Progressive enhancement for older browsers

## Deployment

This website is ready for deployment on any standard PHP hosting:

1. **Shared Hosting**: Works on cPanel, Hostinger, etc.
2. **VPS/Cloud**: Compatible with Apache/PHP servers
3. **CDN**: Can be enhanced with CloudFlare or similar

## Maintenance

Regular maintenance tasks:
- Update PHP version as needed
- Monitor webhook functionality
- Review security headers
- Update content in config.php
- Monitor error logs

## Support

For issues or questions:
- Check the Discord webhook URL in config.php
- Verify file permissions
- Check PHP error logs
- Ensure cURL extension is enabled

## License

This is a conversion of the original Nexi website. All design and content rights belong to Nexi Bot LTD.
