<?php
/**
 * DhlExpressVendor namespace null plugin. Can be injected into DhlExpressVendor plugin builder to disable plugin.
 *
 * @package WPDesk\FreeDisabler
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\FreeDisabler;

use DhlVendor\WPDesk\PluginBuilder\Plugin\SlimPlugin;

if ( class_exists( SlimPlugin::class ) ) {

	/**
	 * DhlExpressVendor namespace null plugin. Can be injected into DhlExpressVendor plugin builder to disable plugin.
	 *
	 * @package WPDesk\FreeDisabler
	 */
	final class NullPlugin extends SlimPlugin {
		/**
		 * Some null text-domain.
		 *
		 * @return string
		 */
		public function get_text_domain() {
			return 'null-text-domain';
		}

		/**
		 * Disabled init.
		 */
		public function init() {
			// do nothing.
		}

	}
} else {
	/**
	 * DhlExpressVendor namespace null plugin. Can be injected into DhlExpressVendor plugin builder to disable plugin.
	 *
	 * @package WPDesk\FreeDisabler
	 */
	final class NullPlugin {

		/**
		 * .
		 */
		public function init() {
			// do nothing.
		}
	}
}
