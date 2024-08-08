<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuoteResponse;
use Psr\Log\LoggerInterface;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Exception\UnitConversionException;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanInsure;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanPack;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanTestSettings;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shop\ShopSettings;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\Exception\CurrencySwitcherException;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Exception\InvalidSettingsException;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Exception\RateException;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\ShipmentRating;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Shipment;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingService;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanRate;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\HasSettings;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\ConnectionChecker;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateCurrencyFilter;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateCustomServicesFilter;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateReplyInterpretation;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateRequestBuilder;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\Sender;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlSender;
/**
 * DHL main shipping class injected into WooCommerce shipping method.
 *
 * @package WPDesk\DhlShippingService
 */
class DhlShippingService extends \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingService implements \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\HasSettings, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanRate, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanInsure, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanPack, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability\CanTestSettings
{
    /** Logger.
     *
     * @var LoggerInterface
     */
    private $logger;
    /** Shipping method helper.
     *
     * @var ShopSettings
     */
    private $shop_settings;
    const UNIQUE_ID = 'flexible_shipping_dhl_express';
    /**
     * Sender.
     *
     * @var Sender
     */
    private $sender;
    /**
     * DhlShippingService constructor.
     *
     * @param LoggerInterface $logger Logger.
     * @param ShopSettings $helper Helper.
     */
    public function __construct(\Psr\Log\LoggerInterface $logger, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shop\ShopSettings $helper)
    {
        $this->logger = $logger;
        $this->shop_settings = $helper;
    }
    public function is_rate_enabled(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings)
    {
        return \true;
    }
    /**
     * Set logger.
     *
     * @param LoggerInterface $logger Logger.
     */
    public function setLogger(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
    /**
     * Set sender.
     *
     * @param Sender $sender Sender.
     */
    public function set_sender(\FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\Sender $sender)
    {
        $this->sender = $sender;
    }
    /**
     * Get sender.
     *
     * @return Sender
     */
    public function get_sender()
    {
        return $this->sender;
    }
    /**
     * Create reply interpretation.
     *
     * @param GetQuoteResponse $rate_reply .
     * @param ShopSettings $shop_settings .
     * @param SettingsValues $settings .
     *
     * @return DhlRateReplyInterpretation
     */
    protected function create_reply_interpretation(\FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuoteResponse $rate_reply, $shop_settings, $settings)
    {
        return new \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateReplyInterpretation($rate_reply, $shop_settings->is_tax_enabled(), $shop_settings->get_default_currency());
    }
    /**
     * Rate shipment.
     *
     * @param SettingsValues $settings Settings Values.
     * @param Shipment $shipment Shipment.
     *
     * @return ShipmentRating
     * @throws InvalidSettingsException InvalidSettingsException.
     * @throws RateException RateException.
     * @throws UnitConversionException Weight exception.
     * @throws \Exception
     */
    public function rate_shipment(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Shipment $shipment)
    {
        if (!$this->get_settings_definition()->validate_settings($settings)) {
            throw new \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Exception\InvalidSettingsException();
        }
        $this->verify_currency($this->shop_settings->get_default_currency(), $this->shop_settings->get_currency());
        $request_builder = $this->create_rate_request_builder($settings, $shipment, $this->shop_settings);
        $request = $request_builder->build_request();
        $this->set_sender(new \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlSender($this->logger, $this->is_testing($settings)));
        $response = $this->get_sender()->send($request);
        $reply = $this->create_reply_interpretation($response, $this->shop_settings, $settings);
        return $this->create_filter_rates_by_currency(new \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateCustomServicesFilter($reply, $settings));
    }
    /**
     * Create rate request builder.
     *
     * @param SettingsValues $settings .
     * @param Shipment       $shipment .
     * @param ShopSettings   $shop_settings .
     *
     * @return DhlRateRequestBuilder
     */
    protected function create_rate_request_builder(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Shipment $shipment, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shop\ShopSettings $shop_settings)
    {
        return new \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateRequestBuilder($settings, $shipment, $shop_settings);
    }
    /**
     * Creates rate filter by currency.
     *
     * @param ShipmentRating $rating .
     *
     * @return DhlRateCurrencyFilter .
     */
    protected function create_filter_rates_by_currency(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\ShipmentRating $rating)
    {
        return new \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateCurrencyFilter($rating, $this->shop_settings);
    }
    /**
     * Verify currency.
     *
     * @param string $default_shop_currency Shop currency.
     * @param string $checkout_currency Checkout currency.
     *
     * @return void
     * @throws CurrencySwitcherException .
     */
    protected function verify_currency($default_shop_currency, $checkout_currency)
    {
        if ($default_shop_currency !== $checkout_currency) {
            throw new \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\Exception\CurrencySwitcherException($this->shop_settings);
        }
    }
    /**
     * Should I use a test API?
     *
     * @param \WPDesk\AbstractShipping\Settings\SettingsValues $settings Settings.
     *
     * @return bool
     */
    public function is_testing(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings)
    {
        $testing = \false;
        if ($settings->has_value('testing') && $this->shop_settings->is_testing()) {
            $testing = 'yes' === $settings->get_value('testing') ? \true : \false;
        }
        return $testing;
    }
    /**
     * Get settings
     *
     * @return DhlSettingsDefinition
     */
    public function get_settings_definition()
    {
        return new \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition($this->shop_settings);
    }
    /**
     * Get unique ID.
     *
     * @return string
     */
    public function get_unique_id()
    {
        return self::UNIQUE_ID;
    }
    /**
     * Get name.
     *
     * @return string
     */
    public function get_name()
    {
        return \__('DHL Express Live Rates', 'flexible-shipping-dhl-express-pro');
    }
    /**
     * Get description.
     *
     * @return string
     */
    public function get_description()
    {
        return \sprintf(\__('Dynamically calculated DHL Express live rates based on the established DHL Express API connection. %1$sLearn more →%2$s', 'flexible-shipping-dhl-express-pro'), '<a href="https://octol.io/dhlexpress-settings-docs" target="_blank">', '</a>');
    }
    /**
     * Pings API.
     * Returns empty string on success or error message on failure.
     *
     * @param SettingsValues  $settings .
     * @param LoggerInterface $logger .
     * @return string
     */
    public function check_connection(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings, \Psr\Log\LoggerInterface $logger)
    {
        try {
            $connection_checker = new \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\ConnectionChecker($settings, $logger, $this->is_testing($settings));
            $connection_checker->check_connection();
            return '';
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    /**
     * Returns field ID after which API Status field should be added.
     *
     * @return string
     */
    public function get_field_before_api_status_field()
    {
        return \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition::FIELD_API_PASSWORD;
    }
}
