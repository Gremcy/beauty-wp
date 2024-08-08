<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Storage;

class StorageFactory
{
    /**
     * @return PluginStorage
     */
    public function create_storage()
    {
        return new \FlexibleShippingDhlExpressProVendor\WPDesk\PluginBuilder\Storage\WordpressFilterStorage();
    }
}
