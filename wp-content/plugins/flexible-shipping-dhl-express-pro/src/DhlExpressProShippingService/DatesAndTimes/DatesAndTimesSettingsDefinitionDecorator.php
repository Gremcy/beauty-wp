<?php
/**
 * Decorator for dates and times section.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DatesAndTimes;
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DatesAndTimes;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierBefore;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;

/**
 * Can decorate settings by adding handling fees field.
 */
class DatesAndTimesSettingsDefinitionDecorator extends SettingsDefinitionModifierBefore {

	const DATES_AND_TIMES_TITLE = 'dates_and_times_title';

	const ADVANCED_OPTIONS_HEADER = 'advanced_options_header';

	/**
	 * DatesAndTimesSettingsDefinitionDecorator constructor.
	 *
	 * @param SettingsDefinition $settings_definition .
	 */
	public function __construct( SettingsDefinition $settings_definition ) {
		parent::__construct(
			$settings_definition,
			self::ADVANCED_OPTIONS_HEADER,
			self::DATES_AND_TIMES_TITLE,
			array(
				'title'       => __( 'Dates & Time', 'flexible-shipping-dhl-express-pro' ),
				'description' => __( 'Manage services\' dates information.', 'flexible-shipping-dhl-express-pro' ),
				'type'        => 'title',
			)
		);
	}

}
