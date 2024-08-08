<?php

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;

/**
 * Can change shipping method type settings.
 */
class ShippingMethodTypeDecorator extends SettingsDefinition {

	const ENABLE_SHIPPING_METHOD_DEFAULT = 'no';

	/**
	 * @var SettingsDefinition
	 */
	private $settings;

	/**
	 * @param SettingsDefinition $settings
	 */
	public function __construct( SettingsDefinition $settings ) {
		$this->settings = $settings;
	}

	/**
	 * @return array<string, array<string, int|string>>
	 */
	public function get_form_fields() {
		$form_fields = $this->settings->get_form_fields();

		$form_fields[ DhlSettingsDefinition::ENABLE_SHIPPING_METHOD ] = [
			'title'       => __( 'Shipping Method Type', 'flexible-shipping-dhl-express-pro' ),
			'type'        => 'select',
			'options'     => [
				'no'  => __( 'Standard shipping methods', 'flexible-shipping-dhl-express-pro' ),
				'yes' => __( 'Global shipping method', 'flexible-shipping-dhl-express-pro' ),
			],
			'description' => sprintf(
				// Translators: strong tag.
				__( 'Select the %1$sStandard shipping methods%2$s if you want to add the \'DHL Express Live Rates\' shipping method within specific shipping zones or choose the %1$sGlobal shipping method%2$s to enable the DHL Express Live Rates for all the shipping zones in your store at once.', 'flexible-shipping-dhl-express-pro' ),
				'<strong>',
				'</strong>'
			),
			'desc_tip'    => false,
			'default'     => self::ENABLE_SHIPPING_METHOD_DEFAULT,
		];

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
		return $this->settings->validate_settings( $settings );
	}

}
