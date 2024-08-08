<?php
/**
 * Class BoxFactory
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\PackerBox
 */

namespace WPDesk\FlexibleShippingDhlExpressPro\PackerBox;

use FlexibleShippingDhlExpressProVendor\WPDesk\Packer\Box;
use FlexibleShippingDhlExpressProVendor\WPDesk\Packer\BoxFactory\Boxes;
use FlexibleShippingDhlExpressProVendor\WPDesk\Packer\BoxFactory\BoxesWithUnit;

/**
 * Box factory for universal unit.
 */
class BoxFactory implements BoxesWithUnit {
	/** @var Boxes */
	private $factory;

	/** @var bool */
	private $is_metric;

	/**
	 * Returns true when metric units are used in boxes.
	 *
	 * @return bool
	 */
	public function is_metric() {
		return $this->is_metric;
	}

	/**
	 * BoxFactory constructor.
	 *
	 * @param bool $is_metric_unit metric or imperial.
	 */
	public function __construct( $is_metric_unit ) {
		$this->is_metric = $is_metric_unit;
		if ( $this->is_metric ) {
			$this->factory = new MetricBoxFactory();
		} else {
			$this->factory = new ImperialBoxFactory();
		}
	}

	/**
	 * Get boxes array.
	 *
	 * @return Box[]
	 */
	public function get_boxes() {
		return $this->factory->get_boxes();
	}

}
