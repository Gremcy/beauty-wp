<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( $related_products ) : ?>

	<div class="profile-favorite-slider-fluid">
        <div class="profile-favorite-slider-wrapper">
            <?php $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) ); if ( $heading ) : ?>
                <div class="product-more-title"><?php echo esc_html( $heading ); ?></div>
            <?php endif; ?>
            <div class="profile-favorite-slider-arrows">
                <div class="slick-prev">
                    <img src="<?php echo \PS::$assets_url; ?>images/arrow-prev.svg" alt="">
                </div>
                <div class="slick-next">
                    <img src="<?php echo \PS::$assets_url; ?>images/arrow-next.svg" alt="">
                </div>
            </div>
            <div class="profile-favorite-slider">
                <?php foreach ( $related_products as $related_product ) : ?>
                    <div class="profile-favorite-slider-item">
                        <?php
                        $post_object = get_post( $related_product->get_id() );
                        setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found
                        wc_get_template_part( 'content', 'product' );
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
	</div>
	<?php
endif;

wp_reset_postdata();