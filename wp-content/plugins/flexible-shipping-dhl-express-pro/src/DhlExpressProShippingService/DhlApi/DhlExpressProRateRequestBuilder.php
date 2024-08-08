<?php
/**
 * DHL Express API: Build request.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi;

use Exception;
use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\BlackoutLeadDays;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDecorators\BlackoutLeadDaysSettingsDefinitionDecoratorFactory;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Shipment;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shop\ShopSettings;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateRequestBuilder;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerSettings;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\CutoffTime\CutoffTimeRequestModifier;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\CutoffTime\CutoffTimeSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\EstimatedDelivery\EstimatedDeliveryRequestModifier;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\EstimatedDelivery\EstimatedDeliverySettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\LeadTime\LeadTimeRequestModifier;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\LeadTime\LeadTimeSettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\PackingMethod\PackingMethodRequestModifier;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\PackingMethod\PackingMethodSettingsDefinitionDecorator;

/**
 * Build request for DHL Express Rate
 */
class DhlExpressProRateRequestBuilder extends DhlRateRequestBuilder {

	/**
	 * @var DhlExpressRateRequestModifier[]
	 */
	private $rate_request_modifiers = [];

	/**
	 * WooCommerce shipment.
	 *
	 * @var Shipment
	 * @phpstan-ignore-next-line
	 */
	private $shipment;

	/**
	 * Settings values.
	 *
	 * @var SettingsValues
	 */
	private $settings;

	/**
	 * Shop settings.
	 *
	 * @var ShopSettings
	 * @phpstan-ignore-next-line
	 */
	private $shop_settings;

	/**
	 * DhlExpressProRateRequestBuilder constructor.
	 *
	 * @param SettingsValues $settings .
	 * @param Shipment       $shipment .
	 * @param ShopSettings   $helper   .
	 */
	public function __construct( SettingsValues $settings, Shipment $shipment, ShopSettings $helper ) {
		parent::__construct( $settings, $shipment, $helper );
		$this->settings      = $settings;
		$this->shipment      = $shipment;
		$this->shop_settings = $helper;
		$this->init_modifiers();
	}

	/**
	 * Init modifiers.
	 *
	 * @return void
	 */
	private function init_modifiers() {
		$delivery_dates = $this->settings->get_value(
			EstimatedDeliverySettingsDefinitionDecorator::OPTION_DELIVERY_DATES,
			EstimatedDeliverySettingsDefinitionDecorator::OPTION_NONE
		);
		/* @phpstan-ignore-next-line */
		$lead_time      = (int) $this->settings->get_value(
			LeadTimeSettingsDefinitionDecorator::OPTION_LEAD_TIME,
			'0'
		);
		/* @phpstan-ignore-next-line */
		$cutoff_time    = (string) $this->settings->get_value(
			CutoffTimeSettingsDefinitionDecorator::OPTION_CUTOFF_TIME,
			''
		);

		if ( EstimatedDeliverySettingsDefinitionDecorator::OPTION_NONE !== $delivery_dates ) {
			$blackout_lead_days_settings    = $this->settings->get_value( BlackoutLeadDaysSettingsDefinitionDecoratorFactory::OPTION_ID, '' );
			$blackout_lead_days             = new BlackoutLeadDays( is_array( $blackout_lead_days_settings ) ? $blackout_lead_days_settings : [], $lead_time );
			$this->rate_request_modifiers[] = new LeadTimeRequestModifier( $blackout_lead_days );
			$this->rate_request_modifiers[] = new CutoffTimeRequestModifier( $lead_time, $cutoff_time, $blackout_lead_days );
		}

		/* @phpstan-ignore-next-line */
		$packing_method = (string) $this->settings->get_value( PackerSettings::OPTION_PACKAGING_METHOD, PackerSettings::PACKING_METHOD_WEIGHT );
		/* @phpstan-ignore-next-line */
		$shipping_boxes = (string) $this->settings->get_value( PackerSettings::OPTION_SHIPPING_BOXES, '[]' );
		if ( PackerSettings::PACKING_METHOD_BOX === $packing_method ) {
			/* @phpstan-ignore-next-line */
			$this->rate_request_modifiers[] = new PackingMethodRequestModifier( json_decode( $shipping_boxes, true ) );
		}
	}

	/**
	 * Build request.
	 *
	 * @return GetQuote
	 * @throws Exception .
	 */
	public function build_request() {
		$request = parent::build_request();
		foreach ( $this->rate_request_modifiers as $modifier ) {
			$request = $modifier->modify_rate_request( $request );
		}

		return $request;
	}

}
