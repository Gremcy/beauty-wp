<?php /* Template Name: Ambassador */ ?>
<?php get_header(); ?>

<body class="ambassador-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="ambassador-page">
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
            <section class="ambassador">
                <div class="ambassador__container">
                    <?php $title_1 = get_field('title_1'); if($title_1): ?>
                        <h1 class="primary"><?php echo $title_1; ?></h1>
                    <?php endif; ?>
                    <?php $img_1 = get_field('img_1'); if(is_array($img_1) && count($img_1)): ?>
                        <img src="<?php echo $img_1['sizes']['1600x0']; ?>" alt="" class="ambassador__image"/>
                    <?php endif; ?>
                    <?php $text_1 = get_field('text_1'); if($text_1): ?>
                        <?php echo str_ireplace(
                            ['<p>'],
                            ['<p class="ambassador__description">'],
                            $text_1
                        ); ?>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_2')): ?>
            <section class="ambassador-about">
                <div class="ambassador-about__container">
                    <?php $title_2 = get_field('title_2'); if($title_2): ?>
                        <div class="ambassador-about__title"><?php echo $title_2; ?></div>
                    <?php endif; ?>
                    <?php $text_2 = get_field('text_2'); if($text_2): ?>
                        <div class="ambassador-about__description"><?php echo $text_2; ?></div>
                    <?php endif; ?>
                    <?php $list_2 = get_field('list_2'); if(is_array($list_2) && count($list_2)): ?>
                        <div class="ambassador-about__wrapper">
                            <?php foreach ($list_2 as $img): ?>
                                <img src="<?php echo $img['sizes']['960x0']; ?>" alt="" class="ambassador-about__image"/>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_3')): ?>
            <?php $list_3 = get_field('list_3'); if(is_array($list_3) && count($list_3)): ?>
                <?php foreach ($list_3 as $block): ?>
                    <section class="ambassador-brand">
                        <div class="ambassador-brand__container">
                            <div class="ambassador-brand__title"><?php echo $block['title']; ?></div>
                            <div class="ambassador-brand__inner">
                                <?php if(is_array($block['list']) && count($block['list'])): ?>
                                    <ul class="ambassador-brand__list">
                                        <?php foreach ($block['list'] as $li): ?>
                                            <li class="ambassador-brand__item"><?php echo $li['text']; ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                                <?php $lines = explode('<br />', $block['text']); if(is_array($lines) && count($lines)): ?>
                                    <div class="ambassador-brand__wrapper">
                                        <?php foreach ($lines as $line): ?>
                                            <p class="ambassador-brand__subtitle<?php if(strripos($line, '<span>') !== false): ?> warning<?php endif; ?>"><?php echo $line; ?></p>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('active_4')): ?>
            <section class="ambassador-hashtags">
                <div class="ambassador-hashtags__container">
                    <?php $title_4 = get_field('title_4'); if($title_4): ?>
                        <p class="ambassador-hashtags__description"><?php echo $title_4; ?></p>
                    <?php endif; ?>
                    <?php $list_4 = get_field('list_4'); if(is_array($list_4) && count($list_4)): ?>
                        <ul class="ambassador-hashtags__list">
                            <?php foreach ($list_4 as $li): ?>
                                <li class="ambassador-hashtags__item"><?php echo $li['text']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_5')): ?>
            <section class="ambassador-contact">
                <div class="ambassador-contact__container">
                    <?php $title_5 = get_field('title_5'); if($title_5): ?>
                        <p class="ambassador-contact__title"><?php echo $title_5; ?></p>
                    <?php endif; ?>
                    <a href="javascript:void(0)" class="ambassador-contact__button_arrow button_arrow js-modal-link" data-target="ambassador-popup"><?php _e( 'The form', \PS::$theme_name ); ?>
                        <svg class="button_arrow__icon" width="46" height="16" viewBox="0 0 46 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8L45 8" stroke="#424242" /><path d="M35.8856 0.5L44.9995 6.81579V9.18421L35.8856 15.5" stroke="#424242"/></svg>
                        <svg class="button_arrow__icon-mobile" width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 9L24.887 9" stroke="#424242" /><path d="M16.0408 1L25.0001 7.73684V10.2632L16.0408 17" stroke="#424242"/></svg>
                    </a>
                </div>
            </section>
        <?php endif; ?>
    </main>

    <?php get_template_part('parts/_footer'); ?>

    <?php get_template_part('parts/_popups'); ?>

    <?php if(get_field('active_5')): ?>
        <div class="modal modal--sm js-modal" data-modal="ambassador-popup">
            <div class="modal__overlay js-close-modal"></div>
            <div class="fill-out-form-content">
                <div class="fill-out-form-close js-close-modal">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
                </div>
                <?php get_template_part('parts/forms/ambassador'); ?>
            </div>
        </div>

        <div class="modal modal--sm js-modal" data-modal="ambassador-thanks-popup">
            <div class="modal__overlay js-close-modal"></div>
            <div class="thanks-popup-content">
                <div class="fill-out-form-close js-close-modal">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
                </div>
                <div class="thanks-popup-icon">
                    <img src="<?php echo \PS::$assets_url; ?>images/check-icon.svg" alt="">
                </div>
                <?php $form_ambassador_success_title = get_field('form_ambassador_success_title', \PS::$option_page); if($form_ambassador_success_title): ?>
                    <div class="thanks-popup-title"><?php echo __($form_ambassador_success_title); ?></div>
                <?php endif; ?>
                <?php $form_ambassador_success_text = get_field('form_ambassador_success_text', \PS::$option_page); if($form_ambassador_success_text): ?>
                    <div class="thanks-popup-description"><?php echo __($form_ambassador_success_text); ?></div>
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