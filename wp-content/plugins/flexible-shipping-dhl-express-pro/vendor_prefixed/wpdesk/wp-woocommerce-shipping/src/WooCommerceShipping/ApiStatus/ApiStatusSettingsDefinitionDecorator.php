<?php

/**
 * Decorator for api status settings field.
 *
 * @package WPDesk\WooCommerceShipping\ApiStatus
 */
namespace FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ApiStatus;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatusAjax;
/**
 * Can decorate settings for estimated delivery field.
 */
class ApiStatusSettingsDefinitionDecorator extends \FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\DefinitionModifier\SettingsDefinitionModifierAfter
{
    const API_STATUS = 'api_status';
    /**
     * ApiStatusSettingsDefinitionDecorator constructor.
     *
     * @param SettingsDefinition $ups_settings_definition .
     * @param string $after_field API Status field will be added after this field.
     * @param FieldApiStatusAjax $api_status_ajax_handler .
     * @param string $service_id .
     */
    public function __construct(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsDefinition $ups_settings_definition, $after_field, \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatusAjax $api_status_ajax_handler, $service_id)
    {
        parent::__construct($ups_settings_definition, $after_field, self::API_STATUS, ['title' => \__('API Connection Status', 'flexible-shipping-dhl-express-pro'), 'type' => 'api_status', 'class' => 'flexible_shipping_api_status', 'default' => \__('Checking...', 'flexible-shipping-dhl-express-pro'), 'description' => \__('If you encounter any problems with establishing the API connection, the detailed information on its cause will be displayed here.', 'flexible-shipping-dhl-express-pro'), 'desc_tip' => \true, \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus::SECURITY_NONCE => \wp_create_nonce($api_status_ajax_handler->get_nonce_name()), \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatus::SHIPPING_SERVICE_ID => $service_id]);
    }
}
