<?php

/**
 * Price none adjustment.
 *
 * @package WPDesk\WooCommerceShipping\HandlingFees
 */
namespace FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\HandlingFees;

/**
 * Can apply none value to price.
 */
class PriceAdjustmentNone implements \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\HandlingFees\PriceAdjustment
{
    const ADJUSTMENT_TYPE = 'none';
    /**
     * @param float $price
     *
     * @return float
     */
    public function apply_on_price($price)
    {
        return $price;
    }
}
