<?php
/**
 * Plugin Name: DHL Express Live Rates PRO
 * Plugin URI: https://octol.io/dhl-express-plugin-site
 * Description: WooCommerce DHL Express integration packed with many advanced features. Display the dynamically calculated live rates for DHL Express shipping methods and adjust them to your needs.
 * Version: 2.5.3
 * Author: Octolize
 * Author URI: https://octol.io/dhlexpress-author
 * Text Domain: flexible-shipping-dhl-express-pro
 * Domain Path: /lang/
 * Requires at least: 5.8
 * Tested up to: 6.2
 * WC requires at least: 7.4
 * WC tested up to: 7.7
 * Requires PHP: 7.2
 *
 * @package DHL Express for WooCommerce PRO
 *
 * Copyright 2016 WP Desk Ltd.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/* THIS VARIABLE CAN BE CHANGED AUTOMATICALLY */
$plugin_version = '2.5.3';

$plugin_name        = 'DHL Express WooCommerce Live Rates PRO';
$plugin_class_name  = '\WPDesk\FlexibleShippingDhlExpressPro\Plugin';
$plugin_text_domain = 'flexible-shipping-dhl-express-pro';
$product_id         = 'DHL Express WooCommerce Live Rates PRO';
$plugin_file        = __FILE__;
$plugin_dir         = __DIR__;
$plugin_shops       = [
	'default' => 'https://octolize.com/',
];

define( 'FLEXIBLE_SHIPPING_DHL_EXPRESS_PRO_VERSION', $plugin_version );
define( $plugin_class_name, $plugin_version );

$requirements = [
	'php'     => '5.6',
	'wp'      => '4.5',
	'plugins' => [
		[
			'name'      => 'woocommerce/woocommerce.php',
			'nice_name' => 'WooCommerce',
			'version'   => '3.0',
		],
	],
];

require __DIR__ . '/vendor_prefixed/wpdesk/wp-plugin-flow-common/src/plugin-init-php52.php';

// disable free version.
if ( \PHP_VERSION_ID > 50300 ) {
	require_once __DIR__ . '/src/FreeDisabler/DhlExpressFreeDisabler.php';
	\WPDesk\FlexibleShippingDhlExpressPro\FreeDisabler\DhlExpressFreeDisabler::disable_free(); // phpcs:ignore
}
