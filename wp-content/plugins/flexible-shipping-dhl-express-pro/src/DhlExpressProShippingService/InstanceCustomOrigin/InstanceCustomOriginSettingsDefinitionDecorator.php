<?php
/**
 * Decorator for instance custom origin settings.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DestinationAddressType
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\InstanceCustomOrigin;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;

/**
 * Can decorate settings for instance custom origin.
 */
class InstanceCustomOriginSettingsDefinitionDecorator extends SettingsDefinitionModifierAfter {

	const OPTION_NAME = 'instance_custom_origin';

	public function __construct( SettingsDefinition $settings_definition ) {
		parent::__construct(
			$settings_definition,
			InstanceCustomOriginTitleSettingsDefinitionDecorator::OPTION_NAME,
			self::OPTION_NAME,
			[
				'type' => 'instance_custom_origin',
			]
		);
	}

}
