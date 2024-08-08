<?php
/**
 * Rate request modifier.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\DhlExpressProShippingService\DhlApi;

use FlexibleShippingDhlExpressProVendor\DHL\Entity\AM\GetQuote;

/**
 * Interface for rate modifiers.
 */
interface DhlExpressRateRequestModifier {

	/**
	 * Modify rate request.
	 *
	 * @param GetQuote $request .
	 *
	 * @return GetQuote
	 */
	public function modify_rate_request( GetQuote $request );

}
