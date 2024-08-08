<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\View\Resolver;

use FlexibleShippingDhlExpressProVendor\WPDesk\View\Renderer\Renderer;
use FlexibleShippingDhlExpressProVendor\WPDesk\View\Resolver\Exception\CanNotResolve;
/**
 * This resolver never finds the file
 *
 * @package WPDesk\View\Resolver
 */
class NullResolver implements \FlexibleShippingDhlExpressProVendor\WPDesk\View\Resolver\Resolver
{
    public function resolve($name, \FlexibleShippingDhlExpressProVendor\WPDesk\View\Renderer\Renderer $renderer = null)
    {
        throw new \FlexibleShippingDhlExpressProVendor\WPDesk\View\Resolver\Exception\CanNotResolve("Null Cannot resolve");
    }
}
