<?php
/**
 * Class DhlExpressProRateReplyInterpretation
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuoteResponse;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Rate\SingleRate;
use FlexibleShippingDhlExpressProVendor\WPDesk\DhlExpressShippingService\DhlApi\DhlRateReplyInterpretation;

/**
 * Can interpret API rate response.
 */
class DhlExpressProRateReplyInterpretation extends DhlRateReplyInterpretation {

	/**
	 * DhlExpressProRateReplyInterpretation constructor.
	 *
	 * @param GetQuoteResponse $reply .
	 * @param bool             $is_tax_enabled .
	 * @param string           $shop_default_currency .
	 */
	public function __construct( GetQuoteResponse $reply, $is_tax_enabled, $shop_default_currency ) {
		parent::__construct( $reply, $is_tax_enabled, $shop_default_currency );
	}

	/**
	 * @param \SimpleXMLElement $single_quote .
	 *
	 * @return SingleRate
	 */
	protected function get_single_rate( $single_quote ) {
		$single_rate = parent::get_single_rate( $single_quote );
		if ( isset( $single_quote->DeliveryDate, $single_quote->DeliveryTime, $single_quote->TotalTransitDays ) ) { // phpcs:ignore.
			$delivery_date = date_create_from_format( 'Y-m-d\P\TH\Hi\M', trim( $single_quote->DeliveryDate . $single_quote->DeliveryTime ) ); // phpcs:ignore.
			if ( false === $delivery_date ) {
				$delivery_date = date_create_from_format( 'Y-m-d\P\TH\H', trim( $single_quote->DeliveryDate . $single_quote->DeliveryTime ) ); // phpcs:ignore.
			}
			if ( false !== $delivery_date ) {
				$single_rate->delivery_date = $delivery_date;
				$single_rate->business_days_in_transit = intval( $single_quote->TotalTransitDays ); // phpcs:ignore.
			}
		}

		return $single_rate;
	}

}
