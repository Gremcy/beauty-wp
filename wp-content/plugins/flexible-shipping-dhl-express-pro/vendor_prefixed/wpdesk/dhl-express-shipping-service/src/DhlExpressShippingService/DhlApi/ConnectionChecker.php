<?php

/**
 * Connection checker.
 *
 * @package WPDesk\DhlShippingService\DhlApi
 */
namespace FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi;

use FlexibleShippingDhlExpressProVendor\DHL\Client\Web;
use FlexibleShippingDhlExpressProVendor\DHL\Datatype\AM\PieceType;
use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote;
use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuoteResponse;
use Psr\Log\LoggerInterface;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition;
/**
 * Can check connection.
 */
class ConnectionChecker
{
    /**
     * Settings.
     *
     * @var SettingsValues
     */
    private $settings;
    /**
     * Logger.
     *
     * @var LoggerInterface
     */
    private $logger;
    /** @var bool */
    private $is_testing;
    /**
     * ConnectionChecker constructor.
     *
     * @param SettingsValues  $settings .
     * @param LoggerInterface $logger .
     * @param bool $is_testing .
     */
    public function __construct(\FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\SettingsValues $settings, \Psr\Log\LoggerInterface $logger, $is_testing)
    {
        $this->settings = $settings;
        $this->logger = $logger;
        $this->is_testing = $is_testing;
    }
    /**
     * @param string $site_id .
     * @param string $password .
     *
     * @return GetQuote
     * @throws \Exception
     */
    private function create_quote($site_id, $password)
    {
        $sample = new \FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote();
        $sample->SiteID = $site_id;
        $sample->Password = $password;
        $sample->MessageTime = '2001-12-17T09:30:47-05:00';
        $sample->MessageReference = 'reference_28_to_32_chars_1234567';
        $sample->BkgDetails->Date = \date('Y-m-d');
        $sample->BkgDetails->PaymentCountryCode = 'GB';
        $sample->BkgDetails->DimensionUnit = 'CM';
        $sample->BkgDetails->WeightUnit = 'KG';
        $sample->BkgDetails->ReadyTime = 'PT10H21M';
        $sample->BkgDetails->ReadyTimeGMTOffset = '+01:00';
        $piece = new \FlexibleShippingDhlExpressProVendor\DHL\Datatype\AM\PieceType();
        $piece->PieceID = 1;
        $piece->Height = 10;
        $piece->Depth = 10;
        $piece->Width = 10;
        $piece->Weight = 10;
        $sample->BkgDetails->addPiece($piece);
        $sample->From->CountryCode = 'GB';
        $sample->From->Postalcode = 'DD13JA';
        $sample->To->City = 'Herndon';
        $sample->To->Postalcode = '20171';
        $sample->To->CountryCode = 'US';
        $sample->BkgDetails->IsDutiable = 'N';
        return $sample;
    }
    /**
     * Pings API.
     * Throws exception on failure.
     *
     * @return void
     * @throws \Exception .
     */
    public function check_connection()
    {
        $mode = 'production';
        if ($this->settings->get_value(\FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition::FIELD_TESTING) === 'yes') {
            $mode = 'staging';
        }
        $client = new \FlexibleShippingDhlExpressProVendor\DHL\Client\Web($mode);
        $xml_response = $client->call($this->create_quote($this->settings->get_value(\FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition::FIELD_SITE_ID), $this->settings->get_value(\FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlSettingsDefinition::FIELD_API_PASSWORD)));
        $response = new \FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuoteResponse();
        $response->initFromXML($xml_response);
    }
}
