<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\CustomFields;

use FlexibleShippingDhlExpressProVendor\WPDesk\Packer\BoxFactory\BoxesWithUnit;
use FlexibleShippingDhlExpressProVendor\WpDesk\WooCommerce\ShippingMethod\Assets;
use FlexibleShippingDhlExpressProVendor\WpDesk\WooCommerce\ShippingMethod\Labels;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\CustomField;
use FlexibleShippingDhlExpressProVendor\WpDesk\WooCommerce\ShippingMethod\SettingsField;
use FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerSettings;
/**
 * Custom field
 *
 * @package WPDesk\WooCommerceShippingPro\CustomFields
 */
class ShippingBoxes implements \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShipping\CustomFields\CustomField
{
    // TODO: not sure what is that field.
    const OPTION_PACKAGING_BOXES = 'packaging_boxes';
    /** @var \WC_Shipping_Method */
    private $method;
    /** @var BoxesWithUnit */
    private $boxes;
    public function __construct(\WC_Shipping_Method $method, \FlexibleShippingDhlExpressProVendor\WPDesk\Packer\BoxFactory\BoxesWithUnit $boxes)
    {
        $this->method = $method;
        $this->boxes = $boxes;
    }
    /**
     * Unique field name.
     *
     * @return string .
     */
    public static function get_type_name()
    {
        return 'shipping_boxes';
    }
    /**
     * Must be applied in admin_enqueue_scripts so the js would work.
     *
     * @param string $plugin_assets_url
     */
    public static function enqueue_scripts($plugin_assets_url)
    {
        $current_screen = \get_current_screen();
        if ($current_screen instanceof \WP_Screen && 'woocommerce_page_wc-settings' === $current_screen->id) {
            $suffix = \defined('SCRIPT_DEBUG') && \SCRIPT_DEBUG ? '' : '.min';
            $shipping_boxes_assets = new \FlexibleShippingDhlExpressProVendor\WpDesk\WooCommerce\ShippingMethod\Assets();
            $shipping_boxes_assets->enqueue($plugin_assets_url . '/../../vendor_prefixed/wpdesk/wp-settings-field-boxes', $suffix, 6);
        }
    }
    /**
     * Can sanitize data so it can be saved into DB.
     *
     * @param mixed $data
     *
     * @return mixed
     */
    public function sanitize(array $data = null)
    {
        $shipping_boxes_field = new \FlexibleShippingDhlExpressProVendor\WpDesk\WooCommerce\ShippingMethod\SettingsField('whatever');
        return $shipping_boxes_field->get_field_posted_value_as_json($data);
    }
    /**
     * Render view.
     *
     * @param array|null $params Params.
     * @param \WC_Shipping_Method|null $shipping_method Shipping method.
     *
     * @return mixed
     */
    public function render(array $params = null, $shipping_method = null)
    {
        if ($this->boxes->is_metric()) {
            $weight_unit = '[kg]';
            $dimensions_unit = '[cm]';
        } else {
            $weight_unit = '[lbs]';
            $dimensions_unit = '[in]';
        }
        $labels = new \FlexibleShippingDhlExpressProVendor\WpDesk\WooCommerce\ShippingMethod\Labels();
        $labels->set_labels(
            \__('Type', 'flexible-shipping-dhl-express-pro'),
            // Translators: units.
            \sprintf(\__('Length %1$s', 'flexible-shipping-dhl-express-pro'), $dimensions_unit),
            // Translators: units.
            \sprintf(\__('Width %1$s', 'flexible-shipping-dhl-express-pro'), $dimensions_unit),
            // Translators: units.
            \sprintf(\__('Height %1$s', 'flexible-shipping-dhl-express-pro'), $dimensions_unit),
            // Translators: units.
            \sprintf(\__('Max Weight %1$s', 'flexible-shipping-dhl-express-pro'), $weight_unit),
            // Translators: units.
            \sprintf(\__('Padding %1$s', 'flexible-shipping-dhl-express-pro'), $dimensions_unit),
            // Translators: units.
            \sprintf(\__('Box Weight %1$s', 'flexible-shipping-dhl-express-pro'), $weight_unit),
            \__('Delete', 'flexible-shipping-dhl-express-pro'),
            \__('Add', 'flexible-shipping-dhl-express-pro')
        );
        $shipping_boxes_field = new \FlexibleShippingDhlExpressProVendor\WpDesk\WooCommerce\ShippingMethod\SettingsField($params['field_key']);
        \ob_start();
        $shipping_boxes_field->render($params['title'], $this->method->get_tooltip_html($params), $params['value'], $this->boxes->get_boxes(), $labels, !empty($params['description']) ? $params['description'] : '');
        return \ob_get_clean();
    }
    public function render_footer($key)
    {
        \ob_start();
        $prefix = "woocommerce_{$this->method->id}_";
        $packaging_method_field = $prefix . \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerSettings::OPTION_PACKAGING_METHOD;
        $packaging_boxes_field = $prefix . self::OPTION_PACKAGING_BOXES;
        $shipping_boxes_field = $prefix . \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerSettings::OPTION_SHIPPING_BOXES;
        $packaging_method_box = \FlexibleShippingDhlExpressProVendor\WPDesk\WooCommerceShippingPro\Packer\PackerSettings::PACKING_METHOD_BOX;
        include __DIR__ . '/views/settings-script.php';
        return \ob_get_clean();
    }
}
