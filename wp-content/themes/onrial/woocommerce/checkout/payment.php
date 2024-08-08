<?php
defined( 'ABSPATH' ) || exit;

if ( ! wp_doing_ajax() ) {
	do_action( 'woocommerce_review_order_before_payment' );
}
?>
<div id="payment" class="woocommerce-checkout-payment delivery-chose-method<?php if(count($available_gateways) > 2): ?> payment<?php endif; ?>">
    <div class="delivery-chose-method-title"><?php _e( 'Payment', \PS::$theme_name ); ?></div>

	<?php if ( WC()->cart->needs_payment() ) : ?>
		<ul class="delivery-chose-method-container wc_payment_methods payment_methods methods">
			<?php
            if ( ! empty( $available_gateways ) ) {
				foreach ( $available_gateways as $gateway ) {
					wc_get_template( 'checkout/payment-method.php', array( 'gateway' => $gateway ) );
				}
			} else {
				echo '<li class="shipping-notice">' . apply_filters( 'woocommerce_no_available_payment_methods_message', WC()->customer->get_billing_country() ? esc_html__( 'Sorry, it seems that there are no available payment methods for your state. Please contact us if you require assistance or wish to make alternate arrangements.', 'woocommerce' ) : esc_html__( 'Please fill in your details above to see available payment methods.', 'woocommerce' ) ) . '</li>'; // @codingStandardsIgnoreLine
			}
			?>
		</ul>
	<?php endif; ?>

    <div class="delivery-steps-methods woocommerce-shipping-totals">
        <div class="delivery-steps-methods-title"><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
        <div class="delivery-list">
            <div class="delivery-list-item">
                <div class="delivery-list-item-title"><?php _e( 'Items', \PS::$theme_name ); ?>:</div>
                <div class="delivery-list-item-right"><?php wc_cart_totals_subtotal_html(); ?></div>
            </div>
            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                <div class="delivery-list-item cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                    <div class="delivery-list-item-title"><?php wc_cart_totals_coupon_label( $coupon ); ?></div>
                    <div class="delivery-list-item-right"><?php wc_cart_totals_coupon_html( $coupon ); ?></div>
                </div>
            <?php endforeach; ?>
            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                <div class="delivery-list-item fee">
                    <div class="delivery-list-item-title"><?php echo esc_html( $fee->name ); ?></div>
                    <div class="delivery-list-item-right"><?php wc_cart_totals_fee_html( $fee ); ?></div>
                </div>
            <?php endforeach; ?>
            <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                    <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
                        <div class="delivery-list-item tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                            <div class="delivery-list-item-title"><?php echo esc_html( $tax->label ); ?></div>
                            <div class="delivery-list-item-right"><?php echo wp_kses_post( $tax->formatted_amount ); ?></div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="delivery-list-item tax-total">
                        <div class="delivery-list-item-title"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></div>
                        <div class="delivery-list-item-right"><?php wc_cart_totals_taxes_total_html(); ?></div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="delivery-list-item">
                <div class="delivery-list-item-title"><?php _e( 'Shipping', \PS::$theme_name ); ?>:</div>
                <div class="delivery-list-item-right"><?php echo WC()->cart->get_cart_shipping_total(); ?></div>
            </div>
            <div class="delivery-list-item">
                <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>
                <div class="delivery-list-item-title"><?php esc_html_e( 'Total', 'woocommerce' ); ?>:</div>
                <div class="delivery-list-item-right"><?php wc_cart_totals_order_total_html(); ?></div>
                <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
            </div>
        </div>
    </div>

	<div class="form-row place-order">
		<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

        <div class="delivery-steps1-down">
            <div class="delivery-steps-down-back"></div>
            <?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="delivery-steps1-down-save-next-btn alt' . esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ) . '" name="woocommerce_checkout_place_order" id="place_order" value="' . esc_attr( $order_button_text ) . '" data-value="' . esc_attr( $order_button_text ) . '">' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>
        </div>

		<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

		<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
	</div>
</div>

<?php
if ( ! wp_doing_ajax() ) {
	do_action( 'woocommerce_review_order_after_payment' );
}
