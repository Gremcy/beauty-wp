<?php

/**
 * Capability: HasHandlingFees interface.
 *
 * @package WPDesk\WooCommerceShipping\ShippingMethod
 */
namespace FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShippingMethod;

use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\CouldNotFindService;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\CustomField;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\FieldsFactory;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\Services\FieldServices;
/**
 * Field factory dedicated for use in Shipping Method.
 *
 * @package WPDesk\WooCommerceShipping\ShippingMethod
 */
class MethodFieldsFactory implements \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\FieldsFactory
{
    /** @var CustomField[] */
    private $created_fields = [];
    /**
     * Create field - factory method.
     *
     * @param string $type Field type.
     * @param array $data Field data.
     *
     * @return CustomField
     * @throws \Exception View doesn't exists.
     *
     */
    public function create_field($type, $data)
    {
        $key = isset($data['field_key']) ? $data['field_key'] : $type;
        switch ($type) {
            case \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\Services\FieldServices::get_type_name():
                $available_services = isset($data['options']) ? $data['options'] : array();
                return $this->remember_creation(new \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\Services\FieldServices($available_services), $key);
            case \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus::get_type_name():
                $shipping_service_id = isset($data[\FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus::SHIPPING_SERVICE_ID]) ? $data[\FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus::SHIPPING_SERVICE_ID] : array();
                $security_nonce = isset($data[\FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus::SECURITY_NONCE]) ? $data[\FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus::SECURITY_NONCE] : array();
                return $this->remember_creation(new \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus($shipping_service_id, $security_nonce), $key);
        }
        throw new \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\CouldNotFindService($type);
    }
    /**
     * @param CustomField $field
     * @param string $key
     *
     * @return CustomField
     */
    protected function remember_creation(\FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\CustomField $field, $key)
    {
        $this->created_fields[$key] = $field;
        return $field;
    }
    /**
     * Returns true if field type is supported by factory and can be created.
     *
     * @param string $type Field type - the name that can be used in WC settings.
     *
     * @return bool
     */
    public function is_field_supported($type)
    {
        return \in_array($type, [\FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\Services\FieldServices::get_type_name(), \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus::get_type_name()], \true);
    }
    /**
     * Factory should remember all created fields so it can render all used fields footers.
     *
     * @return string
     */
    public function render_used_fields_footers()
    {
        $footer = '';
        foreach ($this->created_fields as $key => $field) {
            $footer .= $field->render_footer($key);
        }
        return $footer;
    }
}
