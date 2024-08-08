<?php get_header(); ?>

<?php echo get_the_content(); ?>

<body class="checkout-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="main-checkout ajax-minicart">
        <?php echo do_shortcode('[woocommerce_cart]'); ?>
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