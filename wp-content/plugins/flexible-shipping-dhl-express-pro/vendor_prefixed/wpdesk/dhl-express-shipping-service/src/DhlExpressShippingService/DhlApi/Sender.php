<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote;
use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuoteResponse;
/**
 * Sender class interface.
 *
 * @package WPDesk\DhlExpressShippingService\DhlApi
 */
interface Sender
{
    /**
     * Send request.
     *
     * @param GetQuote $request Request.
     *
     * @return GetQuoteResponse
     */
    public function send(\FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote $request);
}
