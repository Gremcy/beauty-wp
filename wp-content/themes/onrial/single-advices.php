<?php get_header(); ?>

<body class="advice-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="advice-page">
        <div class="pagination">
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="<?php echo get_the_permalink(\PS::$front_page); ?>"><?php echo get_the_title(\PS::$front_page); ?></a>
                </li>
                <li class="pagination__item">
                    <a href="<?php echo get_the_permalink(\PS::$advices_page); ?>"><?php echo get_the_title(\PS::$advices_page); ?></a>
                </li>
                <?php $advices_tags = get_field('advices_tags'); if(isset($advices_tags->term_id)): ?>
                    <li class="pagination__item">
                        <a href="<?php echo get_the_permalink(\PS::$advices_page); ?>filter/<?php echo $advices_tags->slug; ?>/#articles"><?php echo $advices_tags->name; ?></a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <section class="advice">
            <div class="advice__container">
                <h1 class="primary"><?php echo get_the_title(); ?></h1>
            </div>
        </section>

        <?php $text = get_field('text'); if(is_array($text) && count($text)): ?>
            <section class="advice-about">
                <div class="advice-about__container">
                    <?php foreach($text as $block): ?>
                        <?php if($block['acf_fc_layout'] == 'text'): ?>

                            <?php echo str_ireplace(
                                ['<p>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>', '</h1>', '</h2>', '</h3>', '</h4>', '</h5>', '</h6>'],
                                ['<p class="advice-about__description">', '<p class="advice-about__title">', '<p class="advice-about__title">', '<p class="advice-about__title">', '<p class="advice-about__title">', '<p class="advice-about__title">', '<p class="advice-about__title">', '</p>', '</p>', '</p>', '</p>', '</p>', '</p>'],
                                $block['text']
                            ); ?>

                        <?php elseif($block['acf_fc_layout'] == 'imgs'): ?>

                            <?php if(count($block['imgs']) === 1): ?>
                                <?php foreach ($block['imgs'] as $img): ?>
                                    <img src="<?php echo $img['sizes']['1600x0']; ?>" alt="" class="advice__image"/>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="advice-about__wrapper">
                                    <?php foreach ($block['imgs'] as $img): ?>
                                        <img src="<?php echo $img['sizes']['960x0']; ?>" alt="" class="advice-about__image"/>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_2', \PS::$advices_page)): ?>
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