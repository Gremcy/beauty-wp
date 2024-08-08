<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Plugin;

interface HookablePluginDependant extends \FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Plugin\Hookable
{
    /**
     * Set Plugin.
     *
     * @param AbstractPlugin $plugin Plugin.
     *
     * @return null
     */
    public function set_plugin(\FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin $plugin);
    /**
     * Get plugin.
     *
     * @return AbstractPlugin.
     */
    public function get_plugin();
}
