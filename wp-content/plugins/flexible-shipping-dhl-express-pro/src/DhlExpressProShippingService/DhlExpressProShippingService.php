<?php
/**
 * Shipping Service.
 *
 * @package WPDesk\DhlExpressProShippingService
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuoteResponse;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\ShipmentRating;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Shipment;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanPack;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanReturnDeliveryDate;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shop\ShopSettings;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateReplyInterpretation;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlShippingService;
use Psr\Log\LoggerInterface;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi\DhlExpressProRateReplyInterpretation;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi\DhlExpressProRateRequestBuilder;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\EstimatedDelivery\EstimatedDeliverySettingsDefinitionDecorator;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\MaximumTransitTime\MaximumTransitTimeRatesFilter;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\MaximumTransitTime\MaximumTransitTimeSettingsDefinitionDecorator;

/**
 * DHL Express PRO main shipping class injected into WooCommerce shipping method.
 */
class DhlExpressProShippingService extends DhlShippingService implements CanReturnDeliveryDate, CanPack {

	/**
	 * @var ShopSettings
	 * @phpstan-ignore-next-line
	 */
	private $shop_settings;

	/**
	 * .
	 *
	 * @param LoggerInterface $logger        Logger.
	 * @param ShopSettings    $shop_settings Shop settings.
	 */
	public function __construct( LoggerInterface $logger, ShopSettings $shop_settings ) {
		parent::__construct( $logger, $shop_settings );

		$this->shop_settings = $shop_settings;
	}

	/**
	 * Get settings
	 *
	 * @return SettingsDefinition
	 */
	public function get_settings_definition() {
		return new DhlExpressProSettingsDefinition( parent::get_settings_definition() );
	}

	/**
	 * @param SettingsValues $settings      .
	 * @param Shipment       $shipment      .
	 * @param ShopSettings   $shop_settings .
	 *
	 * @return DhlExpressProRateRequestBuilder
	 */
	protected function create_rate_request_builder(
		SettingsValues $settings,
		Shipment $shipment,
		ShopSettings $shop_settings
	) {
		return new DhlExpressProRateRequestBuilder( $settings, $shipment, $shop_settings );
	}

	/**
	 * Create reply interpretation.
	 *
	 * @param GetQuoteResponse $rate_reply    .
	 * @param ShopSettings     $shop_settings .
	 * @param SettingsValues   $settings      .
	 *
	 * @return ShipmentRating
	 */
	protected function create_reply_interpretation( GetQuoteResponse $rate_reply, $shop_settings, $settings ) {
		return new DhlExpressProRateReplyInterpretation( $rate_reply, $shop_settings->is_tax_enabled(), $shop_settings->get_default_currency() );
	}

	/**
	 * Verify currency.
	 *
	 * @param string $default_shop_currency Shop currency.
	 * @param string $checkout_currency     Checkout currency.
	 *
	 * @return void
	 */
	protected function verify_currency( $default_shop_currency, $checkout_currency ) {
		// Do nothing. We currently support multi currency.
	}

}
