<?php
/**
 * Units change script.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\ShippingMethod
 */

?><script type="text/javascript">
	jQuery(document).ready(function(){
		let $units_field = jQuery('#woocommerce_flexible_shipping_dhl_express_units');
		$units_field.change(function(){
			let $units_alert = jQuery('#woocommerce_flexible_shipping_dhl_express_units_alert');
			if ( $units_alert.length ) {
				$units_alert.remove();
			}
			$units_field.after('<p class="description" style="color:red;" id="woocommerce_flexible_shipping_dhl_express_units_alert"><?php echo esc_html( __( 'Save the measurement units\' changes made here using the button below to apply them to the Shipping boxes (if used).', 'flexible-shipping-dhl-express-pro' ) ); ?></p>');
		});
	});
</script>
