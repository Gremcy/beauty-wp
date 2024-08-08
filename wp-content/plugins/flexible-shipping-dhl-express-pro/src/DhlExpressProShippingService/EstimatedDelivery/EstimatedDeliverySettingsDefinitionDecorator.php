<?php
/**
 * Decorator for estimated delivery settings.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\EstimatedDelivery
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\EstimatedDelivery;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DatesAndTimes\DatesAndTimesSettingsDefinitionDecorator;

/**
 * Can decorate settings for estimated delivery field.
 */
class EstimatedDeliverySettingsDefinitionDecorator extends SettingsDefinitionModifierAfter {

	const OPTION_DELIVERY_DATES = 'delivery_dates';

	const OPTION_NONE                 = 'none';
	const OPTION_DELIVERY_DATE        = 'delivery_date';
	const OPTION_DAYS_TO_ARRIVAL_DATE = 'days_to_arrival_date';

	/**
	 * EstimatedDeliverySettingsDefinitionDecorator constructor.
	 *
	 * @param SettingsDefinition $settings_definition .
	 */
	public function __construct( SettingsDefinition $settings_definition ) {
		parent::__construct(
			$settings_definition,
			DatesAndTimesSettingsDefinitionDecorator::DATES_AND_TIMES_TITLE,
			self::OPTION_DELIVERY_DATES,
			array(
				'title'       => __( 'Estimated Delivery', 'flexible-shipping-dhl-express-pro' ),
				'type'        => 'select',
				'options'     => array(
					self::OPTION_NONE            => __(
						'None',
						'flexible-shipping-dhl-express-pro'
					),
					self::OPTION_DAYS_TO_ARRIVAL_DATE   => __(
						'Show estimated days to delivery date',
						'flexible-shipping-dhl-express-pro'
					),
					self::OPTION_DELIVERY_DATE   => __(
						'Show estimated delivery date',
						'flexible-shipping-dhl-express-pro'
					),
				),
				'description' => __(
					'You can show customers an estimated delivery date or time in transit. The information will be added to the service name in the checkout.',
					'flexible-shipping-dhl-express-pro'
				),
				'desc_tip'    => true,
				'default'     => self::OPTION_NONE,
			)
		);
	}

}
