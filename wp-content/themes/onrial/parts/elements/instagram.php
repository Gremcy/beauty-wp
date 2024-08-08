<?php if (!defined('ABSPATH')){exit;} ?>

<section class="follow">
    <div class="follow__container">
        <?php $instagram_title = get_field('instagram_title', \PS::$option_page); if($instagram_title): ?>
            <p class="follow__title"><?php echo __($instagram_title); ?></p>
        <?php endif; ?>
        <?php $in = get_field('in', \PS::$contacts_page); if($in): ?>
            <a href="<?php echo $in; ?>" class="follow__button_arrow button_arrow" target="_blank">
                @<?php echo mb_strtoupper(str_ireplace(['https://www.instagram.com', 'https://instagram.com', '/'], '', $in)); ?>
                <svg class="button_arrow__icon" width="46" height="16" viewBox="0 0 46 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8L45 8" stroke="#424242" /><path d="M35.8856 0.5L44.9995 6.81579V9.18421L35.8856 15.5" stroke="#424242" /></svg>
                <svg class="button_arrow__icon-mobile" width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 9L24.887 9" stroke="#424242" /><path d="M16.0408 1L25.0001 7.73684V10.2632L16.0408 17" stroke="#424242" /></svg>
            </a>
        <?php endif; ?>
    </div>
    <?php $instagram_imgs = get_field('instagram_imgs', \PS::$option_page); if(is_array($instagram_imgs) && count($instagram_imgs)): ?>
        <div class="follow-slider__slider-container">
            <div class="follow-slider__slider swiper js_follow-slider">
                <ul class="follow-slider__list swiper-wrapper">
                    <?php foreach ($instagram_imgs as $img): ?>
                        <li class="follow-slider__item swiper-slide">
                            <?php if($img['link']): ?><a href="<?php echo $img['link']; ?>" target="_blank"><?php endif; ?>
                            <img src="<?php echo $img['img']['sizes']['960x0']; ?>" alt="" class="follow-slider__image" />
                            <?php if($img['link']): ?></a><?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</section>