<?php
/**
 * DHL Express disabler.
 *
 * @package WPDesk\FreeDisabler
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\FreeDisabler;

use FlexibleShippingDhlExpressProVendor\WPDesk\Notice\Notice;
use WPDesk\FlexibleShippingDhlExpressPro\FreeDisabler\NullPlugin;

/**
 * DhlExpressVendor namespace plugin disabler. Can disable a plugin.
 */
class DhlExpressFreeDisabler {

	/**
	 * Disable DHL Express free.
	 */
	public static function disable_free() {
		add_action(
			'wp_builder_plugin_class',
			static function ( $class ) {
				if ( is_a( $class, \WPDesk\FlexibleShippingDhl\Plugin::class, true ) ) { // phpcs:ignore
					require_once __DIR__ . '/NullPlugin.php';
					self::show_notice();

					return NullPlugin::class;
				}

				return $class;
			}
		);
	}

	/**
	 * Ensure notice that Free is disabled.
	 */
	public static function show_notice() {
		add_action(
			'plugins_loaded',
			static function () {
				if ( class_exists( Notice::class ) ) { // better make sure that our autoloader did his job.
					$action = 'deactivate';
					$plugin = 'flexible-shipping-dhl-express/flexible-shipping-dhl-express.php';
					$url    = sprintf(
						admin_url( 'plugins.php?action=' . $action . '&plugin=%s&plugin_status=all&paged=1&s' ),
						$plugin
					);
					$url    = wp_nonce_url( $url, $action . '-plugin_' . $plugin );
					new Notice(
						sprintf(
						// Translators: link.
							__(
								'"DHL Express for WooCommerce" plugin can be removed now since the PRO version took over its functionalities.%1$s%2$sClick here%3$s to deactivate "DHL Express for WooCommerce" plugin.',
								'flexible-shipping-dhl-express-pro'
							),
							'<br/>',
							'<a href="' . $url . '">',
							'</a>'
						)
					);
				}
			}
		);
	}

}
