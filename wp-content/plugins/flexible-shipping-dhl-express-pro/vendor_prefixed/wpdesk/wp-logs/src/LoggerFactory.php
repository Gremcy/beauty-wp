<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\Logger;

use FlexibleShippingDhlExpressProVendor\Monolog\Logger;
/*
 * @package WPDesk\Logger
 */
interface LoggerFactory
{
    /**
     * Returns created Logger
     *
     * @param string $name
     *
     * @return Logger
     */
    public function getLogger($name);
}
