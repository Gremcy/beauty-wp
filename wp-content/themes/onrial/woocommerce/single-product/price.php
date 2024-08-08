<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
$terms = [];
$term = get_the_terms( $product->get_id(), 'product_cat' );
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
?>
    <input type="hidden" name="hidden_cats" value='<?php echo json_encode($terms); ?>'>
    <input type="hidden" name="hidden_price" value='<?php echo $product->get_price(); ?>'>
    <input type="hidden" name="hidden_price_code" value='<?php echo get_woocommerce_currency(); ?>'>
<?php if ( $price_html = $product->get_price_html() ) : ?>
    <div class="product-right-options default-price">
        <div class="product-right-options-size"></div>
        <div class="product-right-options-price <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
            <?php if(strripos($price_html, '<del') !== false): // sale price ?>
                <?php echo str_ireplace(
                    ['<del', '</del>'],
                    ['<div class="product-right-options-crossed-price', '</div>'],
                    $price_html
                );
                ?>
            <?php else: ?>
                <?php echo $price_html; ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>