<?php get_header(); ?>

<body class="delivery-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="delivery-main">
        <div class="delivery-main-920">
            <?php the_content(); ?>
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