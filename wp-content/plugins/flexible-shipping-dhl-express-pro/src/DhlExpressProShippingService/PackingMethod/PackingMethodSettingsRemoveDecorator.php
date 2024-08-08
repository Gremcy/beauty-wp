<?php
/**
 * Decorator for packing method settings.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DatesAndTimes;
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\PackingMethod;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierBefore;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerSettings;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\HandlingFees\HandlingFeesSettingsDefinitionDecorator;

/**
 * Can decorate settings by remove packing method field.
 */
class PackingMethodSettingsRemoveDecorator extends SettingsDefinitionModifierBefore {

	/**
	 * Decorated settings definition.
	 *
	 * @var SettingsDefinition
	 */
	private $decorated_settings_definition;

	/**
	 * PackingMethodSettingsDefinitionDecorator constructor.
	 *
	 * @param SettingsDefinition $settings_definition .
	 */
	public function __construct( SettingsDefinition $settings_definition ) {
		parent::__construct( $settings_definition, '', '', [] );
		$this->decorated_settings_definition = $settings_definition;
	}

	/**
	 * @return array[]
	 * @phpstan-ignore-next-line
	 */
	public function get_form_fields() {
		$form_fields = $this->decorated_settings_definition->get_form_fields();
		unset( $form_fields[ DhlSettingsDefinition::FIELD_PACKING_METHOD ] );

		return $form_fields;
	}

	/**
	 * Validate settings.
	 *
	 * @param SettingsValues $settings Settings values.
	 *
	 * @return bool
	 */
	public function validate_settings( SettingsValues $settings ) {
		return $this->decorated_settings_definition->validate_settings( $settings );
	}

}
