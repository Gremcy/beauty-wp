<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <?php do_action( 'woocommerce_before_cart_contents' ); ?>

    <div class="checkout-first-fluid">
        <div class="checkout-first-centered">
            <div class="checkout-first-left"><?php _e( 'Fill out the form and get a 5% discount', \PS::$theme_name ); ?></div>
            <div class="checkout-first-btn"><?php _e( 'Get 5% discount', \PS::$theme_name ); ?></div>
        </div>
    </div>

    <div class="checkout-cart-fluid">
        <div class="checkout-cart-rectangle-bg"></div>
        <div class="checkout-cart-centered">
            <div class="checkout-cart-left">
                <?php if ( ! WC()->cart->is_empty() ) : // check empty ?>
                    <div class="cart-popup-goods-top">
                        <div class="cart-area">
                            <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                                    $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                                    ?>
                                    <div class="cart-area-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>" data-cart_item_key="<?php echo $cart_item_key; ?>">
                                        <a href="<?php echo $product_permalink; ?>" class="cart-area-item-img">
                                            <img src="<?php $image_id = $_product->get_image_id(); echo $image_id ? wp_get_attachment_image_url( $image_id, '150x0' ) : wc_placeholder_img_src(); ?>" alt="">
                                        </a>
                                        <div class="cart-area-item-content">
                                            <div class="cart-area-item-content-top">
                                                <a href="<?php echo $product_permalink; ?>" class="cart-area-item-content-mobile-image">
                                                    <img src="<?php $image_id = $_product->get_image_id(); echo $image_id ? wp_get_attachment_image_url( $image_id, '150x0' ) : wc_placeholder_img_src(); ?>" alt="">
                                                </a>
                                                <div class="cart-area-item-content-name">
                                                    <?php
                                                    if ( ! $product_permalink ) {
                                                        echo __(wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' ));
                                                    } else {
                                                        echo __(wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) ));
                                                    }
                                                    ?>
                                                </div>
                                                <?php
                                                echo apply_filters(
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="cart-area-item-content-delete remove" aria-label="%s" data-product_id="%s" data-product_sku="%s" data-cart_item_key="' . $cart_item_key . '"><img src="' . \PS::$assets_url . 'images/close2.svg" alt=""></a>',
                                                        esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                                                        esc_html__( 'Remove this item', 'woocommerce' ),
                                                        esc_attr( $product_id ),
                                                        esc_attr( $_product->get_sku() )
                                                    ),
                                                    $cart_item_key
                                                );
                                                ?>
                                            </div>
                                            <div class="cart-area-item-content-bottom">
                                                <?php
                                                if ( $_product->is_sold_individually() ) {
                                                    $min_quantity = 1;
                                                    $max_quantity = 1;
                                                } else {
                                                    $min_quantity = 0;
                                                    $max_quantity = $_product->get_max_purchase_quantity();
                                                }

                                                $product_quantity = woocommerce_quantity_input(
                                                    array(
                                                        'input_name'   => "cart[{$cart_item_key}][qty]",
                                                        'input_value'  => $cart_item['quantity'],
                                                        'max_value'    => $max_quantity,
                                                        'min_value'    => $min_quantity,
                                                        'product_name' => $_product->get_name(),
                                                    ),
                                                    $_product,
                                                    false
                                                );

                                                echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                                ?>
                                                <div class="cart-area-item-content-price">
                                                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="cart-popup-empty-message"><?php _e( 'Your cart is empty.', \PS::$theme_name ); ?></div>
                <?php endif; ?>
            </div>

            <div class="checkout-cart-right">
                <?php /*
                <div class="checkout-cart-right-title"><?php _e( 'Have a coupon?', \PS::$theme_name ); ?></div>
                <div class="checkout-cart-right-input">
                    <input type="text" placeholder="<?php _e( 'Coupon code', \PS::$theme_name ); ?>">
                </div>
                <div class="checkout-cart-right-btn"><?php _e( 'Use', \PS::$theme_name ); ?></div>
                */ ?>

                <div class="checkout-cart-right-delivery">
                    <div class="checkout-cart-right-delivery-item">
                        <div class="checkout-cart-right-delivery-item-title"><?php _e( 'Payment', \PS::$theme_name ); ?></div>
                        <div class="checkout-cart-right-delivery-item-icons">
                            <div class="checkout-cart-right-delivery-icons-el">
                                <img src="<?php echo \PS::$assets_url; ?>images/icon1.png" alt="">
                            </div>
                            <div class="checkout-cart-right-delivery-icons-el">
                                <img src="<?php echo \PS::$assets_url; ?>images/icon2.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="checkout-cart-right-delivery-item">
                        <div class="checkout-cart-right-delivery-item-title"><?php _e( 'Delivery', \PS::$theme_name ); ?></div>
                        <div class="checkout-cart-right-delivery-item-icons">
                            <div class="checkout-cart-right-delivery-icons-el">
                                <img src="<?php echo \PS::$assets_url; ?>images/icon3.png" alt="">
                            </div>
                            <div class="checkout-cart-right-delivery-icons-el">
                                <img src="<?php echo \PS::$assets_url; ?>images/icon4.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="checkout-footer-fluid">
        <div class="checkout-footer-centered">
            <div class="checkout-footer-top">
                <div class="checkout-footer-top-item">
                    <div class="checkout-footer-top-item-name"><?php _e( 'Items', \PS::$theme_name ); ?>:</div>
                    <div class="checkout-footer-top-item-price ajax-quantity"><?php echo WC()->cart->get_cart_contents_count(); ?></div>
                </div>

                <div class="checkout-footer-top-item">
                    <div class="checkout-footer-top-item-name"><?php _e( 'Subtotal', \PS::$theme_name ); ?>:</div>
                    <div class="checkout-footer-top-item-price ajax-total"><?php wc_cart_totals_subtotal_html(); ?></div>
                </div>

                <?php /*
                <div class="checkout-footer-top-item">
                    <div class="checkout-footer-top-item-name">
                        subtotal with promocode:
                    </div>
                    <div class="checkout-footer-top-item-price">
                        $ 85
                    </div>
                </div>
                */ ?>
            </div>
            <div class="checkout-footer-bottom">
                <div class="checkout-footer-bottom-item">
                    <div class="checkout-footer-bottom-item-name"><?php _e( 'Total', \PS::$theme_name ); ?>:</div>
                    <div class="checkout-footer-bottom-item-price ajax-total"><?php wc_cart_totals_subtotal_html(); ?></div>
                </div>
            </div>
            <?php if ( ! WC()->cart->is_empty() ) : // check empty ?>
                <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="checkout-footer-make-order-btn">
                    <?php _e( 'Make an order', \PS::$theme_name ); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_after_cart' ); ?>