<?php

/**
 * Capability: CanRate class
 *
 * @package WPDesk\AbstractShipping\Shipment
 */
namespace FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\ShipmentRating;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Shipment;
/**
 * Interface for rate shipment
 *
 * @package WPDesk\AbstractShipping\ShippingServiceCapability
 */
interface CanRate
{
    /**
     * Rate shipment.
     *
     * @param SettingsValues  $settings Settings.
     * @param Shipment        $shipment Shipment.
     *
     * @return ShipmentRating
     */
    public function rate_shipment(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Shipment $shipment);
    /**
     * Is rate enabled?
     *
     * @param SettingsValues $settings .
     *
     * @return bool
     */
    public function is_rate_enabled(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings);
}
