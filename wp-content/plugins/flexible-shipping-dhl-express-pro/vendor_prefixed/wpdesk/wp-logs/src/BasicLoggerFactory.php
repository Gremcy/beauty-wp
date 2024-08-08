<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\Logger;

use FlexibleShippingDhlExpressProVendor\Monolog\Handler\HandlerInterface;
use FlexibleShippingDhlExpressProVendor\Monolog\Logger;
use FlexibleShippingDhlExpressProVendor\Monolog\Registry;
/**
 * Manages and facilitates creation of logger
 *
 * @package WPDesk\Logger
 */
class BasicLoggerFactory implements \FlexibleShippingDhlExpressProVendor\WPDesk\Logger\LoggerFactory
{
    /** @var string Last created logger name/channel */
    private static $lastLoggerChannel;
    /**
     * Creates logger for plugin
     *
     * @param string $name The logging channel/name of logger
     * @param HandlerInterface[] $handlers Optional stack of handlers, the first one in the array is called first, etc.
     * @param callable[] $processors Optional array of processors
     * @return Logger
     */
    public function createLogger($name, $handlers = array(), array $processors = array())
    {
        if (\FlexibleShippingDhlExpressProVendor\Monolog\Registry::hasLogger($name)) {
            return \FlexibleShippingDhlExpressProVendor\Monolog\Registry::getInstance($name);
        }
        self::$lastLoggerChannel = $name;
        $logger = new \FlexibleShippingDhlExpressProVendor\Monolog\Logger($name, $handlers, $processors);
        \FlexibleShippingDhlExpressProVendor\Monolog\Registry::addLogger($logger);
        return $logger;
    }
    /**
     * Returns created Logger by name or last created logger
     *
     * @param string $name Name of the logger
     *
     * @return Logger
     */
    public function getLogger($name = null)
    {
        if ($name === null) {
            $name = self::$lastLoggerChannel;
        }
        return \FlexibleShippingDhlExpressProVendor\Monolog\Registry::getInstance($name);
    }
}
