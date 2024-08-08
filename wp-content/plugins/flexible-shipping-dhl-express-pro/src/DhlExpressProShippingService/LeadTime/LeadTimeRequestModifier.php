<?php
/**
 * Request modifier for lead time.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\LeadTime
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\LeadTime;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\BlackoutLeadDays;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi\DhlExpressRateRequestModifier;
use WPDesk\UpsProShippingService\UpsApi\UpsRateRequestModifier;

/**
 * Can modify request for lead time.
 */
class LeadTimeRequestModifier implements DhlExpressRateRequestModifier {

	/**
	 * @var BlackoutLeadDays
	 */
	private $blackout_lead_days;

	/**
	 * DestinationAddressTypeRequestModifier constructor.
	 *
	 * @param BlackoutLeadDays $blackout_lead_days .
	 */
	public function __construct( $blackout_lead_days ) {
		$this->blackout_lead_days = $blackout_lead_days;
	}

	/**
	 * Modify rate request.
	 *
	 * @param GetQuote $request .
	 */
	public function modify_rate_request( GetQuote $request ) {
		$current_date    = ( new \DateTime() )->setTimestamp( (int) current_time( 'timestamp' ) );
		$calculated_date = $this->blackout_lead_days->calculate_date( $current_date );

		/** @phpstan-ignore-next-line */
		$request->BkgDetails->Date = $calculated_date->format( 'Y-m-d' ); // phpcs:ignore.

		/** @phpstan-ignore-next-line */
		$request->BkgDetails->ReadyTime = 'PT0H0M'; // phpcs:ignore.

		/** @phpstan-ignore-next-line */
		$request->BkgDetails->ReadyTimeGMTOffset = date( 'P' ); // phpcs:ignore.

		return $request;
	}

}
