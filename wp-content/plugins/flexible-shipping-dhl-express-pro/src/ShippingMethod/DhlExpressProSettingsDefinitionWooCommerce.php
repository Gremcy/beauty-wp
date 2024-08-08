<?php
/**
 * Settings definitions.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\ShippingMethod
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\ShippingMethod;

use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\DhlExpress\DhlSettingsDefinitionWooCommerce;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\CustomOrigin\CustomOriginSettingsDefinitionDecorator;

/**
 * Can handle global and instance settings for WooCommerce shipping method.
 */
class DhlExpressProSettingsDefinitionWooCommerce extends DhlSettingsDefinitionWooCommerce {

	/**
	 * @param string[] $form_fields .
	 */
	public function __construct( array $form_fields ) {
		parent::__construct( $form_fields );
		$this->global_method_fields = $this->prepare_global_method_fields( $this->global_method_fields );
	}

	/**
	 * @param string[] $free_plugin_method_fields
	 *
	 * @return string[]
	 */
	private function prepare_global_method_fields( array $free_plugin_method_fields ) {
		$free_plugin_method_fields[] = CustomOriginSettingsDefinitionDecorator::CUSTOM_ORIGIN;

		return $free_plugin_method_fields;
	}


}
