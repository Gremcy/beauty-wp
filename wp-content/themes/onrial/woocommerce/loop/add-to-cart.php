<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

echo str_ireplace('"button ', '"', apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'categories-card-item-bottom-cart-btn' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		'<img src="' . \PS::$assets_url . 'images/bag.svg" alt="">'
	),
	$product,
	$args
));