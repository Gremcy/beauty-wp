<?php

declare (strict_types=1);
/*
 * This file is part of the Monolog package.
 *
 * (c) Jordi Boggiano <j.boggiano@seld.be>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace FlexibleShippingDhlExpressProVendor\Monolog\Handler;

use FlexibleShippingDhlExpressProVendor\Monolog\Formatter\FormatterInterface;
use FlexibleShippingDhlExpressProVendor\Monolog\Formatter\LineFormatter;
/**
 * Helper trait for implementing FormattableInterface
 *
 * This trait is present in monolog 1.x to ease forward compatibility.
 *
 * @author Jordi Boggiano <j.boggiano@seld.be>
 */
trait FormattableHandlerTrait
{
    /**
     * @var FormatterInterface
     */
    protected $formatter;
    /**
     * {@inheritdoc}
     * @suppress PhanTypeMismatchReturn
     */
    public function setFormatter(\FlexibleShippingDhlExpressProVendor\Monolog\Formatter\FormatterInterface $formatter) : \FlexibleShippingDhlExpressProVendor\Monolog\Handler\HandlerInterface
    {
        $this->formatter = $formatter;
        return $this;
    }
    /**
     * {@inheritdoc}
     */
    public function getFormatter() : \FlexibleShippingDhlExpressProVendor\Monolog\Formatter\FormatterInterface
    {
        if (!$this->formatter) {
            $this->formatter = $this->getDefaultFormatter();
        }
        return $this->formatter;
    }
    /**
     * Gets the default formatter.
     *
     * Overwrite this if the LineFormatter is not a good default for your handler.
     */
    protected function getDefaultFormatter() : \FlexibleShippingDhlExpressProVendor\Monolog\Formatter\FormatterInterface
    {
        return new \FlexibleShippingDhlExpressProVendor\Monolog\Formatter\LineFormatter();
    }
}
