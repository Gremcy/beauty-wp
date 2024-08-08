<?php
/**
 * Request modifier for packing.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\PackingMethod
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\PackingMethod;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote;
use WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi\DhlExpressRateRequestModifier;
use WPDesk\UpsProShippingService\UpsApi\UpsRateRequestModifier;

/**
 * Can modify request for lead time.
 */
class PackingMethodRequestModifier implements DhlExpressRateRequestModifier {
	const BOX = 'BOX';

	/**
	 * @var array
	 * @phpstan-ignore-next-line
	 */
	private $shipping_boxes;

	/**
	 * PackingMethodRequestModifier constructor.
	 *
	 * @param array[] $shipping_boxes .
	 * @phpstan-ignore-next-line
	 */
	public function __construct( array $shipping_boxes ) {
		$this->shipping_boxes = $shipping_boxes;
	}

	/**
	 * Modify rate request.
	 *
	 * @param GetQuote $request .
	 */
	public function modify_rate_request( GetQuote $request ) {
		if ( property_exists( $request, 'BkgDetails' ) && property_exists( $request->BkgDetails, 'Pieces' ) ) { // phpcs:ignore
			$pieces = $request->BkgDetails->Pieces; // phpcs:ignore
			foreach ( $pieces as $piece ) {
				$piece->PackageTypeCode = // phpcs:ignore
					/**
					 * Package type code. Default: 'BOX'.
					 *
					 * @param string $package_type_code Package type code.
					 * @param float  $package_width     Package width.
					 * @param float  $package_depth     Package depth.
					 * @param float  $package_height    Package height.
					 * @param float  $package_weight    Package weight.
					 *
					 * @return string Returns package type code.
					 *
					 * @since 1.0.0
					 */
					apply_filters( 'flexible-shipping-dhl/request/package-type-code', self::BOX, $piece->Width, $piece->Depth, $piece->Height, $piece->Weight ); // phpcs:ignore.
			}
		}

		return $request;
	}

}
