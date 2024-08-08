<?php

namespace FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi;

use FlexibleShippingDhlExpressProVendor\DHL\Client\Web;
use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote;
use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuoteResponse;
use Psr\Log\LoggerInterface;
/**
 * Send request to DHL Express API
 *
 * @package WPDesk\DhlExpressShippingService\DhlApi
 */
class DhlSender implements \FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\Sender
{
    /**
     * Logger
     *
     * @var LoggerInterface
     */
    private $logger;
    /**
     * Is testing?
     *
     * @var bool
     */
    private $is_testing;
    /**
     * DhlSender constructor.
     *
     * @param LoggerInterface $logger Logger.
     * @param bool $is_testing Is testing?.
     */
    public function __construct(\Psr\Log\LoggerInterface $logger, $is_testing = \true)
    {
        $this->logger = $logger;
        $this->is_testing = $is_testing;
    }
    /**
     * Send request.
     *
     * @param GetQuote $request DHL request.
     *
     * @return GetQuoteResponse
     *
     * @throws \Exception
     */
    public function send(\FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote $request)
    {
        $this->logger->info('API request', array('content' => $request->toXML()));
        $mode = 'production';
        if ($this->is_testing) {
            $mode = 'staging';
        }
        $client = new \FlexibleShippingDhlExpressProVendor\DHL\Client\Web($mode);
        $xml_response = $client->call($request);
        $this->logger->info('API response', array('content' => $xml_response));
        $response = new \FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuoteResponse();
        $response->initFromXML($xml_response);
        return $response;
    }
}
