<?php
/**
 * Request modifier for cutoff time.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\CutoffTime
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\CutoffTime;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Settings\BlackoutLeadDays;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi\DhlExpressRateRequestModifier;
use WPDesk\UpsProShippingService\UpsApi\UpsRateRequestModifier;

/**
 * Can modify request for cutoff time.
 */
class CutoffTimeRequestModifier implements DhlExpressRateRequestModifier {

	/**
	 * Lead time setting.
	 *
	 * @var int
	 */
	private $lead_time;

	/**
	 * Cutoff time setting.
	 *
	 * @var string
	 */
	private $cutoff_time;

	/**
	 * @var BlackoutLeadDays
	 */
	private $blackout_lead_days;

	/**
	 * DestinationAddressTypeRequestModifier constructor.
	 *
	 * @param int              $lead_time .
	 * @param string           $cutoff_time .
	 * @param BlackoutLeadDays $blackout_lead_days .
	 */
	public function __construct( $lead_time, $cutoff_time, BlackoutLeadDays $blackout_lead_days ) {
		$this->lead_time          = $lead_time;
		$this->cutoff_time        = $cutoff_time;
		$this->blackout_lead_days = $blackout_lead_days;
	}

	/**
	 * Modify rate request.
	 *
	 * @param GetQuote $request .
	 */
	public function modify_rate_request( GetQuote $request ) {
		if ( 0 === $this->lead_time ) {
			if ( ! empty( $this->cutoff_time ) ) {
				$cutoff_time = intval( $this->cutoff_time );
				$time        = (int) current_time( 'timestamp' );
				if ( intval( date( 'H', $time ) ) >= $cutoff_time ) { // phpcs:ignore
					$time = $time + DAY_IN_SECONDS;
				}

				$current_date = ( new \DateTime() )->setTimestamp( $time );
				$calculated_date = $this->blackout_lead_days->calculate_date( $current_date );

				/** @phpstan-ignore-next-line */
				$request->BkgDetails->Date = $calculated_date->format( 'Y-m-d' ); // phpcs:ignore

				/** @phpstan-ignore-next-line */
				$request->BkgDetails->ReadyTime = 'PT0H0M'; // phpcs:ignore

				/** @phpstan-ignore-next-line */
				$request->BkgDetails->ReadyTimeGMTOffset = date( 'P' ); // phpcs:ignore
			}
		}

		return $request;
	}

}
