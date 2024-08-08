<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\Exception;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shop\ShopSettings;
/**
 * Exception thrown when switcher is not accepted.
 *
 * @package WPDesk\DhlExpressShippingService\Exception
 */
class NoRatesInCurrencyInRatingsException extends \RuntimeException
{
    public function __construct()
    {
        $message = \__('The shop\'s currency is other than set on the DHL Express account.', 'flexible-shipping-dhl-express-pro');
        parent::__construct($message);
    }
}
