<?php defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
$favs = \PS\Functions\Helper\Helper::get_favorite_ids();

$classes = [
    'ajax-products-item',
    'quick-order-item',
    $product->is_on_sale() ? ' discount' : '',
    in_array($product->get_id(), $favs) ? 'favorit' : ''
];
?>

<div <?php wc_product_class(implode(' ', $classes), $product ); ?>>
    <div class="quick-order-item-left">
        <div class="quick-order-item-left-product">
            <a href="<?php echo $product->get_permalink(); ?>" class="quick-order-item-left-product-img">
                <img src="<?php $image_id = $product->get_image_id(); echo $image_id ? wp_get_attachment_image_url( $image_id, '960x0' ) : wc_placeholder_img_src(); ?>" alt="" loading="lazy">
            </a>
            <div class="quick-order-item-left-product-desc">
                <a href="<?php echo $product->get_permalink(); ?>" class="quick-order-item-left-product-desc-name"><?php _e($product->get_name()); ?></a>
            </div>

            <?php woocommerce_template_single_price(); ?>

            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>
    </div>
</div>