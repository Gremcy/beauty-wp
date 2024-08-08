<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\BuildDirector;

use FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Builder\AbstractBuilder;
use FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
use FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Storage\StorageFactory;
class LegacyBuildDirector
{
    /** @var AbstractBuilder */
    private $builder;
    public function __construct(\FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Builder\AbstractBuilder $builder)
    {
        $this->builder = $builder;
    }
    /**
     * Builds plugin
     */
    public function build_plugin()
    {
        $this->builder->build_plugin();
        $this->builder->init_plugin();
        $storage = new \FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Storage\StorageFactory();
        $this->builder->store_plugin($storage->create_storage());
    }
    /**
     * Returns built plugin
     *
     * @return AbstractPlugin
     */
    public function get_plugin()
    {
        return $this->builder->get_plugin();
    }
}
