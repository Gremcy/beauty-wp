<?php
/**
 * Settings sidebar.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro
 */

namespace WPDesk\FlexibleShippingDhlExpressPro;

use FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use WPDesk\FlexibleShippingDhlExpressPro\ShippingMethod\DhlExpressProShippingMethod;

/**
 * Can display settings sidebar.
 */
class SettingsSidebar implements Hookable {

	/**
	 * Hooks.
	 */
	public function hooks() {
		add_action(
			DhlExpressProShippingMethod::UNIQUE_ID . '_settings_sidebar',
			array(
				$this,
				'display_settings_sidebar_when_no_conditional_methods',
			)
		);
	}

	/**
	 * Maybe display settings sidebar.
	 *
	 * @return void
	 */
	public function display_settings_sidebar_when_no_conditional_methods() {
		if ( ! defined( 'FLEXIBLE_SHIPPING_CONDITIONAL_METHODS_VERSION' ) ) {
			$url = get_user_locale() === 'pl_PL' ? 'https://octol.io/csm-dhl-express-box-pl' : 'https://octol.io/csm-dhl-express-box';
			include __DIR__ . '/views/settings-sidebar-html.php';
		}
	}
}
