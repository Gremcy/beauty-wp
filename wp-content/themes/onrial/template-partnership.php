<?php /* Template Name: Partnership */ ?>
<?php get_header(); ?>

<body class="partnership-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="partnership-page">
        <?php if(get_field('active_1')): ?>
            <section class="partnership-top top-section"<?php $img_1 = get_field('img_1'); if(is_array($img_1) && count($img_1)): ?> style="background: url('<?php echo $img_1['sizes']['1600x0']; ?>') no-repeat center/cover;"<?php endif; ?>>
                <div class="top-section__container">
                    <?php $title_1 = get_field('title_1'); if($title_1): ?><h1><?php echo $title_1; ?></h1><?php endif; ?>
                    <?php $text_1 = get_field('text_1'); if($text_1): ?><h2><?php echo $text_1; ?></h2><?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_2')): ?>
            <section class="partnership-connect">
                <div class="partnership-connect__container">
                    <?php $text_2 = get_field('text_2'); if($text_2): ?>
                        <div class="partnership-connect__wrapper">
                            <?php echo str_ireplace(
                                ['<p>'],
                                ['<p class="partnership-connect__subtitle">'],
                                $text_2
                            ); ?>
                        </div>
                    <?php endif; ?>
                    <?php get_template_part('parts/forms/partner', null, ['page' => 'partnership']); ?>
                    <div class="partnership-connect__thanks">
                        <img src="<?php echo \PS::$assets_url; ?>images/partnership-page/partnership__icon.png" alt="" class="partnership-connect__icon"/>
                        <?php $form_partner_success_title = get_field('form_partner_success_title', \PS::$option_page); if($form_partner_success_title): ?>
                            <p class="partnership-connect__title"><?php echo __($form_partner_success_title); ?></p>
                        <?php endif; ?>
                        <?php $form_partner_success_text = get_field('form_partner_success_text', \PS::$option_page); if($form_partner_success_text): ?>
                            <p class="partnership-connect__description"><?php echo __($form_partner_success_text); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_3')): ?>
            <section class="partnership-terms">
                <div class="partnership-terms__container">
                    <?php $title_3 = get_field('title_3'); if($title_3): ?><p class="partnership-terms__title"><?php echo $title_3; ?></p><?php endif; ?>

                    <?php $list_3 = get_field('list_3'); if(is_array($list_3['list']) && count($list_3['list'])): ?>
                        <?php $lines = array_chunk($list_3['list'], ceil(count($list_3['list']) / 2)); if(count($lines)): ?>
                            <div class="partnership-terms__wrapper">
                                <ul class="partnership-terms__list">
                                    <?php foreach ($lines as $line): ?>
                                        <li class="partnership-terms__item">
                                            <div class="partnership-terms__discount">
                                                <div class="partnership-terms__discount-header">
                                                    <p class="partnership-terms__discount-title"><?php echo $list_3['title_1']; ?></p>
                                                </div>
                                                <div class="partnership-terms__discount-inner">
                                                    <?php foreach ($line as $li): ?>
                                                        <p class="partnership-terms__discount-percent"><?php echo $li['text_1']; ?></p>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="partnership-terms__order">
                                                <div class="partnership-terms__order-header">
                                                    <p class="partnership-terms__order-title"><?php echo $list_3['title_2']; ?></p>
                                                </div>
                                                <div class="partnership-terms__order-inner">
                                                    <?php foreach ($line as $li): ?>
                                                        <p class="partnership-terms__order-price"><?php echo $li['text_2']; ?></p>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php $notice_3 = get_field('notice_3'); if($notice_3): ?><p class="partnership-terms__description"><?php echo $notice_3; ?></p><?php endif; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if(get_field('active_4')): ?>
            <?php $list_4 = get_field('list_4'); if(is_array($list_4) && count($list_4)): ?>
                <section class="partnership-warehouse">
                    <div class="partnership-warehouse-new-container">
                        <?php foreach ($list_4 as $li): ?>
                            <div class="partnership-warehouse-new-item">
                                <div class="partnership-warehouse-new-item-circle"></div>
                                <div class="partnership-warehouse-new-item-text"><?php echo $li['text']; ?></div>
                                <?php if($li['notice']): ?><div class="partnership-warehouse-new-item-small-text"><?php echo $li['notice']; ?></div><?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('active_5')): ?>
            <?php $product_cats = \PS\Functions\Plugins\Woocommerce::get_product_cats(); if(is_array($product_cats) && count($product_cats)): ?>
                <section class="partnership-catalog catalog">
                    <div class="container">
                        <ul class="catalog__list">
                            <?php foreach ($product_cats as $cat): ?>
                                <li class="catalog__item">
                                    <a class="catalog__link" href="<?php echo get_term_link( $cat['category']->term_id, 'product_cat' ); ?>"><?php echo $cat['category']->name; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(get_field('active_6')): ?>
            <section class="partnership-holds">
                <div class="partnership-holds__container">
                    <?php $img_6 = get_field('img_6'); if(is_array($img_6['img_1']) && count($img_6['img_1'])): ?>
                        <picture>
                            <source srcset="<?php echo $img_6['img_1']['sizes']['960x0']; ?>" media="(min-width: 1200px)"/>
                            <?php if(is_array($img_6['img_2']) && count($img_6['img_2'])): ?>
                                <img src="<?php echo $img_6['img_2']['sizes']['960x0']; ?>" alt="" class="partnership-holds__image"/>
                            <?php endif; ?>
                        </picture>
                    <?php endif; ?>
                    <div class="partnership-holds__inner">
                        <?php $title_6 = get_field('title_6'); if($title_6): ?><p class="partnership-holds__title"><?php echo $title_6; ?></p><?php endif; ?>
                        <?php $text_6 = get_field('text_6'); if($text_6): ?>
                            <?php echo str_ireplace(
                                ['<p>', '<ul>', '<li>'],
                                ['<p class="partnership-holds__description">', '<ul class="partnership-holds__list">', '<li class="partnership-holds__item">'],
                                $text_6
                            ); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
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