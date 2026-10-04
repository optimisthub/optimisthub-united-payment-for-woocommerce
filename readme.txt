=== OptimistHub Payment Gateway with United Payment for WooCommerce ===
Contributors: optimisthub, fatih-toprak
Tags: woocommerce, payment gateway, georgia, united payment, united payment georgia, gel
Requires at least: 6.0
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.1
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html
WC requires at least: 6.0
WC tested up to: 11.1

Accept payments in Georgia (GEL) on your WooCommerce store through the United Payment gateway.

== Description ==

This plugin connects your WooCommerce store to the United Payment gateway so you can accept credit and debit card payments in Georgian Lari (GEL).

Orders are created as pending, the customer is redirected to the United Payment 3D Secure page, and the order status is updated automatically when the gateway reports back.

**Features**

* Card payments through United Payment with 3D Secure
* Test (sandbox) mode for development and staging sites
* WooCommerce High-Performance Order Storage (HPOS) compatible
* WooCommerce Cart and Checkout Blocks compatible
* Automatic order status updates via gateway callback
* Transaction logging for troubleshooting
* Hash-signature verification on every callback

**Requirements**

* WordPress 6.0 or newer
* WooCommerce 6.0 or newer
* PHP 7.4 or newer
* A United Payment merchant account (Dealer Code, API username and password)

== Installation ==

1. Install and activate the plugin from the WordPress Plugins screen.
2. Navigate to **WooCommerce → Settings → Payments** and enable **United Payment**.
3. Select **Manage** and enter your Dealer Code, API Username, and API Password from United Payment.
4. Use **Test mode** while verifying your checkout flow, then disable it for live payments.

== Frequently Asked Questions ==

= Where do I get my Dealer Code and API credentials? =

These are issued by United Payment when your merchant account is created. Contact your United Payment account manager if you do not have them.

= Does this work with the new WooCommerce Checkout Blocks? =

Yes. The plugin declares compatibility with both the Cart and Checkout Blocks and the classic shortcode checkout.

= Is High-Performance Order Storage (HPOS) supported? =

Yes. The plugin declares compatibility with WooCommerce custom order tables and has been tested with HPOS enabled.

= How do I test without taking real payments? =

Enable **Test mode** in the gateway settings and place an order. The plugin will use the United Payment sandbox environment instead of the live one. No real money moves in test mode.

= An order is stuck on "pending payment" after the customer paid. What should I check? =

Check **WooCommerce → Status → Logs** for the `optimisthub-united-payment-for-woocommerce` log. The most common causes are an unreachable callback URL (the site must be publicly reachable; local and password-protected sites cannot receive callbacks) or mismatched API credentials.

= Do I need an SSL certificate? =

Yes. Payment gateways require HTTPS. Make sure your checkout pages are served over a valid SSL certificate before enabling live mode.

== Screenshots ==

1. WooCommerce payments list with United Payment option
2. United Payment settings screen
3. Checkout page with the United Payment button
4. United Payment test payment page

== Changelog ==

= 1.0.1 =

* Updated the "Tested up to" declaration to WordPress 7.1.
* Updated the WooCommerce compatibility declaration to 11.1. The plugin was verified against WooCommerce 11.1.2.
* Added the `WC requires at least` and `WC tested up to` headers to `readme.txt`; they were only present in the plugin file, so WordPress.org did not surface WooCommerce compatibility.
* Corrected the `composer.json` package type from `library` to `wordpress-plugin` so Composer-based installations (Bedrock) place the plugin in the plugins directory instead of `vendor/`.
* Added `fatih-toprak` to the contributors list.
* Added PHPCS configuration and a CI workflow.
* No functional changes; this release only corrects metadata and packaging.

= 1.0.0 =

* Initial release.

== Upgrade Notice ==

= 1.0.1 =

Metadata release. Corrects the WordPress and WooCommerce compatibility declarations, fixes the Composer package type and adds CI. No functional changes.
