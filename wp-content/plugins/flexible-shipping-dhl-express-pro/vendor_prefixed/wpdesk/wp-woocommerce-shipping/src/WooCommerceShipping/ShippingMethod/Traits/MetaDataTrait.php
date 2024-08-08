<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShippingMethod\Traits;

use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShippingBuilder\WooCommerceShippingMetaDataBuilder;
trait MetaDataTrait
{
    /**
     * Meta data builder.
     *
     * @var WooCommerceShippingMetaDataBuilder
     */
    private $metadata_builder;
    /**
     * Set metadata builder.
     *
     * @param WooCommerceShippingMetaDataBuilder $metadata_builder .
     */
    public function set_meta_data_builder(\FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShippingBuilder\WooCommerceShippingMetaDataBuilder $metadata_builder)
    {
        $this->metadata_builder = $metadata_builder;
    }
}
