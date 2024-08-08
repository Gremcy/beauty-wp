<?php /* Template Name: Front page */ ?>
<?php get_header(); ?>

<body class="main-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="main-page">
        <?php if(get_field('active_1')): ?>
            <?php $slider_1 = get_field('slider_1'); if(is_array($slider_1) && count($slider_1)): ?>
                <section class="top-slider">
                    <div class="top-slider__slider-container">
                        <div class="swiper-pagination"></div>
                        <div class="top-slider__slider swiper js_top-slider">
                            <ul class="top-slider__list swiper-wrapper">
                                <?php foreach ($slider_1 as $slide): ?>
                                    <li class="top-slider__item swiper-slide">
                                        <?php if(is_array($slide['img']) && count($slide['img'])): ?>
                                            <img src="<?php echo $slide['img']['sizes']['1600x0']; ?>" alt="" class="top-slider__image"/>
                                        <?php endif; ?>
                                        <div class="top-slider__wrapper">
                                            <div class="top-slider__wrapper-inner">
                                                <?php if($slide['button']['active']): ?><a href="<?php echo $slide['button']['link']; ?>" class="top-slider__button button"><?php echo $slide['button']['text']; ?></a><?php endif; ?>
                                                <?php if($slide['title']): ?><h1 class="top-slider__title"><?php echo $slide['title']; ?></h1><?php endif; ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <div class="swiper-scrollbar about-swiper-scrollbar"></div>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('active_2')): ?>
            <?php $title_2 = get_field('title_2'); if($title_2): ?>
                <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>" class="separator">
                    <ul class="separator__list">
                        <?php for ($n = 1; $n <= 10; $n++): ?>
                            <li class="separator__item">
                                <p><?php echo $title_2; ?></p>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </a>
            <?php endif; ?>

            <?php $product_cats = \PS\Functions\Plugins\Woocommerce::get_product_cats(); if(is_array($product_cats) && count($product_cats)): ?>
                <section class="goods">
                    <ul class="goods__list">
                        <?php $n = 1; ?>
                        <?php foreach ($product_cats as $cat): ?>
                            <li class="goods__item">
                                <a href="<?php echo get_term_link( $cat['category']->term_id, 'product_cat' ); ?>" class="goods__link">
                                    <p><span><?php echo sprintf( '%02d', $n ); ?></span><?php echo $cat['category']->name; ?></p>
                                    <img src="<?php echo \PS::$assets_url; ?>images/main/goods/goods__arrow.svg" alt="" class="goods__icon" />
                                </a>
                                <?php $thumb = wp_get_attachment_image_src( get_term_meta( $cat['category']->term_id, 'thumbnail_id', true ), '480x0' ); if(isset($thumb[0])): ?>
                                    <img src="<?php echo $thumb[0]; ?>" alt="" class="goods__image" />
                                <?php endif; ?>
                            </li>
                            <?php $n++; ?>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('active_3')): ?>
            <?php
            global $wp_query;
            \PS\Functions\Helper\Helper::get_products(get_field('list_3'));
            $custom_query = $wp_query;
            ?>
            <?php if ( $custom_query->have_posts() ): ?>
                <section class="bestsellers-slider">
                    <div class="bestsellers-slider__slider-container">
                        <?php $title_3 = get_field('title_3'); if($title_3): ?>
                            <p class="bestsellers-slider__title"><?php echo $title_3; ?></p>
                        <?php endif; ?>
                        <div class="swiper-button-prev swiper-about-button-prev"></div>
                        <div class="swiper-button-next swiper-about-button-next"></div>
                        <div class="bestsellers-slider__slider swiper js_bestsellers-slider">
                            <div class="bestsellers-slider__list swiper-wrapper">
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

        <?php if(get_field('active_4')): ?>
            <?php $list_4 = get_field('list_4'); if(is_array($list_4) && count($list_4)): ?>
                <?php foreach ($list_4 as $m => $li): ?>
                    <section class="about<?php if($m % 2): ?> reverse<?php endif; ?>">
                        <div class="about__container">
                            <?php if($li['title']): ?><p class="about__title"><?php echo $li['title']; ?></p><?php endif; ?>
                            <?php echo str_ireplace('<p>', '<p class="about__description">', $li['text']); ?>
                            <?php if(is_array($li['img']) && count($li['img'])): ?>
                                <img src="<?php echo $li['img']['sizes']['960x0']; ?>" alt="" class="about__image" />
                            <?php endif; ?>
                            <div class="about__content">
                                <?php if($li['title']): ?><p class="about__title"><?php echo $li['title']; ?></p><?php endif; ?>
                                <?php echo str_ireplace('<p>', '<p class="about__description">', $li['text']); ?>
                                <?php if($li['about_button']['show']): ?>
                                    <?php if($li['about_button']['type'] === 'url'): ?>
                                        <a href="<?php echo $li['about_button']['link']; ?>" class="about__button_arrow button_arrow">
                                            <?php echo $li['about_button']['text']; ?>
                                            <svg class="button_arrow__icon" width="46" height="16" viewBox="0 0 46 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8L45 8" stroke="#424242" /><path d="M35.8856 0.5L44.9995 6.81579V9.18421L35.8856 15.5" stroke="#424242" /></svg>
                                            <svg class="button_arrow__icon-mobile" width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 9L24.887 9" stroke="#424242" /><path d="M16.0408 1L25.0001 7.73684V10.2632L16.0408 17" stroke="#424242" /></svg>
                                        </a>
                                    <?php elseif($li['about_button']['type'] === 'form'): ?>
                                        <a href="javascript:void(0)" class="about__button_arrow button_arrow js-modal-link" data-target="become-partner-popup">
                                            <?php echo $li['about_button']['text']; ?>
                                            <svg class="button_arrow__icon" width="46" height="16" viewBox="0 0 46 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8L45 8" stroke="#424242" /><path d="M35.8856 0.5L44.9995 6.81579V9.18421L35.8856 15.5" stroke="#424242" /></svg>
                                            <svg class="button_arrow__icon-mobile" width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 9L24.887 9" stroke="#424242" /><path d="M16.0408 1L25.0001 7.73684V10.2632L16.0408 17" stroke="#424242" /></svg>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php $list_4_2 = get_field('list_4_2'); if(is_array($list_4_2) && count($list_4_2)): ?>
                <section class="statistics">
                    <ul class="statistics__list">
                        <?php foreach ($list_4_2 as $li): ?>
                            <li class="statistics__item">
                                <p class="statistics__number"><?php echo $li['title']; ?></p>
                                <p class="statistics__description"><?php echo $li['text']; ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('active_5')): ?>
            <?php
            global $wp_query;
            \PS\Functions\Helper\Helper::get_mainpage_advices();
            $custom_query = $wp_query;
            ?>
            <?php if ( $custom_query->have_posts() ): ?>
                <section class="advice">
                    <div class="advice__container">
                        <div class="advice__wrapper">
                            <?php $title_5 = get_field('title_5'); if($title_5): ?>
                                <p class="advice__title"><?php echo $title_5; ?></p>
                            <?php endif; ?>
                            <a href="<?php echo get_the_permalink(\PS::$advices_page); ?>" class="about__button_arrow button_arrow">
                                <?php _e( 'see more', \PS::$theme_name ); ?>
                                <svg class="button_arrow__icon" width="46" height="16" viewBox="0 0 46 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8L45 8" stroke="#424242" /><path d="M35.8856 0.5L44.9995 6.81579V9.18421L35.8856 15.5" stroke="#424242" /></svg>
                                <svg class="button_arrow__icon-mobile" width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 9L24.887 9" stroke="#424242" /><path d="M16.0408 1L25.0001 7.73684V10.2632L16.0408 17" stroke="#424242" /></svg>
                            </a>
                        </div>
                        <ul class="advice__list">
                            <?php while ( $custom_query->have_posts() ): $custom_query->the_post(); ?>
                                <li class="advice__item advice-card">
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <?php $img = get_field('img'); if(is_array($img) && count($img)): ?>
                                            <img src="<?php echo $img['sizes']['960x0']; ?>" alt="" class="advice-card__image">
                                        <?php endif; ?>
                                        <div class="advice-card__description-container">
                                            <p class="advice-card__description"><?php echo get_the_title(); ?></p>
                                        </div>
                                        <?php $advices_tags = get_field('advices_tags'); if(isset($advices_tags->name)): ?>
                                            <p class="advice-card__type"><?php echo $advices_tags->name; ?></p>
                                        <?php endif; ?>
                                    </a>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                        <a href="<?php echo get_the_permalink(\PS::$advices_page); ?>" class="about__button_arrow button_arrow">
                            <?php _e( 'see more', \PS::$theme_name ); ?>
                            <svg class="button_arrow__icon" width="46" height="16" viewBox="0 0 46 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8L45 8" stroke="#424242" /><path d="M35.8856 0.5L44.9995 6.81579V9.18421L35.8856 15.5" stroke="#424242" /></svg>
                            <svg class="button_arrow__icon-mobile" width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 9L24.887 9" stroke="#424242" /><path d="M16.0408 1L25.0001 7.73684V10.2632L16.0408 17" stroke="#424242" /></svg>
                        </a>
                    </div>
                </section>
            <?php endif; ?>
            <?php wp_reset_query(); ?>
        <?php endif; ?>

        <?php if(get_field('active_6')): ?>
            <section class="contact-us">
                <div class="contact-us__container">
                    <?php $form_letter_title = get_field('form_letter_title', \PS::$option_page); if($form_letter_title): ?>
                        <p class="contact-us__title"><?php echo __($form_letter_title); ?></p>
                    <?php endif; ?>
                    <div class="contact-us__wrapper">
                        <?php $form_letter_text = get_field('form_letter_text', \PS::$option_page); if($form_letter_text): ?>
                            <div class="contact-us__description-wrapper">
                                <p class="contact-us__description"><?php echo __($form_letter_text); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php get_template_part('parts/forms/contact-us'); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_7')): ?>
            <?php get_template_part('parts/elements/instagram'); ?>
        <?php endif; ?>
    </main>

    <?php get_template_part('parts/_footer'); ?>

    <?php get_template_part('parts/_popups'); ?>

    <?php if(get_field('active_4')): ?>
        <div class="modal modal--sm js-modal" data-modal="become-partner-popup">
            <div class="modal__overlay js-close-modal"></div>
            <div class="fill-out-form-content">
                <div class="fill-out-form-close js-close-modal">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
                </div>
                <?php get_template_part('parts/forms/partner'); ?>
            </div>
        </div>

        <div class="modal modal--sm js-modal" data-modal="become-partner-thanks-popup">
            <div class="modal__overlay js-close-modal"></div>
            <div class="thanks-popup-content">
                <div class="fill-out-form-close js-close-modal">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
                </div>
                <div class="thanks-popup-icon">
                    <img src="<?php echo \PS::$assets_url; ?>images/check-icon.svg" alt="">
                </div>
                <?php $form_partner_success_title = get_field('form_partner_success_title', \PS::$option_page); if($form_partner_success_title): ?>
                    <div class="thanks-popup-title"><?php echo __($form_partner_success_title); ?></div>
                <?php endif; ?>
                <?php $form_partner_success_text = get_field('form_partner_success_text', \PS::$option_page); if($form_partner_success_text): ?>
                    <div class="thanks-popup-description"><?php echo __($form_partner_success_text); ?></div>
                <?php endif; ?>
                <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>" class="thanks-popup-btn"><?php _e( 'Go to catalog', \PS::$theme_name ); ?></a>
            </div>
        </div>
    <?php endif; ?>

    <?php if(get_field('active_6')): ?>
        <div class="modal modal--sm js-modal" data-modal="letter-thanks-popup">
            <div class="modal__overlay js-close-modal"></div>
            <div class="thanks-popup-content">
                <div class="fill-out-form-close js-close-modal">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
                </div>
                <div class="thanks-popup-icon">
                    <img src="<?php echo \PS::$assets_url; ?>images/check-icon.svg" alt="">
                </div>
                <?php $form_letter_success_title = get_field('form_letter_success_title', \PS::$option_page); if($form_letter_success_title): ?>
                    <div class="thanks-popup-title"><?php echo __($form_letter_success_title); ?></div>
                <?php endif; ?>
                <?php $form_letter_success_text = get_field('form_letter_success_text', \PS::$option_page); if($form_letter_success_text): ?>
                    <div class="thanks-popup-description"><?php echo __($form_letter_success_text); ?></div>
                <?php endif; ?>
                <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>" class="thanks-popup-btn"><?php _e( 'Go to catalog', \PS::$theme_name ); ?></a>
            </div>
        </div>
    <?php endif; ?>

    <?php /* DON'T REMOVE THIS */ ?>
    <?php get_footer(); ?>
    <?php /* END */ ?>

    <?php /* WRITE SCRIPTS HERE */ ?>

    <?php /* END */ ?>

</body>
</html>