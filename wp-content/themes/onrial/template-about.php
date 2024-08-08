<?php /* Template Name: About us */ ?>
<?php get_header(); ?>

<body class="about-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="about-page">
        <?php if(get_field('active_1')): ?>
            <section class="about-top top-section"<?php $img_1 = get_field('img_1'); if(is_array($img_1) && count($img_1)): ?> style="background: url('<?php echo $img_1['sizes']['1600x0']; ?>') no-repeat center/cover;"<?php endif; ?>>
                <div class="top-section__container">
                    <?php $title_1 = get_field('title_1'); if($title_1): ?><h1><?php echo $title_1; ?></h1><?php endif; ?>
                    <a href="#first-block" class="top-section__link">
                        <svg width="22" height="26" viewBox="0 0 22 26" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 0L11 25" /><path d="M21 14L12.5789 25L9.42105 25L0.999999 14" /></svg>
                    </a>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_2')): ?>
            <?php $title_2 = get_field('title_2'); if($title_2): ?>
                <section class="separator" id="first-block">
                    <ul class="separator__list">
                        <?php for ($n = 1; $n <= 16; $n++): ?>
                            <li class="separator__item">
                                <p><?php echo $title_2; ?></p>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </section>
            <?php endif; ?>

            <?php $list_2 = get_field('list_2'); if(is_array($list_2) && count($list_2)): ?>
                <?php foreach ($list_2 as $m => $li): ?>
                    <section class="about-section<?php if($m % 2): ?> reverse<?php endif; ?>">
                        <div class="about-section__container">
                            <div class="about-section__wrapper">
                                <?php if($li['title']): ?><p class="about-section__title"><?php echo $li['title']; ?></p><?php endif; ?>
                                <?php echo str_ireplace('<p>', '<p class="about-section__description">', $li['text']); ?>
                            </div>
                            <?php if(is_array($li['img']) && count($li['img'])): ?>
                                <img src="<?php echo $li['img']['sizes']['960x0']; ?>" alt="" class="about-section__image" />
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('active_3')): ?>
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

        <?php if(get_field('active_4')): ?>
            <?php get_template_part('parts/elements/instagram'); ?>
        <?php endif; ?>
    </main>

    <?php get_template_part('parts/_footer'); ?>

    <?php get_template_part('parts/_popups'); ?>

    <?php if(get_field('active_3')): ?>
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