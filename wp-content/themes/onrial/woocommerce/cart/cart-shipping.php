<?php
defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
?>

<div class="delivery-chose-method woocommerce-shipping-totals">
    <div class="delivery-chose-method-title"><?php echo wp_kses_post( $package_name ); ?></div>
    <?php if ( $available_methods ) : ?>
        <ul id="shipping_method" class="delivery-chose-method-container woocommerce-shipping-methods">
            <?php foreach ( $available_methods as $m => $method ) : ?>
                <?php if(!$chosen_method){ $chosen_method = $method->id; } ?>

                <li class="delivery-chose-method-item">
                    <?php
                    if ( 1 < count( $available_methods ) ) {
                        printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="delivery-steps-checkbox shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
                    } else {
                        printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="delivery-steps-checkbox shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
                    }
                    ?>

                    <label class="delivery-steps-methods-item delivery-steps-checkbox-label" for="shipping_method_<?php echo $index; ?>_<?php echo esc_attr( sanitize_title( $method->id ) ); ?>">
                        <div class="delivery-chose-method-item-inner">
                            <?php if($method->method_id === 'flexible_shipping_dhl_express'): ?>
                                <div class="delivery-chose-method-item-left">
                                    <div class="delivery-chose-method-item-left-icon">
                                        <img src="<?php echo \PS::$assets_url; ?>images/dhl.svg" alt="">
                                    </div>
                                    <div class="delivery-chose-method-item-left-name"><?php echo str_ireplace('<span class="woocommerce-Price-amount amount"', '</div></div><div class="delivery-chose-method-item-price"><span class="woocommerce-Price-amount amount"', str_ireplace(':', '', wc_cart_totals_shipping_method_label( $method ))); ?>
                                </div>
                            <?php elseif($method->id === 'flat_rate:3'): ?>
                                <div class="delivery-chose-method-item-left">
                                    <div class="delivery-chose-method-item-left-icon">
                                        <img src="<?php echo \PS::$assets_url; ?>images/inpost.png" alt="">
                                    </div>
                                    <div class="delivery-chose-method-item-left-name"><?php echo str_ireplace('<span class="woocommerce-Price-amount amount"', '</div></div><div class="delivery-chose-method-item-price"><span class="woocommerce-Price-amount amount"', str_ireplace(':', '', wc_cart_totals_shipping_method_label( $method ))); ?>
                                </div>
                            <?php elseif($method->method_id === 'local_pickup'): ?>
                                <div class="delivery-chose-method-item-inner">
                                    <div class="delivery-chose-method-item-left">
                                        <div class="delivery-chose-method-item-left-name"><?php echo wc_cart_totals_shipping_method_label( $method ); ?></div>
                                        <div class="delivery-chose-method-item-left-text"><?php echo get_option('woocommerce_store_city'); ?><br><?php echo get_option('woocommerce_store_address'); ?></div>
                                    </div>
                                    <div class="delivery-chose-method-item-price"><?php _e( 'FREE', \PS::$theme_name ); ?></div>
                                </div>
                            <?php else: ?>
                                <div class="delivery-chose-method-item-inner">
                                    <div class="delivery-chose-method-item-left">
                                        <div class="delivery-chose-method-item-left-name"><?php echo str_ireplace('<span class="woocommerce-Price-amount amount"', '</div></div><div class="delivery-chose-method-item-price"><span class="woocommerce-Price-amount amount"', str_ireplace(':', '', wc_cart_totals_shipping_method_label( $method ))); ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </label>

                    <?php do_action( 'woocommerce_after_shipping_rate', $method, $index ); ?>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php elseif ( ! $has_calculated_shipping || ! $formatted_destination ) : ?>
        <div class="shipping-notice"><?php echo wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'woocommerce' ) ) );  ?></div>
    <?php elseif ( ! is_cart() ) : ?>
        <div class="shipping-notice"><?php echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) ); ?></div>
    <?php else:  ?>
        <div class="shipping-notice">
            <?php echo wp_kses_post(
            /**
             * Provides a means of overriding the default 'no shipping available' HTML string.
             *
             * @since 3.0.0
             *
             * @param string $html                  HTML message.
             * @param string $formatted_destination The formatted shipping destination.
             */
                apply_filters(
                    'woocommerce_cart_no_shipping_available_html',
                    // Translators: $s shipping destination.
                    sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ),
                    $formatted_destination
                )
            );
            $calculator_text = esc_html__( 'Enter a different address', 'woocommerce' ); ?>
        </div>
    <?php endif; ?>
</div>