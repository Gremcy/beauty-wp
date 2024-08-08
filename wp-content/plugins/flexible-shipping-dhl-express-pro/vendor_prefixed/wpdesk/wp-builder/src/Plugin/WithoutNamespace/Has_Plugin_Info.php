<?php

namespace FlexibleShippingDhlExpressProVendor;

if (!\interface_exists('FlexibleShippingDhlExpressProVendor\\WPDesk_Translatable')) {
    require_once __DIR__ . '/Translatable.php';
}
/**
 * Have MUST HAVE info for plugin instantion
 *
 * have to be compatible with PHP 5.2.x
 */
interface WPDesk_Has_Plugin_Info extends \FlexibleShippingDhlExpressProVendor\WPDesk_Translatable
{
    /**
     * @return string
     */
    public function get_plugin_file_name();
    /**
     * @return string
     */
    public function get_plugin_dir();
    /**
     * @return string
     */
    public function get_version();
}
