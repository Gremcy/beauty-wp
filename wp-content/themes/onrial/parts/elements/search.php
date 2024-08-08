<?php if (!defined('ABSPATH')){exit;} ?>

<?php if ( $custom_query->have_posts() ): ?>

    <div class="header-search-result-container">
        <div class="header-search-result-title"><?php _e( 'Search results', \PS::$theme_name ); ?> (<?php echo $custom_query->found_posts; ?>)</div>

        <?php $m = 1; ?>
        <?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
            <?php if($m <= 5): ?>
                <?php global $product; ?>
                <a href="<?php echo $product->get_permalink(); ?>" class="header-search-result-item">
                    <div class="header-search-result-item-image">
                        <img src="<?php $image_id = $product->get_image_id(); echo $image_id ? wp_get_attachment_image_url( $image_id, '100x100' ) : wc_placeholder_img_src(); ?>" alt="">
                    </div>
                    <div class="header-search-result-item-right">
                        <div class="header-search-result-item-right-name"><?php _e($product->get_name()); ?></div>
                        <?php if ( $price_html = $product->get_price_html() ) : ?>
                            <div class="header-search-result-item-right-category <?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>">
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
                        <?php endif; ?>
                    </div>
                </a>
            <?php endif; ?>
            <?php $m++; ?>
        <?php endwhile; ?>

        <div class="header-search-result-container show">
            <div class="header-search-result-preloader">
                <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve"><path fill="#424242" d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50"><animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s" from="0 50 50" to="360 50 50" repeatCount="indefinite"/></path></svg>
            </div>
        </div>
    </div>
    <a href="javascript:void(0)" class="header-search-result-bottom trigger_search_form">
        <div class="header-search-result-bottom-inner">
            <span><?php _e( 'Show all results', \PS::$theme_name ); ?></span>
            <img src="<?php echo \PS::$assets_url; ?>images/arrow5.svg" alt="">
        </div>
    </a>

<?php else: ?>

    <div class="header-search-result-container search-empty">
        <div class="header-search-result-title"><?php _e( 'Nothing found', \PS::$theme_name ); ?></div>
    </div>

<?php endif; ?>
<?php wp_reset_query(); ?>