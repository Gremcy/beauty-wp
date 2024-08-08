<?php /* Template Name: Resources */ ?>
<?php get_header(); ?>

<body class="resources-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="resources-page">
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

        <?php if(get_field('active_1')): ?>
            <section class="resources">
                <div class="resources__container">
                    <?php $title_1 = get_field('title_1'); if($title_1): ?>
                        <div class="resources__header">
                            <h1 class="primary"><?php echo $title_1; ?></h1>
                        </div>
                    <?php endif; ?>
                    <?php $img_1 = get_field('img_1'); if(is_array($img_1) && count($img_1)): ?>
                        <img src="<?php echo $img_1['sizes']['1600x0']; ?>" alt="" class="resources__image"/>
                    <?php endif; ?>
                    <?php $text_1 = get_field('text_1'); if($text_1): ?>
                        <?php echo str_ireplace(
                            ['<p>'],
                            ['<p class="resources__description">'],
                            $text_1
                        ); ?>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_2')): ?>
            <section class="resources-list">
                <div class="resources-list__container">
                    <?php $title_2 = get_field('title_2'); if($title_2): ?>
                        <p class="resources-list__title"><?php echo $title_2; ?></p>
                    <?php endif; ?>
                    <?php $list_2 = get_field('list_2'); if(is_array($list_2) && count($list_2)): ?>
                        <div class="resources-list__inner">
                            <ul class="resources-list__list">
                                <?php foreach ($list_2 as $li): ?>
                                    <li class="resources-list__item"><?php echo $li['text']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_3')): ?>
            <?php $list_3 = get_field('list_3'); if(is_array($list_3) && count($list_3)): ?>
                <section class="resources-tips">
                    <?php foreach ($list_3 as $li): ?>
                        <?php if(is_array($li['questions']) && count($li['questions'])): ?>
                            <div class="resources-tips__container">
                                <p class="resources-tips__title"><?php echo $li['title']; ?></p>
                            </div>
                            <ul class="resources-tips__list">
                                <li class="resources-tips__item">
                                    <div class="resources-tips__container">
                                        <p class="resources-tips__reason"><?php _e( 'REASON', \PS::$theme_name ); ?></p>
                                        <p class="resources-tips__solve"><?php _e( 'HOW TO SOLVE THE PROBLEM', \PS::$theme_name ); ?></p>
                                    </div>
                                </li>
                                <?php foreach ($li['questions'] as $question): ?>
                                    <li class="resources-tips__item">
                                        <div class="resources-tips__container">
                                            <p class="resources-tips__reason"><?php echo $question['text_1']; ?></p>
                                            <p class="resources-tips__solve"><?php echo $question['text_2']; ?></p>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('active_4')): ?>
            <section class="resources-list">
                <div class="resources-list__container">
                    <?php $title_4 = get_field('title_4'); if($title_4): ?>
                        <p class="resources-list__title"><?php echo $title_4; ?></p>
                    <?php endif; ?>
                    <?php $list_4 = get_field('list_4'); if(is_array($list_4) && count($list_4)): ?>
                        <div class="resources-list__inner">
                            <ul class="resources-list__list">
                                <?php foreach ($list_4 as $li): ?>
                                    <li class="resources-list__item"><?php echo $li['text']; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_5')): ?>
            <?php
            global $wp_query;
            \PS\Functions\Helper\Helper::get_products(get_field('list_5'));
            $custom_query = $wp_query;
            ?>
            <?php if ( $custom_query->have_posts() ): ?>
                <section class="resources-catalog-slider">
                    <div class="resources-catalog-slider__slider-container">
                        <?php $title_5 = get_field('title_5'); if($title_5): ?>
                            <p class="resources-catalog-slider__title"><?php echo $title_5; ?></p>
                        <?php endif; ?>
                        <div class="swiper-button-prev swiper-about-button-prev"></div>
                        <div class="swiper-button-next swiper-about-button-next"></div>
                        <div class="resources-catalog-slider__slider swiper js_bestsellers-slider">
                            <div class="resources-catalog-slider__list swiper-wrapper">
                                <?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                                    <?php get_template_part('woocommerce/content-product', null,  ['slider' => true]); ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        <?php endif; ?>

        <?php if(get_field('active_6')): ?>
            <?php $files_6 = get_field('files_6'); if(is_array($files_6) && count($files_6)): ?>
                <section class="resources-download">
                    <?php foreach ($files_6 as $li): ?>
                        <a href="<?php echo $li['type'] === 'file' ? $li['file'] : $li['link'] ?>" class="resources-download__link" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 35 35" fill="none"><path d="M27.587 26.01h5.725l-8.452 8.433v-5.705a2.737 2.737 0 0 1 2.727-2.728ZM33.85 4.63v19.46h-6.263a4.652 4.652 0 0 0-4.648 4.648V35H6.629A4.632 4.632 0 0 1 2 30.37V4.63A4.631 4.631 0 0 1 6.63 0h22.59a4.632 4.632 0 0 1 4.63 4.63ZM13.469 15.79a2.672 2.672 0 0 0-2.69-2.689H8.205a.96.96 0 0 0-.96.96v6.878a.96.96 0 0 0 .96.96.976.976 0 0 0 .96-.96V18.46h1.614a2.69 2.69 0 0 0 2.69-2.67Zm7.569-.019a2.665 2.665 0 0 0-2.67-2.67h-2.594a.96.96 0 0 0-.96.96v6.878a.96.96 0 0 0 .96.96h2.593a2.665 2.665 0 0 0 2.67-2.67v-3.458Zm7.626-1.71a.961.961 0 0 0-.96-.96H23.38a.96.96 0 0 0-.96.96v6.878a.96.96 0 0 0 1.92 0V18.46h2.229a.96.96 0 1 0 0-1.92H24.34v-1.518h3.362a.976.976 0 0 0 .96-.96Zm-17.884.96-1.614.001v1.518h1.614a.768.768 0 0 0 .768-.75.748.748 0 0 0-.768-.768Zm7.588 0h-1.633v4.957h1.633c.409-.01.739-.34.748-.749v-3.458a.768.768 0 0 0-.748-.749Z"/></svg>
                            <p class="resources-download__title"><?php echo $li['text']; ?></p>
                        </a>
                    <?php endforeach; ?>
                </section>
            <?php endif; ?>
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