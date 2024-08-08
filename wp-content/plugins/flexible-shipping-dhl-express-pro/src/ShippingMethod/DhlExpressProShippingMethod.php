<?php
/**
 * DHL Express Shipping Method.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\ShippingMethod
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\ShippingMethod;

use Exception;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\DhlExpress\DhlShippingMethod;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShippingMethod;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerFactory;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerSettings;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\ProShippingMethod\ProMethodFieldsFactory;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\ShippingBuilder\WooCommerceShippingBuilder;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\Header\HeaderSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\ShippingMethodTypeDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\PackerBox\BoxFactory;

/**
 * Dhl Express Shipping Method.
 */
class DhlExpressProShippingMethod extends DhlShippingMethod implements ShippingMethod\HasHandlingFees, ShippingMethod\HasCustomOrigin, ShippingMethod\HasInstanceCustomOrigin, ShippingMethod\HasEstimatedDeliveryDates {

	use ShippingMethod\Traits\HandlingFeesTrait;

	const UNIQUE_ID = 'flexible_shipping_dhl_express';

	/**
	 * .
	 *
	 * @param int $instance_id Instance ID.
	 */
	public function __construct( $instance_id = 0 ) {
		parent::__construct( $instance_id );
		/* @phpstan-ignore-next-line */
		$this->title = $this->get_option( 'title', $this->title );
		$this->set_supports_related_to_settings();
	}

	/**
	 * @return void
	 */
	private function set_supports_related_to_settings() {
		if ( 'no' === $this->get_option( DhlSettingsDefinition::ENABLE_SHIPPING_METHOD, ShippingMethodTypeDecorator::ENABLE_SHIPPING_METHOD_DEFAULT ) ) {
			$this->supports[] = 'shipping-zones';
			$this->supports[] = 'instance-settings';
		}
	}

	/**
	 * Init form fields.
	 *
	 * @return void
	 */
	public function build_form_fields() {
		$settings_definition = new DhlExpressProSettingsDefinitionWooCommerce( $this->form_fields );
		$this->form_fields = $settings_definition->get_form_fields();
		$this->instance_form_fields = $settings_definition->get_instance_form_fields();
	}

	/**
	 * Is unit metric?
	 *
	 * @return bool
	 */
	private function is_unit_metric() {
		return isset( $this->settings[ DhlSettingsDefinition::FIELD_UNITS ] )
			? DhlSettingsDefinition::UNITS_METRIC === $this->settings[ DhlSettingsDefinition::FIELD_UNITS ]
			: true;
	}

	/**
	 * Init.
	 *
	 * @return void
	 */
	protected function init() {
		parent::init();

		$box_factory          = new BoxFactory( $this->is_unit_metric() );
		$this->fields_factory = new ProMethodFieldsFactory( $this, $box_factory );

		$packer_settings  = new PackerSettings( 'https://octol.io/dhl-express-packing' );
		$packaging_method = $packer_settings->get_packaging_method( $this );

		$packer_factory = new PackerFactory( $packaging_method );
		$packer         = $packer_factory->create_packer( $packer_settings->get_shipping_boxes( $this, $box_factory->get_boxes() ) );

		$this->shipping_builder = new WooCommerceShippingBuilder( $packer, $packaging_method, $this->is_unit_metric() );
	}

	/**
	 * Render shipping method settings.
	 *
	 * @return void
	 * @throws Exception .
	 */
	public function admin_options() {
		if ( 0 === $this->instance_id ) {
			unset( $this->form_fields[ HeaderSettingsDefinitionDecorator::DHL_HEADER_SHIPPING_ZONE ] );
		}
		parent::admin_options();
		include __DIR__ . '/views/script-payment-account-number.php';
		include __DIR__ . '/views/script-delivery-dates.php';
		include __DIR__ . '/views/script-units-change.php';
		if ( 0 === $this->instance_id ) {
			include __DIR__ . '/views/settings-scrips.php';
		}
	}
}
