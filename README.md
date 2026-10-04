<img src="https://ps.w.org/optimisthub-united-payment-for-woocommerce/assets/banner-1544x500.png" alt="Optimist Hub Payment Gateway with United Payment for WooCommerce" style="float: left; width:100%; margin-bottom:30px" />

# Optimist Hub Payment Gateway with United Payment for WooCommerce

[![CI](https://github.com/optimisthub/optimisthub-united-payment-for-woocommerce/actions/workflows/ci.yml/badge.svg)](https://github.com/optimisthub/optimisthub-united-payment-for-woocommerce/actions/workflows/ci.yml)
[![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)](https://wordpress.org/plugins/optimisthub-united-payment-for-woocommerce/)
[![WooCommerce](https://img.shields.io/badge/WooCommerce-6.0%20to%2011.1-96588a.svg)](https://woocommerce.com/)
[![PHP](https://img.shields.io/badge/PHP-7.4%2B-8892BF.svg)](https://www.php.net/)
[![License](https://img.shields.io/badge/license-GPL--3.0--or--later-green.svg)](https://www.gnu.org/licenses/gpl-3.0.html)

| | |
|---|---|
| **Requires WordPress** | 6.0 |
| **Tested up to** | 7.1 |
| **Requires WooCommerce** | 6.0 |
| **WC tested up to** | 11.1 |
| **Requires PHP** | 7.4+ |
| **Stable version** | 1.0.2 |
| **License** | GPLv3 or later |
| **License URI** | https://www.gnu.org/licenses/gpl-3.0.html |

Accepts credit and debit card payments in Georgian Lari (GEL) on your WooCommerce store through the United Payment gateway.

## How it works

1. The customer chooses United Payment at checkout and places the order. The order is created with a **pending payment** status.
2. The plugin requests a payment session from United Payment and redirects the customer to the **3D Secure** page.
3. United Payment processes the payment and calls back to your site.
4. The plugin verifies the callback signature and updates the order status to **processing** or **failed**.

## Features

- Card payments through United Payment with 3D Secure
- Test (sandbox) mode for development and staging sites
- WooCommerce **High-Performance Order Storage (HPOS)** compatible
- WooCommerce **Cart and Checkout Blocks** compatible
- Automatic order status updates via the gateway callback
- Transaction logging to `WooCommerce → Status → Logs`
- Callback verification with hash signature and order key

## Requirements

- WordPress 6.0 or newer
- WooCommerce 6.0 or newer
- PHP 7.4 or newer
- A United Payment merchant account (Dealer Code, API username and password)
- **HTTPS on your checkout pages.** The gateway will not accept a callback over plain HTTP.

## Installation

### From WordPress

1. Go to **Plugins → Add New** and search for `Optimist Hub Payment Gateway`.
2. Click **Install**, then **Activate**.
3. Go to **WooCommerce → Settings → Payments** and enable **United Payment**.
4. Click **Manage** and enter your Dealer Code, API Username and API Password.
5. Enable **Test mode** while you verify your checkout flow, then disable it for live payments.

### Manually

1. Download the ZIP and extract the `optimisthub-united-payment-for-woocommerce` folder to `/wp-content/plugins/`.
2. Activate the plugin from the **Plugins** menu.
3. Configure it under **WooCommerce → Settings → Payments**.

### Composer

This package is not published on Packagist, so register the GitHub repository as a VCS repository first:

```bash
composer config repositories.optimisthub-united-payment vcs https://github.com/optimisthub/optimisthub-united-payment-for-woocommerce
composer require optimisthub/optimisthub-united-payment-for-woocommerce
```

### Bedrock

If you use [Bedrock](https://roots.io/bedrock/), the plugin is relocated by `composer/installers` because its `type` is `wordpress-plugin`. Add this to your project's `composer.json`:

```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/optimisthub/optimisthub-united-payment-for-woocommerce"
        }
    ],
    "require": {
        "optimisthub/optimisthub-united-payment-for-woocommerce": "^1.0"
    },
    "extra": {
        "installer-paths": {
            "web/app/plugins/{$name}/": ["type:wordpress-plugin"]
        }
    },
    "config": {
        "allow-plugins": {
            "composer/installers": true
        }
    }
}
```

> **Note:** without the `installer-paths` mapping the plugin lands in `vendor/` and WordPress cannot see it.

## Frequently Asked Questions

### Where do I get my Dealer Code and API credentials?

United Payment issues these when your merchant account is created. Contact your United Payment account manager if you do not have them.

### How do I test without taking real payments?

Enable **Test mode** in the gateway settings and place an order. The plugin uses the United Payment sandbox environment instead of the live one. No real money moves in test mode.

### Does this work with the new WooCommerce Checkout Blocks?

Yes. The plugin declares compatibility with both the Cart and Checkout Blocks and the classic shortcode checkout.

### Is High-Performance Order Storage (HPOS) supported?

Yes. The plugin declares compatibility with WooCommerce custom order tables and has been tested with HPOS enabled.

### An order is stuck on "pending payment" after the customer paid. What should I check?

Check **WooCommerce → Status → Logs** and select the `optimisthub-united-payment-for-woocommerce` source. The most common causes are:

- **The callback URL is unreachable.** Your site must be publicly reachable over HTTPS. Local development sites and password-protected staging sites cannot receive callbacks.
- **Mismatched API credentials.** A wrong Dealer Code or password causes the payment to be rejected at the gateway.

### Do I need an SSL certificate?

Yes. Payment gateways require HTTPS. Make sure your checkout pages are served over a valid SSL certificate before enabling live mode.

### Can I change the order status the plugin sets?

Use the `united_payment_validate_hash` filter for custom callback validation logic:

```php
add_filter( 'united_payment_validate_hash', function ( $valid, $callback_data, $dealer_code, $order ) {
    // Return true to accept, false to reject, or null to fall back
    // to the plugin's built-in hash verification.
    return $valid;
}, 10, 4 );
```

### Can I modify the data sent to the gateway?

Yes, with the `united_payment_payment_data` filter:

```php
add_filter( 'united_payment_payment_data', function ( $payment_data, $order ) {
    return $payment_data;
}, 10, 2 );
```

## Development

```bash
composer install                             # Install dependencies
composer lint                                # PHP syntax check
vendor/bin/phpcs --standard=phpcs.xml.dist   # WordPress + WooCommerce standards
```

## Changelog

### 1.0.2

- Corrected the brand name in the plugin title: "OptimistHub" is now "Optimist Hub", matching the company name. The slug and all URLs are unchanged.
- Reduced the tag list to the five-tag limit. "united payment georgia" was removed because "united payment" and "georgia" already cover that phrase; the freed slot lets "gel" take effect instead of being ignored.
- No functional changes.

### 1.0.1

- Updated the "Tested up to" declaration to WordPress 7.1.
- Updated the WooCommerce compatibility declaration to 11.1, verified against WooCommerce 11.1.2.
- Added the `WC requires at least` and `WC tested up to` headers to `readme.txt`; they were only in the plugin file, so WordPress.org did not surface WooCommerce compatibility.
- Corrected the `composer.json` package type from `library` to `wordpress-plugin`.
- Added `fatih-toprak` to the contributors list.
- Added PHPCS configuration and a CI workflow.
- No functional changes.

### 1.0.0

- Initial release.

## Links

- [WordPress Plugin Directory](https://wordpress.org/plugins/optimisthub-united-payment-for-woocommerce/)
- [SVN Commit History](https://plugins.trac.wordpress.org/log/optimisthub-united-payment-for-woocommerce/)
- [Support Forum](https://wordpress.org/support/plugin/optimisthub-united-payment-for-woocommerce/)
- [Report an Issue](https://github.com/optimisthub/optimisthub-united-payment-for-woocommerce/issues)
- [United Payment](https://unitedpayment.ge)

## License

[GPL-3.0-or-later](https://www.gnu.org/licenses/gpl-3.0.html)

---

Developed by [Optimist Hub](https://optimisthub.com)
