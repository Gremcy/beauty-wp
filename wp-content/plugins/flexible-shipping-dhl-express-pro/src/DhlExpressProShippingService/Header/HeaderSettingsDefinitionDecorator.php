<?php
/**
 * Decorator for shipping zone header.
 *
 * @package WPDesk\FedexProShippingService\CustomOrigin
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\Header;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;

/**
 * Can decorate settings by adding shipping zone header.
 */
class HeaderSettingsDefinitionDecorator extends SettingsDefinitionModifierAfter {

	const DHL_HEADER_SHIPPING_ZONE = 'dhl_header_shipping_zone';

	/**
	 * @param SettingsDefinition $dhl_express_settings_definition .
	 */
	public function __construct( SettingsDefinition $dhl_express_settings_definition ) {
		$docs_link       = 'https://octol.io/dhlexpress-settings-docs';

		parent::__construct(
			$dhl_express_settings_definition,
			DhlSettingsDefinition::DHL_HEADER,
			self::DHL_HEADER_SHIPPING_ZONE,
			[
				'title'       => __( 'Method Settings', 'flexible-shipping-dhl-express-pro' ),
				'type'        => 'title',
				'description' => __( 'Set how DHL Express services are displayed.', 'flexible-shipping-dhl-express-pro' ),
			]
		);
	}

}
