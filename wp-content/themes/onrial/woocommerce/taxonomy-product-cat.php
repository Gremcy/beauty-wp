<?php get_header(); ?>

<body class="categories-page<?php if(isset($_COOKIE['catalog-grid']) && $_COOKIE['catalog-grid'] === 'quick'): ?> quick-order-page<?php endif; ?>">
    <?php get_template_part('parts/_header'); ?>

    <main class="categories-main">
        <div class="pagination">
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="<?php echo get_the_permalink(\PS::$front_page); ?>"><?php echo get_the_title(\PS::$front_page); ?></a>
                </li>
                <li class="pagination__item">
                    <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>"><?php echo get_the_title(\PS::$shop_page); ?></a>
                </li>
                <?php woocommerce_breadcrumb(array(
                    'home' => false
                )); ?>
            </ul>
        </div>

        <?php woocommerce_output_all_notices(); ?>

        <?php $categories = get_terms(['taxonomy' => 'product_cat', 'parent' => get_queried_object()->term_id]); if(is_array($categories) && count($categories)): ?>
            <section class="subcatalog">
                <div class="container">
                    <ul class="subcatalog__list">
                        <?php foreach ($categories as $subcat): ?>
                            <li class="subcatalog__item">
                                <a href="<?php echo get_term_link( $subcat->term_id, 'product_cat' ); ?>" class="subcatalog__link">
                                    <?php $thumb = wp_get_attachment_image_src( get_term_meta( $subcat->term_id, 'thumbnail_id', true ), '480x0' ); if(isset($thumb[0])): ?>
                                        <img src="<?php echo $thumb[0]; ?>" alt="" class="subcatalog__image" />
                                    <?php endif; ?>
                                    <div class="subcatalog__wrapper">
                                        <p class="subcatalog__name"><?php echo $subcat->name; ?></p>
                                        <img src="<?php echo \PS::$assets_url; ?>images/main/goods/goods__arrow.svg" alt="" class="subcatalog__icon"/>
                                    </div>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>
        <?php endif; ?>

        <div class="categories-fluid">
            <div class="categories-centered">

                <div class="categories-top">
                    <div class="categories-top-title"><?php woocommerce_page_title(); ?></div>
                    <div class="categories-top-right">
                        <div class="categories-top-view">
                            <a href="javascript:void(0)" class="categories-top-view-tile change-catalog-grid<?php if(!isset($_COOKIE['catalog-grid']) || (isset($_COOKIE['catalog-grid']) && $_COOKIE['catalog-grid'] === 'original')): ?> active<?php endif; ?>" data-type="original">
                                <div class="categories-top-view-tile-icon"></div>
                            </a>
                            <a href="javascript:void(0)" class="categories-top-view-list change-catalog-grid<?php if(isset($_COOKIE['catalog-grid']) && $_COOKIE['catalog-grid'] === 'quick'): ?> active<?php endif; ?>" data-type="quick">
                                <div class="categories-top-view-list-icon"></div>
                                <span><?php _e( 'Quick order', \PS::$theme_name ); ?></span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="categories-filters">
                    <?php foreach ([620, 621, 622, 623, 4335] as $id): ?>
                        <?php echo str_ireplace(
                            ['bapf_ckbox', 'bapf_head', '<h3>', '</h3>', 'bapf_body', '<li>', '<li class="checked">'],
                            ['bapf_ckbox categories-filters-item', 'bapf_head categories-filters-item-head', '<span>', '</span><img src="' . \PS::$assets_url . 'images/icon7.svg" alt="">', 'bapf_body categories-filters-item-drop', '<li class="categories-filters-item-drop-el">', '<li class="categories-filters-item-drop-el checked">'],
                            do_shortcode('[br_filter_single filter_id=' . $id . ']')
                        ); ?>
                    <?php endforeach; ?>
                </div>

                <?php if (woocommerce_product_loop()): ?>

                    <?php if(isset($_COOKIE['catalog-grid']) && $_COOKIE['catalog-grid'] === 'quick'): ?>
                        <div class="quick-order-container ajax-products-container">
                            <?php if (wc_get_loop_prop('total')): ?>
                                <?php while (have_posts()): ?>
                                    <?php the_post(); ?>
                                    <?php do_action('woocommerce_shop_loop'); ?>

                                    <?php wc_get_template_part('content', 'product-quick'); ?>
                                <?php endwhile; ?>
                            <?php endif; ?>

                            <?php do_action( 'woocommerce_after_shop_loop' ); ?>
                        </div>
                    <?php else: ?>
                        <div class="products categories-cards ajax-products-container">
                            <?php if (wc_get_loop_prop('total')): ?>
                                <?php while (have_posts()): ?>
                                    <?php the_post(); ?>
                                    <?php do_action('woocommerce_shop_loop'); ?>

                                    <?php wc_get_template_part('content', 'product'); ?>
                                <?php endwhile; ?>
                            <?php endif; ?>

                            <?php do_action( 'woocommerce_after_shop_loop' ); ?>
                        </div>
                    <?php endif; ?>

                <?php else: ?>

                    <?php do_action('woocommerce_no_products_found'); ?>

                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php get_template_part('parts/_footer'); ?>

    <?php get_template_part('parts/_popups'); ?>

    <?php /* DON'T REMOVE THIS */ ?>
    <?php get_footer(); ?>
    <?php /* END */ ?>

    <?php /* WRITE SCRIPTS HERE */ ?>

    <?php /* END */ ?>

</body>
</html>