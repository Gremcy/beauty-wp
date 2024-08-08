<?php
/**
 * Decorator for handling fees settings field.
 *
 * @package WPDesk\UpsProShippingService\DestinationAddressType
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\HandlingFees;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\FieldHandlingFees;

/**
 * Can decorate settings by adding handling fees field.
 */
class HandlingFeesSettingsDefinitionDecorator extends SettingsDefinitionModifierAfter {

	const HANDLING_FEES = 'handling_fees';

	/**
	 * HandlingFeesSettingsDefinitionDecorator constructor.
	 *
	 * @param SettingsDefinition $settings_definition .
	 */
	public function __construct( SettingsDefinition $settings_definition ) {
		parent::__construct(
			$settings_definition,
			DhlSettingsDefinition::FIELD_INSURANCE,
			self::HANDLING_FEES,
			array(
				'type' => FieldHandlingFees::FIELD_TYPE,
			)
		);
	}

}
