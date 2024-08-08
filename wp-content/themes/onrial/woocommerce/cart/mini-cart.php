<?php
defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
    <?php

    global $woocommerce;
    $items_send = [];
    $items = $woocommerce->cart->get_cart();
    foreach ($items as $item => $values) {
        $_product = wc_get_product($values['data']->get_id());
        $item_var = [];
        if (!empty($values['variation'])) {
            foreach ($values['variation'] as $variation) {
                $item_var[] = $variation;
            }
        }
        $terms = [];
        $term = get_the_terms($values['product_id'], 'product_cat');
        $term = $term[0];
        $terms[] = $term;
        $tmas = [];
        $tmas['item_category'] = $term->name;
        $ik = 1;
        while ($term->parent != 0) {
            $term = get_terms([
                'taxonomy' => 'product_cat',
                'include' => $term->parent
            ]);
            $term = $term[0];
            $terms[] = $term;
            $tmas['item_category' . $ik] = $term->name;
            $ik++;
        }
        $terms = array_reverse($terms);
        $items_send[] = array_merge([
            'item_name' => $_product->get_title(),
            'item_id' => $values['product_id'],
            'price' => round($values['line_total'] / $values['quantity'], 2, PHP_ROUND_HALF_UP),
            'item_brand' => 'Onrial',
            'quantity' => $values['quantity'],
            'item_variant' => implode(', ', $item_var)
        ], $tmas);
    }

    ?>
    <script>
        var items_send = <?php echo json_encode($items_send); ?>;
    </script>
    <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

    <?php do_action( 'woocommerce_before_cart_table' ); ?>

    <?php do_action( 'woocommerce_before_cart_contents' ); ?>

    <div class="cart-popup-content-top">
        <?php if ( ! WC()->cart->is_empty() ) : // check empty ?>
            <div class="cart-popup-goods-top">
                <div class="cart-area">
                    <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        $terms = [];
                        $term = get_the_terms( $product_id, 'product_cat' );
                        $term = $term[0];
                        $terms[] = $term;
                        while($term->parent != 0){
                            $term = get_terms([
                                'taxonomy' => 'product_cat',
                                'include'  => $term->parent
                            ]);
                            $term = $term[0];
                            $terms[] = $term;
                        }
                        $terms = array_reverse($terms);

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                            <div class="cart-area-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>" data-cart_item_key="<?php echo $cart_item_key; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="price_code" value="<?php echo get_woocommerce_currency(); ?>">
                                <input type="hidden" name="product_price" value="<?php echo $_product->get_price( $_product ); ?>">
                                <a href="<?php echo $product_permalink; ?>" class="cart-area-item-img">
                                    <img src="<?php $image_id = $_product->get_image_id(); echo $image_id ? wp_get_attachment_image_url( $image_id, '150x0' ) : wc_placeholder_img_src(); ?>" alt="">
                                </a>
                                <input type="hidden" name="cats_one" value='<?php echo json_encode($terms); ?>'>
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
                                            <?php $product_attributes = $cart_item['data']->get_attributes(); if(is_array($product_attributes) && count($product_attributes)): ?>
                                                <div class="cart-area-item-content-ml">
                                                    <?php $m = 1; ?>
                                                    (<?php foreach ($product_attributes as $taxonomy => $slug): ?><?php if($m > 1): ?>, <?php endif; ?><?php $term = $term = get_term_by('slug', $slug, $taxonomy); echo $term->name; ?><?php $m++; ?><?php endforeach; ?>)
                                                </div>
                                            <?php endif; ?>
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

        <div class="cart-popup-discount-top">
            <?php $coupons = WC()->cart->get_applied_coupons(); if(is_array($coupons) && count($coupons)): ?>
                <div class="use-discount-form" style="display: block">
                    <div class="use-discount-form-title"><?php _e( 'Use your discount', \PS::$theme_name ); ?></div>
                    <div class="use-discount-form-input">
                        <div class="use-discount-form-input-clear remove_discount_code">
                            <img src="<?php echo \PS::$assets_url; ?>images/cross3.svg" alt="">
                        </div>
                        <input value="<?php echo $coupons[0]; ?>" class="discount_code" type="text" placeholder="<?php _e( 'Coupon code', \PS::$theme_name ); ?>" autocomplete="off">
                        <div class="use-discount-form-input-error-text" style="display: none"><?php _e( 'Coupon code is wrong or already used', \PS::$theme_name ); ?></div>
                    </div>
                    <div class="use-discount-form-btn apply_discount_code"><?php _e( 'Apply', \PS::$theme_name ); ?></div>
                </div>
            <?php else: ?>
                <?php if(get_field('form_coupons_active', \PS::$option_page)): ?>
                    <div class="cart-popup-discount-top-title have_discount_hide"><?php _e( 'Fill out the form and get a 5% discount', \PS::$theme_name ); ?></div>
                    <div class="cart-popup-discount-top-btn have_discount_hide js-modal-link" data-target="fill-out-form-popup"><?php _e( 'Get 5% discount', \PS::$theme_name ); ?></div>
                <?php endif; ?>
                <div class="cart-popup-discount-top-link have_discount_hide show_discount_form"><?php _e( 'I have a discount', \PS::$theme_name ); ?></div>

                <div class="use-discount-form have_discount_show" style="display: none">
                    <div class="use-discount-form-title"><?php _e( 'Use your discount', \PS::$theme_name ); ?></div>
                    <div class="use-discount-form-input">
                        <input class="discount_code" type="text" placeholder="<?php _e( 'Coupon code', \PS::$theme_name ); ?>" autocomplete="off">
                        <div class="use-discount-form-input-error-text" style="display: none"><?php _e( 'Coupon code is wrong or already used', \PS::$theme_name ); ?></div>
                    </div>
                    <div class="use-discount-form-btn apply_discount_code"><?php _e( 'Apply', \PS::$theme_name ); ?></div>
                </div>
            <?php endif; ?>

            <div class="cart-popup-discount-mobile">
                <div class="cart-popup-discount-delivery">
                    <div class="cart-popup-discount-delivery-block">
                        <div class="cart-popup-discount-delivery-block-name"><?php _e( 'Payment', \PS::$theme_name ); ?></div>
                        <div class="cart-popup-discount-delivery-block-icons">
                            <div class="cart-popup-discount-delivery-block-icons-item">
                                <img src="<?php echo \PS::$assets_url; ?>images/icon1.png" alt="">
                            </div>
                            <div class="cart-popup-discount-delivery-block-icons-item">
                                <img src="<?php echo \PS::$assets_url; ?>images/icon2.png" alt="">
                            </div>
                            <div class="cart-popup-discount-delivery-block-icons-item">
                                <img src="<?php echo \PS::$assets_url; ?>images/img32.png" alt="img">
                            </div>
                        </div>
                    </div>
                    <div class="cart-popup-discount-delivery-block">
                        <div class="cart-popup-discount-delivery-block-name"><?php _e( 'Delivery', \PS::$theme_name ); ?></div>
                        <div class="cart-popup-discount-delivery-block-icons">
                            <div class="cart-popup-discount-delivery-block-icons-item">
                                <img src="<?php echo \PS::$assets_url; ?>images/icon3.png" alt="">
                            </div>
                            <div class="cart-popup-discount-delivery-block-icons-item">
                                <img src="<?php echo \PS::$assets_url; ?>images/icon4.png" alt="">
                            </div>
                            <div class="cart-popup-discount-delivery-block-icons-item">
                                <img src="<?php echo \PS::$assets_url; ?>images/img33.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="cart-popup-content-bottom">
        <div class="cart_totals cart-popup-goods-bottom">
            <div class="cart-popup-goods-bottom-up">
                <div class="cart-popup-goods-bottom-up-quantiyt">
                    <?php _e( 'Items', \PS::$theme_name ); ?>: <span class="ajax-quantity"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                </div>
                <?php $discount_total = WC()->cart->get_discount_total(); if($discount_total): ?>
                    <div class="cart-popup-goods-bottom-up-quantiyt ajax-coupon-block">
                        <?php _e( 'Coupon', \PS::$theme_name ); ?>: <span class="ajax-coupon">-<?php echo WC()->cart->get_discount_total(); ?> <?php echo get_woocommerce_currency_symbol(); ?></span>
                    </div>
                <?php endif; ?>
                <div class="cart-popup-goods-bottom-up-summ">
                    <?php /*
                    <div class="art-popup-goods-bottom-up-summ-info">
                        <img src="<?php echo \PS::$assets_url; ?>images/icon5.svg" alt="">
                        <span><?php _e( 'For orders over $ 100, the shipping cost will be free', \PS::$theme_name ); ?></span>
                    </div>
                    <div class="art-popup-goods-bottom-up-summ-icon">
                        <img src="<?php echo \PS::$assets_url; ?>images/icon5.svg" alt="">
                    </div>
                    */ ?>
                    <div class="art-popup-goods-bottom-up-summ-text">
                        <?php _e( 'Subtotal', \PS::$theme_name ); ?>: <span class="ajax-total"><?php echo (WC()->cart->get_subtotal() - $discount_total); ?> <?php echo get_woocommerce_currency_symbol(); ?></span>
                    </div>
                </div>
            </div>
            <div class="cart-popup-goods-bottom-down">
                <div class="cart-popup-goods-bottom-continue js-close-modal"><?php _e( 'Continue shopping', \PS::$theme_name ); ?></div>
                <?php if ( ! WC()->cart->is_empty() ) : // check empty ?>
                    <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="cart-popup-goods-bottom-checkout-btn checkout-button button alt wc-forward">
                        <?php _e( 'Checkout', \PS::$theme_name ); ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <div class="cart-popup-discount-bottom">
            <div class="cart-popup-discount-delivery">
                <div class="cart-popup-discount-delivery-block">
                    <div class="cart-popup-discount-delivery-block-name"><?php _e( 'Payment', \PS::$theme_name ); ?></div>
                    <div class="cart-popup-discount-delivery-block-icons">
                        <div class="cart-popup-discount-delivery-block-icons-item">
                            <img src="<?php echo \PS::$assets_url; ?>images/icon1.png" alt="">
                        </div>
                        <div class="cart-popup-discount-delivery-block-icons-item">
                            <img src="<?php echo \PS::$assets_url; ?>images/icon2.png" alt="">
                        </div>
                        <div class="cart-popup-discount-delivery-block-icons-item">
                            <img src="<?php echo \PS::$assets_url; ?>images/img32.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="cart-popup-discount-delivery-block">
                    <div class="cart-popup-discount-delivery-block-name"><?php _e( 'Delivery', \PS::$theme_name ); ?></div>
                    <div class="cart-popup-discount-delivery-block-icons">
                        <div class="cart-popup-discount-delivery-block-icons-item">
                            <img src="<?php echo \PS::$assets_url; ?>images/icon3.png" alt="">
                        </div>
                        <div class="cart-popup-discount-delivery-block-icons-item">
                            <img src="<?php echo \PS::$assets_url; ?>images/icon4.png" alt="">
                        </div>
                        <div class="cart-popup-discount-delivery-block-icons-item">
                            <img src="<?php echo \PS::$assets_url; ?>images/img33.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_after_cart' ); ?>