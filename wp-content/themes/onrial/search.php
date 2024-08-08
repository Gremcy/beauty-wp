<?php get_header(); ?>

<?php
$s = wp_strip_all_tags(get_query_var('s'), true);
$results = \PS\Functions\Helper\Helper::search_results($s);
?>

<body class="search-result-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="search-result-main">
        <?php
        global $wp_query;
        \PS\Functions\Helper\Helper::search_products($results);
        $custom_query = $wp_query;
        ?>
        <?php if ( $custom_query->have_posts() ): ?>

            <div class="search-result-fluid">
                <div class="search-result-centered">
                    <div class="search-result-title">
                        <?php _e( 'Search results for', \PS::$theme_name ); ?> "<?php echo $s; ?>". <?php _e( 'Found', \PS::$theme_name ); ?> <?php echo $custom_query->found_posts; ?> <?php if($custom_query->found_posts === 1): ?><?php _e( 'product', \PS::$theme_name ); ?><?php else: ?><?php _e( 'products', \PS::$theme_name ); ?><?php endif; ?>.
                    </div>
                    <div class="search-result-container">
                        <?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                            <div class="search-result-item">
                                <?php get_template_part('woocommerce/content-product'); ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="search-result-nofind-fluid show">
                <div class="search-result-nofind-text"><?php _e( 'Nothing found for', \PS::$theme_name ); ?> "<?php echo $s; ?>".</div>

                <?php
                global $wp_query;
                \PS\Functions\Helper\Helper::get_random_products();
                $custom_query = $wp_query;
                ?>
                <?php if ( $custom_query->have_posts() ): ?>
                    <div class="search-result-fluid">
                        <div class="search-result-centered">
                            <div class="search-result-title"><?php _e( 'Maybe you like', \PS::$theme_name ); ?></div>
                            <div class="search-result-container">
                                <?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                                    <div class="search-result-item">
                                        <?php get_template_part('woocommerce/content-product'); ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php wp_reset_query(); ?>
            </div>

        <?php endif; ?>
        <?php wp_reset_query(); ?>
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