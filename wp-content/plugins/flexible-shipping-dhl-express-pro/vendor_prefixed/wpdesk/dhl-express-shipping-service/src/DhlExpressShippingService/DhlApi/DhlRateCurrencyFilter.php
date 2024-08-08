<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\ShipmentRating;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\SingleRate;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shop\ShopSettings;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\Exception\NoRatesInCurrencyInRatingsException;
/**
 * Can filter rates by currency.
 *
 * @package WPDesk\DhlExpressShippingService\DhlApi
 */
class DhlRateCurrencyFilter implements \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\ShipmentRating
{
    /** @var ShipmentRating */
    private $rating;
    /** Shipping method helper.
     *
     * @var ShopSettings
     */
    private $shop_settings;
    /**
     * .
     *
     * @param ShipmentRating $rating .
     * @param ShopSettings $shop_settings .
     */
    public function __construct(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\ShipmentRating $rating, \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shop\ShopSettings $shop_settings)
    {
        $this->rating = $rating;
        $this->shop_settings = $shop_settings;
    }
    /**
     * Get filtered ratings.
     *
     * @return SingleRate[]
     */
    public function get_ratings()
    {
        $rates = [];
        $ratings = $this->rating->get_ratings();
        foreach ($ratings as $key => $rate) {
            if ($rate->total_charge->currency === $this->shop_settings->get_default_currency()) {
                $rates[$key] = $rate;
            }
        }
        if (0 !== \count($ratings) && 0 === \count($rates)) {
            throw new \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\Exception\NoRatesInCurrencyInRatingsException();
        }
        return $rates;
    }
}
