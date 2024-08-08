<?php
/**
 * Decorator for lead time.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\LeadTime
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\LeadTime;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\MaximumTransitTime\MaximumTransitTimeSettingsDefinitionDecorator;

/**
 * Can decorate settings for lead time field.
 */
class LeadTimeSettingsDefinitionDecorator extends SettingsDefinitionModifierAfter {

	const OPTION_LEAD_TIME = 'lead_time';

	/**
	 * LeadTimeSettingsDefinitionDecorator constructor.
	 *
	 * @param SettingsDefinition $settings_definition .
	 */
	public function __construct( SettingsDefinition $settings_definition ) {
		parent::__construct(
			$settings_definition,
			MaximumTransitTimeSettingsDefinitionDecorator::OPTION_MAXIMUM_TRANSIT_TIME,
			self::OPTION_LEAD_TIME,
			array(
				'title'             => __( 'Lead Time', 'flexible-shipping-dhl-express-pro' ),
				'type'              => 'number',
				'description'       => __(
					'Lead Time is used to define how many days are required to prepare an order for shipment. The delivery date or time will be updated for the selected number of days.',
					'flexible-shipping-dhl-express-pro'
				),
				'desc_tip'          => true,
				'default'           => '0',
				'custom_attributes' => array(
					'min' => 0,
				),
			)
		);
	}

}
