<?php defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$favs = \PS\Functions\Helper\Helper::get_favorite_ids();

$classes = [
    'ajax-products-item',
    isset($args['slider']) ? 'bestsellers-slider__item card swiper-slide' : 'categories-card',
    $product->is_on_sale() ? ' discount' : '',
    in_array($product->get_id(), $favs) ? 'favorit' : ''
];
?>

<div <?php wc_product_class(implode(' ', $classes), $product ); ?>>
    <div class="categories-card-item-top">
        <div class="categories-card-item-top-discount">
            <img src="<?php echo \PS::$assets_url; ?>images/icon8.svg" alt="">
        </div>
        <a href="javascript:void(0)" class="categories-card-item-top-like" data-product-id="<?= $product->get_id() ?>">
            <svg width="40" height="35" viewBox="0 0 40 35" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.7196 1.19971C6.13061 1.19971 1.59961 5.79098 1.59961 11.4543C1.59961 21.7089 13.5596 31.0313 19.9996 33.1997C26.4396 31.0313 38.3996 21.7089 38.3996 11.4543C38.3996 5.79098 33.8686 1.19971 28.2796 1.19971C24.8572 1.19971 21.8304 2.92155 19.9996 5.55699C19.0664 4.2101 17.8267 3.11088 16.3854 2.35241C14.9441 1.59394 13.3437 1.19855 11.7196 1.19971Z" stroke="#424242" stroke-width="2.13083" stroke-linecap="round" stroke-linejoin="round" /></svg>
        </a>
    </div>
    <a href="<?php echo $product->get_permalink(); ?>" class="categories-card-item-image" style="display: block">
        <img src="<?php $image_id = $product->get_image_id(); echo $image_id ? wp_get_attachment_image_url( $image_id, '960x0' ) : wc_placeholder_img_src(); ?>" alt="" loading="lazy">
    </a>
    <a href="<?php echo $product->get_permalink(); ?>" class="categories-card-item-name"><?php _e($product->get_name()); ?></a>
    <div class="categories-card-item-type"></div>
    <div class="categories-card-item-bottom">
        <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
    </div>
</div>