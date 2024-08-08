<?php get_header(); ?>

<body class="catalog-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="catalog-page">
        <div class="pagination">
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="<?php echo get_the_permalink(\PS::$front_page); ?>"><?php echo get_the_title(\PS::$front_page); ?></a>
                </li>
                <li class="pagination__item">
                    <a href="javascript:void(0)"><?php echo get_the_title(\PS::$shop_page); ?></a>
                </li>
            </ul>
        </div>
        <section class="catalog">
            <div class="container">
                <p class="catalog__title"><?php echo get_the_title(\PS::$shop_page); ?></p>
                <?php $product_cats = \PS\Functions\Plugins\Woocommerce::get_product_cats(); if(is_array($product_cats) && count($product_cats)): ?>
                    <ul class="catalog__list">
                        <?php $n = 1; ?>
                        <?php foreach ($product_cats as $cat): ?>
                            <li class="catalog__item<?php if(is_array($cat['sub']) && count($cat['sub'])): ?> clickable<?php endif; ?><?php if(is_array($cat['sub']) && count($cat['sub']) && $n === 1): ?> js__active<?php endif; ?>" data-term_id="<?php echo $cat['category']->term_id; ?>">
                                <a href="<?php if(is_array($cat['sub']) && count($cat['sub'])): ?>javascript:void(0)<?php else: ?><?php echo get_term_link( $cat['category']->term_id, 'product_cat' ); ?><?php endif; ?>" class="catalog__link"><?php echo $cat['category']->name; ?></a>
                            </li>
                            <?php $n++; ?>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </section>

        <div id="subcatalog"></div>

        <?php if(is_array($product_cats) && count($product_cats)): ?>
            <?php $n = 1; ?>
            <?php foreach ($product_cats as $cat): ?>
                <?php if(is_array($cat['sub']) && count($cat['sub'])): ?>
                    <section class="subcatalog" data-term_id="<?php echo $cat['category']->term_id; ?>"<?php if($n !== 1): ?> style="display: none"<?php endif; ?>>
                        <div class="container">
                            <p class="subcatalog__title"><?php echo $cat['category']->name; ?></p>
                            <ul class="subcatalog__list">
                                <?php /*
                                <li class="subcatalog__item">
                                    <a href="<?php echo get_term_link( $cat['category']->term_id, 'product_cat' ); ?>" class="subcatalog__link">
                                        <?php $thumb = wp_get_attachment_image_src( get_term_meta( $cat['category']->term_id, 'thumbnail_id', true ), '480x0' ); if(isset($thumb[0])): ?>
                                            <img src="<?php echo $thumb[0]; ?>" alt="" class="subcatalog__image" />
                                        <?php endif; ?>
                                        <div class="subcatalog__wrapper">
                                            <p class="subcatalog__name"><?php _e( 'All', \PS::$theme_name ); ?> <?php echo $cat['category']->name; ?></p>
                                            <img src="<?php echo \PS::$assets_url; ?>images/main/goods/goods__arrow.svg" alt="" class="subcatalog__icon"/>
                                        </div>
                                    </a>
                                </li>
                                */ ?>

                                <?php foreach ($cat['sub'] as $subcat): ?>
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
                                    <?php $n++; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </section>
                <?php endif; ?>
                <?php $n++; ?>
            <?php endforeach; ?>
        <?php endif; ?>
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