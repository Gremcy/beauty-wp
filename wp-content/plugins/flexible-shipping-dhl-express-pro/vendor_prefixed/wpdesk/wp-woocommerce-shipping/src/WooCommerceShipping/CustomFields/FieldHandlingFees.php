<?php

/**
 * Handling fees.
 *
 * @package WPDesk\WooCommerceShipping\CustomFields
 */
namespace FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields;

use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\HandlingFees\PriceAdjustmentFixed;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\HandlingFees\PriceAdjustmentNone;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\HandlingFees\PriceAdjustmentPercentage;
/**
 * Can handle handling fees.
 *
 * @TODO: this is not a field. Need to be moved or refactored to placeholder injection.
 */
class FieldHandlingFees
{
    const FIELD_TYPE = 'handling_fees';
    const OPTION_PRICE_ADJUSTMENT_TYPE = 'price_adjustment_type';
    const OPTION_PRICE_ADJUSTMENT_VALUE = 'price_adjustment_value';
    /**
     * Add to settings.
     *
     * @param array $settings_fields
     * @param array $field
     *
     * @return array
     */
    public function add_to_settings(array $settings_fields, array $field)
    {
        $settings_fields[self::OPTION_PRICE_ADJUSTMENT_TYPE] = array('title' => \__('Handling Fees', 'flexible-shipping-dhl-express-pro'), 'type' => 'select', 'options' => array(\FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\HandlingFees\PriceAdjustmentNone::ADJUSTMENT_TYPE => \__('None', 'flexible-shipping-dhl-express-pro'), \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\HandlingFees\PriceAdjustmentFixed::ADJUSTMENT_TYPE => \__('Fixed value', 'flexible-shipping-dhl-express-pro'), \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\HandlingFees\PriceAdjustmentPercentage::ADJUSTMENT_TYPE => \__('Percentage', 'flexible-shipping-dhl-express-pro')), 'description' => \__('Use this option to apply the handling fees to the rates. You can use either fixed or percentage values, including the negative ones for discounts.', 'flexible-shipping-dhl-express-pro'), 'desc_tip' => \true, 'default' => \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\HandlingFees\PriceAdjustmentNone::ADJUSTMENT_TYPE, 'class' => isset($field['class']) ? $field['class'] : '');
        $settings_fields[self::OPTION_PRICE_ADJUSTMENT_VALUE] = array('title' => \__('Fees Amount', 'flexible-shipping-dhl-express-pro'), 'type' => 'decimal', 'description' => \__('Enter a positive value to charge your customers additionally or a negative one to apply the discount. If you use the currency switcher, the final price incl. Handling Fee will be automatically converted to the currently active currency in your shop. The rates will also include the taxes based on your current Tax settings.', 'flexible-shipping-dhl-express-pro'), 'desc_tip' => \true, 'default' => '', 'class' => isset($field['class']) ? $field['class'] : '');
        return $settings_fields;
    }
}
