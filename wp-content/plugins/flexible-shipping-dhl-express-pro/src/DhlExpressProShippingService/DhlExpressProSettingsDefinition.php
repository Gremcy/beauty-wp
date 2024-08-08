<?php
/**
 * Settings definition.
 *
 * @package WPDesk\DhlExpressProShippingService
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Exception\SettingsFieldNotExistsException;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDecorators\BlackoutLeadDaysSettingsDefinitionDecoratorFactory;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\CustomOrigin\CustomOriginSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\CutoffTime\CutoffTimeSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DatesAndTimes\DatesAndTimesSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\EstimatedDelivery\EstimatedDeliverySettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\HandlingFees\HandlingFeesSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\Header\HeaderSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\InstanceCustomOrigin\InstanceCustomOriginSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\InstanceCustomOrigin\InstanceCustomOriginTitleSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\LeadTime\LeadTimeSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\MaximumTransitTime\MaximumTransitTimeSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\PackingMethod\PackingMethodSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\PackingMethod\PackingMethodSettingsRemoveDecorator;

/**
 * Settings definitions.
 */
class DhlExpressProSettingsDefinition extends SettingsDefinition {

	/**
	 * UPS settings definition.
	 *
	 * @var SettingsDefinition
	 */
	private $dhl_express_settings_definition;

	/**
	 * UpsProSettingsDefinition constructor.
	 *
	 * @param DhlSettingsDefinition $dhl_express_settings_definition DHL Express settings definition.
	 */
	public function __construct( DhlSettingsDefinition $dhl_express_settings_definition ) {
		$dhl_express_settings_definition = new CustomOriginSettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new HandlingFeesSettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new DatesAndTimesSettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new EstimatedDeliverySettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new MaximumTransitTimeSettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new LeadTimeSettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new CutoffTimeSettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new PackingMethodSettingsRemoveDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new PackingMethodSettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = ( new BlackoutLeadDaysSettingsDefinitionDecoratorFactory() )->create_decorator( $dhl_express_settings_definition, CutoffTimeSettingsDefinitionDecorator::OPTION_CUTOFF_TIME, false );
		$dhl_express_settings_definition = new HeaderSettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new ShippingMethodTypeDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new InstanceCustomOriginTitleSettingsDefinitionDecorator( $dhl_express_settings_definition );
		$dhl_express_settings_definition = new InstanceCustomOriginSettingsDefinitionDecorator( $dhl_express_settings_definition );

		$this->dhl_express_settings_definition = $dhl_express_settings_definition;
	}

	/**
	 * Get form fields.
	 *
	 * @return array
	 *
	 * @throws SettingsFieldNotExistsException .
	 * @phpstan-ignore-next-line
	 */
	public function get_form_fields() {
		return $this->dhl_express_settings_definition->get_form_fields();
	}

	/**
	 * Validate settings.
	 *
	 * @param SettingsValues $settings Settings.
	 *
	 * @return bool
	 */
	public function validate_settings( SettingsValues $settings ) {
		return $this->dhl_express_settings_definition->validate_settings( $settings );
	}
}
