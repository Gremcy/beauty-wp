<script type="text/javascript">
	jQuery( function($) {
		let $select_field = jQuery('#woocommerce_flexible_shipping_dhl_express_enable_shipping_method');
		function set_fields() {
			let global = $select_field.val() === 'yes';

			let $insurance = jQuery('#woocommerce_flexible_shipping_dhl_express_insurance');
			let $dutiable_selected_countries = jQuery('#woocommerce_flexible_shipping_dhl_express_is_dutiable');
			jQuery('#woocommerce_flexible_shipping_dhl_express_method_title').closest('tr').toggle(global);
			jQuery('#woocommerce_flexible_shipping_dhl_express_fallback').closest('tr').toggle(global);
			jQuery('#woocommerce_flexible_shipping_dhl_express_fallback_cost').closest('tr').toggle(global);
			jQuery('#woocommerce_flexible_shipping_dhl_express_enable_custom_services').closest('tr').toggle(global);
			jQuery('.woocommerce_flexible_shipping_dhl_express_services').closest('tr').toggle(global);
			jQuery('#woocommerce_flexible_shipping_dhl_express_fallback').change();
			if ( global ) {
				jQuery('#woocommerce_flexible_shipping_dhl_express_enable_custom_services').change();
				jQuery('#woocommerce_flexible_shipping_dhl_express_fallback').change();
			}
			$insurance.closest('table').toggle(global);
			$insurance.closest('table').prev().toggle(global);
			$insurance.closest('table').prev().prev().toggle(global);
			$dutiable_selected_countries.closest('table').toggle(global);
			$dutiable_selected_countries.closest('table').prev().toggle(global);
			$dutiable_selected_countries.closest('table').prev().prev().toggle(global);

			let $dates = jQuery('#woocommerce_flexible_shipping_dhl_express_delivery_dates');
			$dates.closest('table').toggle(global);
			$dates.closest('table').prev().toggle(global);
			$dates.closest('table').prev().prev().toggle(global);

			let $instance_custom_origin = jQuery('#woocommerce_flexible_shipping_dhl_express_instance_custom_origin');
			$instance_custom_origin.closest('table').prev().remove();
			$instance_custom_origin.closest('table').remove();

			jQuery('#woocommerce_flexible_shipping_dhl_express_custom_origin').change();
		}

		$select_field.change(function(){
			set_fields()
		});

		set_fields();
	} );
</script>
