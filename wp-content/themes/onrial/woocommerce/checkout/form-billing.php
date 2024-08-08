<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="delivery-step1 returns__container show woocommerce-billing-fields">
    <h1 class="primary"><?php echo get_the_title(); ?></h1>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="delivery-steps-container woocommerce-billing-fields__field-wrapper">
        <?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
            // remove some fields
            if(in_array($key, ['billing_company', 'billing_state'])){
                continue;
            }

            // change options
            $field['class'][] = 'delivery-steps-input';
            $field['placeholder'] = (isset($field['label']) ? $field['label'] : '') . ($field['required'] ? ' *' : '');
            $field['autocomplete'] = 'off';
            $field['return'] = true;

            // class
            if(in_array($key, ['billing_first_name', 'billing_last_name', 'billing_country', 'billing_address_1', 'billing_phone', 'billing_email'])){
                $field['class'][] = 'half';
            }
            if(in_array($key, ['billing_address_2', 'billing_postcode', 'billing_city'])){
                $field['class'][] = 'third';
            }
            if(in_array($key, ['billing_country'])){
                $field['class'][] = 'delivery-steps-select';
                $field['input_class'][] = 'delivery-select-css';
            }

            echo woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>