<?php
/**
 * Decorator for instance custom origin settings.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DestinationAddressType
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\InstanceCustomOrigin;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDecorators\BlackoutLeadDaysSettingsDefinitionDecoratorFactory;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomOrigin\InstanceCustomOriginFields;

/**
 * Can decorate settings for instance custom origin.
 */
class InstanceCustomOriginTitleSettingsDefinitionDecorator extends SettingsDefinitionModifierAfter {

	const OPTION_NAME = 'custom_origin_title';

	public function __construct( SettingsDefinition $settings_definition ) {
		parent::__construct(
			$settings_definition,
			BlackoutLeadDaysSettingsDefinitionDecoratorFactory::OPTION_ID,
			self::OPTION_NAME,
			[
				'title' => ( new InstanceCustomOriginFields( true ) )->get_custom_origin_section_title(),
				'type'  => 'title',
			]
		);
	}

}
