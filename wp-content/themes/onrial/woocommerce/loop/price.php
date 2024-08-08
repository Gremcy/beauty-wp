<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) : ?>
    <div class="categories-card-item-bottom-prices">
        <?php if(strripos($price_html, '<del') !== false): // sale price ?>
            <?php echo str_ireplace(
                ['<del', '</del>', '<ins', '</ins>'],
                ['<div class="categories-card-item-bottom-crossed-price', '</div>', '<div class="categories-card-item-bottom-current-price"', '</div>'],
                $price_html
            );
            ?>
        <?php else: ?>
            <div class="categories-card-item-bottom-current-price"><?php echo $price_html; ?></div>
        <?php endif; ?>
    </div>
<?php endif; ?>
