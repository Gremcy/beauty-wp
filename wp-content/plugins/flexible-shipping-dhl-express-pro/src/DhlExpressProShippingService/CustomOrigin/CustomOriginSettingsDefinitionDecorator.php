<?php
/**
 * Decorator for custom origin settings field.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\CustomOrigin
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\CustomOrigin;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;

/**
 * Can decorate settings by adding handling fees field.
 */
class CustomOriginSettingsDefinitionDecorator extends SettingsDefinitionModifierAfter {

	/** @var string . */
	const CUSTOM_ORIGIN = 'custom_origin';

	/** @var string . */
	const FIELD_TYPE = 'custom_origin';

	/**
	 * CustomOriginSettingsDefinitionDecorator constructor.
	 *
	 * @param SettingsDefinition $dhl_express_settings_definition .
	 */
	public function __construct( SettingsDefinition $dhl_express_settings_definition ) {
		parent::__construct(
			$dhl_express_settings_definition,
			DhlSettingsDefinition::FIELD_SERVICES_TABLE,
			self::CUSTOM_ORIGIN,
			array(
				'type' => self::FIELD_TYPE,
			)
		);
	}
}
