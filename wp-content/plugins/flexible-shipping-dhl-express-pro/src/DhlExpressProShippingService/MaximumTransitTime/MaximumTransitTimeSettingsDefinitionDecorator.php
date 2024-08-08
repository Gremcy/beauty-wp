<?php
/**
 * Decorator for maximum transit time.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\MaximumTransitTime
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\MaximumTransitTime;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\EstimatedDelivery\EstimatedDeliverySettingsDefinitionDecorator;

/**
 * Can decorate settings for maximum transit time field.
 */
class MaximumTransitTimeSettingsDefinitionDecorator extends SettingsDefinitionModifierAfter {

	const OPTION_MAXIMUM_TRANSIT_TIME = 'maximum_transit_time';

	/**
	 * MaximumTransitTimeSettingsDefinitionDecorator constructor.
	 *
	 * @param SettingsDefinition $settings_definition .
	 */
	public function __construct( SettingsDefinition $settings_definition ) {
		parent::__construct(
			$settings_definition,
			EstimatedDeliverySettingsDefinitionDecorator::OPTION_DELIVERY_DATES,
			self::OPTION_MAXIMUM_TRANSIT_TIME,
			[
				'title'             => __( 'Maximum Time in Transit', 'flexible-shipping-dhl-express-pro' ),
				'type'              => 'number',
				'description'       => __( 'Maximum Time in Transit is used to define the number of maximum days goods can be in transit. Only days in transit are counted. This is often used for perishable goods.', 'flexible-shipping-dhl-express-pro' ),
				'desc_tip'          => true,
				'custom_attributes' => [
					'min'  => '0',
				],
			]
		);
	}

}
