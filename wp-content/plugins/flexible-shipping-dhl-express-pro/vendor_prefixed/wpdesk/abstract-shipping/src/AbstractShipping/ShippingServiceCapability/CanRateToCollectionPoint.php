<?php

/**
 * Capability: CanRateToCollectionPoint class
 *
 * @package WPDesk\AbstractShipping\ShippingServiceCapability
 */
namespace FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\ShippingServiceCapability;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\CollectionPoints\CollectionPoint;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\ShipmentRating;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Shipment;
/**
 * Interface for rate shipment to collection point
 */
interface CanRateToCollectionPoint
{
    /**
     * Rate shipment to collection point.
     *
     * @param SettingsValues  $settings Settings.
     * @param Shipment        $shipment Shipment.
     * @param CollectionPoint $collection_point Collection point.
     *
     * @return ShipmentRating
     */
    public function rate_shipment_to_collection_point(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Shipment $shipment, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\CollectionPoints\CollectionPoint $collection_point);
    /**
     * Is rate to collection point enabled?
     *
     * @param SettingsValues $settings
     *
     * @return mixed
     */
    public function is_rate_to_collection_point_enabled(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings);
}
