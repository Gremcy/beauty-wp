<?php
/**
 * Metric box factory.
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
 * Box factory for metric unit.
 */
class MetricBoxFactory implements BoxesWithUnit {

	/**
	 * Returns true when metric units are used in boxes.
	 *
	 * @return bool
	 */
	public function is_metric() {
		return true;
	}

	/**
	 * Get boxes array.
	 *
	 * @return Box[]
	 */
	public function get_boxes() {
		return array(
			new BoxImplementation( 33.7, 18.2, 10, 0, 1, 'DHL_BOX_2', 'Box 2' ),
			new BoxImplementation( 33.6, 32, 5.2, 0, 2, 'DHL_BOX_3', 'Box 3' ),
			new BoxImplementation( 33.7, 32.2, 18, 0, 5, 'DHL_BOX_4', 'Box 4' ),
			new BoxImplementation( 33.7, 32.2, 34.5, 0, 10, 'DHL_BOX_5', 'Box 5' ),
			new BoxImplementation( 41.7, 35.9, 36.9, 0, 15, 'DHL_BOX_6', 'Box 6' ),
			new BoxImplementation( 48.1, 40.4, 38.9, 0, 20, 'DHL_BOX_7', 'Box 7' ),
			new BoxImplementation( 54.1, 44.4, 40.9, 0, 25, 'DHL_BOX_8', 'Box 8' ),
			new BoxImplementation( 47.5, 15.5, 13.4, 0, 1, 'DHL_EXPRESS_TUBE_3', 'Tube 3' ),
			new BoxImplementation( 97.6, 17.6, 15.2, 0, 1, 'DHL_EXPRESS_TUBE_4', 'Tube 4' ),
			new BoxImplementation( 35, 27.5, 1, 0, 0.5, 'DHL_ENVELOPE_1', 'Envelope 1' ),
			new BoxImplementation( 40, 30, 1, 0, 2, 'DHL_STANDARD_FLYER', 'Standard Flyer' ),
			new BoxImplementation( 47.5, 37.5, 1, 0, 3, 'DHL_LARGE_FLYER', 'Large Flyer' ),
		);
	}

}
