<?php
/**
 * Imperial box factory.
 *
 * @package WPDesk\PackerBox
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\PackerBox;

use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Exception\UnitConversionException;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Dimensions;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\Shipment\Weight;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\UnitConversion\UniversalDimension;
use FlexibleShippingDhlExpressProVendor\WPDesk\AbstractShipping\UnitConversion\UniversalWeight;
use FlexibleShippingDhlExpressProVendor\WPDesk\Packer\Box;
use FlexibleShippingDhlExpressProVendor\WPDesk\Packer\Box\BoxImplementation;
use FlexibleShippingDhlExpressProVendor\WPDesk\Packer\BoxFactory\BoxesWithUnit;

/**
 * Box factory for imperial unit.
 */
class ImperialBoxFactory implements BoxesWithUnit {

	/**
	 * Returns true when metric units are used in boxes.
	 *
	 * @return bool
	 */
	public function is_metric() {
		return false;
	}

	/**
	 * Get boxes array.
	 *
	 * @return Box[]
	 */
	public function get_boxes() {
		$boxes = array();

		foreach ( ( new MetricBoxFactory() )->get_boxes() as $box ) {
			try {
				$boxes[] = new BoxImplementation(
					( new UniversalDimension( $box->get_length(), Dimensions::DIMENSION_UNIT_CM ) )->as_unit_rounded( Dimensions::DIMENSION_UNIT_IN ),
					( new UniversalDimension( $box->get_width(), Dimensions::DIMENSION_UNIT_CM ) )->as_unit_rounded( Dimensions::DIMENSION_UNIT_IN ),
					( new UniversalDimension( $box->get_height(), Dimensions::DIMENSION_UNIT_CM ) )->as_unit_rounded( Dimensions::DIMENSION_UNIT_IN ),
					( new UniversalWeight( $box->get_weight(), Weight::WEIGHT_UNIT_KG ) )->as_unit_rounded( Weight::WEIGHT_UNIT_LB ),
					( new UniversalWeight( (float) $box->get_max_weight(), Weight::WEIGHT_UNIT_KG ) )->as_unit_rounded( Weight::WEIGHT_UNIT_LB ),
					$box->get_unique_id(),
					$box->get_name(),
					$box->get_internal_data()
				);
			} catch ( UnitConversionException $e ) { // phpcs:ignore
				// well.. pity.
			}
		}

		return $boxes;
	}

}
