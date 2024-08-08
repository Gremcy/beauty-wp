<?php
/**
 * Delivery dates script.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro\ShippingMethod;
 */

use UpsProVendor\WPDesk\UpsProShippingService\CollectionPointFlatRate\CollectionPointFlatRateSettingsDefinitionDecorator;

?><script type="text/javascript">
	jQuery( document ).ready( function () {

		let $delivery_dates_field = jQuery( '#woocommerce_flexible_shipping_dhl_express_delivery_dates' );

		function update_lead_max_cutoff_fields_visibility() {
			let delivery_dates_val = $delivery_dates_field.val();
			let lead_time_tr = jQuery( '#woocommerce_flexible_shipping_dhl_express_lead_time' ).closest( 'tr' );
			let maximum_transit_time_tr = jQuery( '#woocommerce_flexible_shipping_dhl_express_maximum_transit_time' ).closest( 'tr' );
			let cutoff_time_tr = jQuery('#woocommerce_flexible_shipping_dhl_express_cutoff_time' ).closest( 'tr' );
			let blackout_lead_days = jQuery('#woocommerce_flexible_shipping_dhl_express_blackout_lead_days' ).closest( 'tr' );

			if ( delivery_dates_val === 'none' ) {
				lead_time_tr.hide();
				maximum_transit_time_tr.hide();
				cutoff_time_tr.hide();
				blackout_lead_days.hide();
			} else {
				lead_time_tr.show();
				maximum_transit_time_tr.show();
				cutoff_time_tr.show();
				blackout_lead_days.show();
			}
		}

		$delivery_dates_field.change(function() {
			update_lead_max_cutoff_fields_visibility();
		});

		update_lead_max_cutoff_fields_visibility();

	});
</script>
