<?php

/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexibleShippingDhlExpressProVendor\Monolog\Handler;

use FlexibleShippingDhlExpressProVendor\Monolog\Formatter\NormalizerFormatter;
use FlexibleShippingDhlExpressProVendor\Monolog\Logger;
/**
 * Handler sending logs to Zend Monitor
 *
 * @author  Christian Bergau <cbergau86@gmail.com>
 * @author  Jason Davis <happydude@jasondavis.net>
 */
class ZendMonitorHandler extends \FlexibleShippingDhlExpressProVendor\Monolog\Handler\AbstractProcessingHandler
{
    /**
     * Monolog level / ZendMonitor Custom Event priority map
     *
     * @var array
     */
    protected $levelMap = array();
    /**
     * Construct
     *
     * @param  int                       $level
     * @param  bool                      $bubble
     * @throws MissingExtensionException
     */
    public function __construct($level = \FlexibleShippingDhlExpressProVendor\Monolog\Logger::DEBUG, $bubble = \true)
    {
        if (!\function_exists('FlexibleShippingDhlExpressProVendor\\zend_monitor_custom_event')) {
            throw new \FlexibleShippingDhlExpressProVendor\Monolog\Handler\MissingExtensionException('You must have Zend Server installed with Zend Monitor enabled in order to use this handler');
        }
        //zend monitor constants are not defined if zend monitor is not enabled.
        $this->levelMap = array(\FlexibleShippingDhlExpressProVendor\Monolog\Logger::DEBUG => \FlexibleShippingDhlExpressProVendor\ZEND_MONITOR_EVENT_SEVERITY_INFO, \FlexibleShippingDhlExpressProVendor\Monolog\Logger::INFO => \FlexibleShippingDhlExpressProVendor\ZEND_MONITOR_EVENT_SEVERITY_INFO, \FlexibleShippingDhlExpressProVendor\Monolog\Logger::NOTICE => \FlexibleShippingDhlExpressProVendor\ZEND_MONITOR_EVENT_SEVERITY_INFO, \FlexibleShippingDhlExpressProVendor\Monolog\Logger::WARNING => \FlexibleShippingDhlExpressProVendor\ZEND_MONITOR_EVENT_SEVERITY_WARNING, \FlexibleShippingDhlExpressProVendor\Monolog\Logger::ERROR => \FlexibleShippingDhlExpressProVendor\ZEND_MONITOR_EVENT_SEVERITY_ERROR, \FlexibleShippingDhlExpressProVendor\Monolog\Logger::CRITICAL => \FlexibleShippingDhlExpressProVendor\ZEND_MONITOR_EVENT_SEVERITY_ERROR, \FlexibleShippingDhlExpressProVendor\Monolog\Logger::ALERT => \FlexibleShippingDhlExpressProVendor\ZEND_MONITOR_EVENT_SEVERITY_ERROR, \FlexibleShippingDhlExpressProVendor\Monolog\Logger::EMERGENCY => \FlexibleShippingDhlExpressProVendor\ZEND_MONITOR_EVENT_SEVERITY_ERROR);
        parent::__construct($level, $bubble);
    }
    /**
     * {@inheritdoc}
     */
    protected function write(array $record)
    {
        $this->writeZendMonitorCustomEvent(\FlexibleShippingDhlExpressProVendor\Monolog\Logger::getLevelName($record['level']), $record['message'], $record['formatted'], $this->levelMap[$record['level']]);
    }
    /**
     * Write to Zend Monitor Events
     * @param string $type Text displayed in "Class Name (custom)" field
     * @param string $message Text displayed in "Error String"
     * @param mixed $formatted Displayed in Custom Variables tab
     * @param int $severity Set the event severity level (-1,0,1)
     */
    protected function writeZendMonitorCustomEvent($type, $message, $formatted, $severity)
    {
        zend_monitor_custom_event($type, $message, $formatted, $severity);
    }
    /**
     * {@inheritdoc}
     */
    public function getDefaultFormatter()
    {
        return new \FlexibleShippingDhlExpressProVendor\Monolog\Formatter\NormalizerFormatter();
    }
    /**
     * Get the level map
     *
     * @return array
     */
    public function getLevelMap()
    {
        return $this->levelMap;
    }
}
