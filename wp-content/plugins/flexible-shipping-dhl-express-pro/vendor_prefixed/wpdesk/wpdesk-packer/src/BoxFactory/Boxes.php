<?php

/**
 * Boxes interface.
 *
 * @package WPDesk\Packer\BoxFactory
 */
namespace FlexibleShippingDhlExpressProVendor\WPDesk\Packer\BoxFactory;

use FlexibleShippingDhlExpressProVendor\WPDesk\Packer\Box;
/**
 * Boxes as array.
 */
interface Boxes
{
    /**
     * Get boxes array.
     *
     * @return Box[]
     */
    public function get_boxes();
}
