<?php

/**
 * DHL Shipping Method.
 *
 * @package WPDesk\FlexibleShippingDhl
 */
namespace FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\DhlExpress;

use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlShippingService;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\ApiStatus\FieldApiStatusAjax;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShippingMethod;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerFactory;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerSettings;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\ShippingBuilder\WooCommerceShippingBuilder;
/**
 * DHL Shipping Method.
 */
class DhlShippingMethod extends \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShippingMethod implements \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\ShippingMethod\HasRateCache
{
    const UNIQUE_ID = \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlShippingService::UNIQUE_ID;
    /**
     * .
     *
     * @var FieldApiStatusAjax
     */
    protected static $api_status_ajax_handler;
    /**
     * .
     *
     * @param int $instance_id Instance ID.
     */
    public function __construct($instance_id = 0)
    {
        parent::__construct($instance_id);
        $this->title = $this->get_option('title', $this->title);
        /* @phpstan-ignore-line */
    }
    /**
     * Init form fields.
     */
    public function build_form_fields()
    {
        $settings_definition = new \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\DhlExpress\DhlSettingsDefinitionWooCommerce($this->form_fields);
        $this->form_fields = $settings_definition->get_form_fields();
        $this->instance_form_fields = $settings_definition->get_instance_form_fields();
    }
    /**
     * Is unit metric?
     *
     * @return bool
     */
    private function is_unit_metric()
    {
        return isset($this->settings[\FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition::FIELD_UNITS]) ? \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition::UNITS_METRIC === $this->settings[\FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition::FIELD_UNITS] : \true;
    }
    /**
     * Init.
     *
     * @return void
     */
    protected function init()
    {
        parent::init();
        $packer_settings = new \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerSettings('');
        $packaging_method = $packer_settings->get_packaging_method($this);
        $packer_factory = new \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerFactory($packaging_method);
        $packer = $packer_factory->create_packer(array());
        $this->shipping_builder = new \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\ShippingBuilder\WooCommerceShippingBuilder($packer, $packaging_method, $this->is_unit_metric());
    }
    /**
     * @return bool
     */
    protected function should_calculate_shipping()
    {
        return \true;
    }
    /**
     * Render shipping method settings.
     *
     * @throws \Exception .
     *
     * @return void
     */
    public function admin_options()
    {
        parent::admin_options();
        include __DIR__ . '/views/html-payment-account-number.php';
        if (0 === $this->instance_id) {
            $this->output_settings_script();
        }
    }
    private function output_settings_script()
    {
        include __DIR__ . '/views/settings-scrips.php';
    }
}
