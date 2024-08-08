<?php get_header(); ?>

<body class="advicemasters-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="advicemasters-main">
        <div class="pagination">
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="<?php echo get_the_permalink(\PS::$front_page); ?>"><?php echo get_the_title(\PS::$front_page); ?></a>
                </li>
                <li class="pagination__item">
                    <a href="javascript:void(0)"><?php echo get_the_title(); ?></a>
                </li>
            </ul>
        </div>

        <div class="advicemasters-hero-fluid">
            <div class="advicemasters-hero-centered">
                <?php $title_1 = get_field('title_1'); if($title_1): ?>
                    <div class="advicemasters-hero-title"><?php echo $title_1; ?></div>
                <?php endif; ?>

                <?php $advices_tags = get_terms(['taxonomy' => 'advices_tags']); if(is_array($advices_tags) && count($advices_tags)): ?>
                    <div class="advicemasters-hero-slider-wrapper">
                        <div class="advicemasters-hero-slider-arrows">
                            <div class="slick-prev">
                                <img src="<?php echo \PS::$assets_url; ?>images/arrow-prev.svg" alt="">
                            </div>
                            <div class="slick-next">
                                <img src="<?php echo \PS::$assets_url; ?>images/arrow-next.svg" alt="">
                            </div>
                        </div>
                        <div class="advicemasters-hero-slider">
                            <?php foreach ($advices_tags as $advices_tag): ?>
                                <div class="advicemasters-hero-slider-item">
                                    <a href="<?php echo \PS\Functions\Plugins\Qtranslate::current_site_url('/advices/filter/' . $advices_tag->slug . '/'); ?>#articles" class="advicemasters-hero-slider-item-inner">
                                        <?php $img = get_field('img', 'term_' . $advices_tag->term_id); if(is_array($img) && count($img)): ?>
                                            <div class="advicemasters-hero-slider-item-img">
                                                <img src="<?php echo $img['sizes']['960x0']; ?>" alt="">
                                            </div>
                                        <?php endif; ?>
                                        <div class="advicemasters-hero-slider-item-overlay"></div>
                                        <div class="advicemasters-hero-slider-item-text"><?php echo $advices_tag->name; ?></div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div id="articles"></div>
            </div>
        </div>

        <div class="advicemasters-trends-fluid">
            <div class="advicemasters-trends-center">
                <?php
                global $wp_query;
                $current_tag = get_query_var('section');
                \PS\Functions\Helper\Helper::get_advices($current_tag);
                $custom_query = $wp_query;
                ?>
                <?php if ( $custom_query->have_posts() ): ?>
                    <div class="advicemasters-trends-title">
                        <?php $advices_tag = get_term_by('slug', $current_tag, 'advices_tags'); if(isset($advices_tag->name)): ?>
                            <?php echo $advices_tag->name; ?>
                        <?php else: ?>
                            <?php _e( 'All articles', \PS::$theme_name ); ?>
                        <?php endif; ?>
                    </div>
                    <div class="advicemasters-trends-container">
                        <?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                            <a href="<?php echo get_the_permalink(); ?>" class="advicemasters-trends-item">
                                <?php $img = get_field('img'); if(is_array($img) && count($img)): ?>
                                    <div class="advicemasters-trends-item-img">
                                        <img src="<?php echo $img['sizes']['960x0']; ?>" alt="">
                                    </div>
                                <?php endif; ?>
                                <div class="advicemasters-trends-item-date"><?php echo get_the_time('d/m/Y'); ?></div>
                                <div class="advicemasters-trends-item-description"><?php echo get_the_title(); ?></div>
                            </a>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="advicemasters-trends-title"><?php _e( 'Nothing found.', \PS::$theme_name ); ?></div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>
        </div>

        <?php if(get_field('active_2')): ?>
            <?php get_template_part('parts/elements/instagram'); ?>
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