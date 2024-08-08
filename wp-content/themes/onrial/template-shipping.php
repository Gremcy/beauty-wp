<?php /* Template Name: Shipping */ ?>
<?php get_header(); ?>

<body class="returns-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="returns-page">
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

        <?php $list = get_field('list'); if(is_array($list) && count($list)): ?>
            <?php foreach ($list as $li): ?>
                <section class="returns">
                    <div class="returns__container">
                        <?php if($li['title']): ?><h1 class="primary"><?php echo $li['title']; ?></h1><?php endif; ?>

                        <?php if(is_array($li['img']) && count($li['img'])): ?>
                            <img src="<?php echo $li['img']['sizes']['960x0']; ?>" alt="" class="returns__image" />
                        <?php endif; ?>

                        <?php echo str_ireplace(
                            ['<p>', '<ul>', '<li>', '</li>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>'],
                            ['<p class="returns__description">', '<ul class="shipping__list">', '<li class="shipping__item"><p class="returns__description">', '</p></li>', '<p class="returns__title">', '<p class="returns__title">', '<p class="returns__title">', '<p class="returns__title">', '<p class="returns__title">', '<p class="returns__title">', '</p>', '</p>', '</p>', '</p>', '</p>', '</p>'],
                            $li['text']
                        ); ?>

                        <?php echo $li['title']; ?>
                    </div>
                </section>
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