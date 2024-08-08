<?php if (!defined('ABSPATH')){exit;} ?>

<div class="mobile-menu js-mob-menu">
    <div class="mobile-menu__inner">
        <nav class="menu mobile-menu__nav">
            <ul class="panel__list">
                <?php $languages = \PS\Functions\Plugins\Qtranslate::get_languages(); if(is_array($languages) && count($languages) > 1): ?>
                    <li class="panel__item language">
                        <svg class="lang" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.58989 7.64118C8.79615 2.45871 11.2174 1.38648 12.5602 1.38647C15.3524 1.38647 16.9719 5.38875 17.5304 7.64118C18.826 12.0195 17.8655 16.9674 17.0836 19.1453C16.3576 20.9324 15.2407 23.5013 12.5602 23.5013C10.2705 23.5013 8.63233 20.6159 8.0925 19.1453C7.42235 17.47 6.38363 12.8236 7.58989 7.64118Z" stroke="white" stroke-width="0.7"/><path d="M12.5601 1.38647V23.3338" stroke="white"/><path d="M1.67041 12.3882H23.6177" stroke="white"/><path d="M5.5791 3.67627C6.97524 4.29057 10.5605 5.00539 12.6156 4.96072C14.6708 4.91604 18.0327 4.34642 19.5405 3.67627" stroke="white" stroke-width="0.7"/><path d="M5.52344 21.2677C6.91958 20.4859 10.449 19.8381 12.5041 19.9275C15.3522 20.0513 17.4744 20.3184 19.3731 21.2677" stroke="white" stroke-width="0.7"/><path d="M23.775 12.4999C23.775 18.7262 18.7523 23.7708 12.56 23.7708C6.3677 23.7708 1.345 18.7262 1.345 12.4999C1.345 6.2736 6.3677 1.22903 12.56 1.22903C18.7523 1.22903 23.775 6.2736 23.775 12.4999Z" stroke="white" stroke-width="0.69"/></svg>
                        <ul class="panel__language-list language__list">
                            <?php foreach ($languages as $m => $language): ?>
                                <li class="language__item">
                                    <a href="<?php echo $language['url']; ?>"><?php echo $language['name']; ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <li class="panel__item">
                    <a href="<?= get_permalink (is_user_logged_in() ? \PS::$profile_favourite_page : \PS::$login_page) ?>">
                        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.72 3.2C6.131 3.2 1.6 7.79 1.6 13.454 1.6 23.71 13.56 33.031 20 35.2c6.44-2.169 18.4-11.49 18.4-21.746C38.4 7.791 33.87 3.2 28.28 3.2c-3.422 0-6.45 1.722-8.28 4.357a10.15 10.15 0 0 0-3.614-3.204A10.001 10.001 0 0 0 11.72 3.2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                    <span class="panel__item-like js-like-counter"><?= PS\Functions\Helper\Helper::count_favorite_ids() ?></span>
                </li>

                <?php if(!is_checkout()): ?>
                    <li class="panel__item js-modal-link" data-target="cart-popup">
                        <a href="javascript:void(0)">
                            <svg fill="none" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><path d="M4.754 14.453a3.84 3.84 0 0 1 3.829-3.533h23.151a3.84 3.84 0 0 1 3.828 3.533l1.542 19.2a3.839 3.839 0 0 1-3.826 4.147H7.038a3.841 3.841 0 0 1-3.826-4.147l1.542-19.2v0Z" stroke-width="1.92" stroke-linecap="round" stroke-linejoin="round"/><path d="M27.837 17V8.68a7.68 7.68 0 1 0-15.36 0V17" stroke-width="1.92" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                        <span class="panel__item-bag js-bag-counter ajax-quantity"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </li>
                <?php endif; ?>

                <li class="panel__item">
                    <a href="<?= get_permalink(\PS::$profile_info_page ) ?>">
                        <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="12.4158" cy="10.2195" r="4.04527" stroke="white" stroke-width="1.2"/><path d="M4.22314 19.7635C5.37742 18.7781 9.15558 16.8581 13.0069 17.0608C16.8583 17.2635 19.7918 18.947 20.7772 19.7635" stroke="white" stroke-width="1.2"/><circle cx="12.4247" cy="12.4979" r="11.0576" stroke="white" stroke-width="1.2"/></svg>
                    </a>
                </li>
            </ul>

            <?php $header_menu = get_field('header_menu', \PS::$option_page); if(is_array($header_menu) && count($header_menu)): ?>
                <ul class="menu__list">
                    <?php foreach ($header_menu as $li): ?>
                        <?php if($li['submenu_active']): ?>
                            <li class="menu__item">
                                <div class="menu__item-wrapper">
                                    <span href="<?php echo $li['link']; ?>" class="menu__link"><?php echo __($li['text']); ?></span>
                                    <svg width="12" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 1 6.99 7H5.355L1 1" /></svg>
                                </div>
                                <?php if(is_array($li['submenu']) && count($li['submenu'])): ?>
                                    <ul class="menu__item-subitem subitem__list">
                                        <?php foreach ($li['submenu'] as $sub_li): ?>
                                            <li class="subitem__item">
                                                <a href="<?php echo $sub_li['link']; ?>"><?php echo __($sub_li['text']); ?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php else: ?>
                            <li class="menu__item">
                                <a href="<?php echo $li['link']; ?>" class="menu__link"><?php echo __($li['text']); ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </nav>
    </div>
</div>

<?php if(!is_cart() && !is_checkout()): ?>
    <div class="modal modal--sm js-modal" data-modal="cart-popup">
        <div class="modal__overlay js-close-modal"></div>
        <div class="cart-popup-content">
            <div class="cart-popup-close js-close-modal">
                <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M31.4285 31.4633C30.6471 32.2449 29.38 32.2452 28.5984 31.4638C28.5982 31.4636 28.598 31.4634 28.5978 31.4633L15.9978 18.8632L3.40939 31.4523C2.62356 32.2298 1.35624 32.2231 0.578739 31.4373C-0.192932 30.6573 -0.19291 29.4016 0.578788 28.6216L13.1676 16.0329L0.581087 3.44645C-0.189185 2.65361 -0.170894 1.38647 0.62194 0.616197C1.39854 -0.138304 2.63435 -0.138413 3.41109 0.615951L15.9981 13.2024L28.5956 0.60495C29.3669 -0.18689 30.6341 -0.203545 31.4259 0.567749C32.2177 1.33904 32.2344 2.60621 31.4631 3.39805C31.4508 3.41071 31.4383 3.42321 31.4256 3.43554L18.8288 16.0329L31.4288 28.6329C32.2103 29.4143 32.2103 30.6813 31.4289 31.4628C31.4288 31.4629 31.4286 31.4631 31.4285 31.4632L31.4285 31.4633Z" fill="white" /></svg>
            </div>
            <div class="ajax-minicart"><?php woocommerce_mini_cart(); ?></div>
        </div>
    </div>
<?php endif; ?>

<div class="modal modal--sm js-modal" data-modal="fill-out-form-popup">
    <div class="modal__overlay js-close-modal"></div>

    <div class="fill-out-form-content">
        <div class="fill-out-form-close js-close-modal">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
        </div>
        <?php get_template_part('parts/forms/coupons'); ?>
    </div>
</div>

<div class="modal modal--sm js-modal" data-modal="promocode-popup">
    <div class="modal__overlay js-close-modal"></div>

    <div class="promocode-content">
        <div class="fill-out-form-close js-close-modal">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
        </div>
        <div class="promocode-title"><?php _e( 'Your coupon', \PS::$theme_name ); ?></div>
        <div class="promocode-number ajax-show-coupon"></div>
        <div class="promocode-use"><?php _e( 'Copy code', \PS::$theme_name ); ?></div>
        <div class="promocode-back js-modal-link" data-target="cart-popup"><?php _e( 'Back', \PS::$theme_name ); ?></div>
    </div>
</div>

<div class="modal modal--sm js-modal" data-modal="hello-popup">
    <div class="modal__overlay js-close-modal"></div>

    <div class="hello-content">
        <div class="fill-out-form-close js-close-modal">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
        </div>

        <div class="hello-popup-text">
            <p><?php _e( 'Hello!', \PS::$theme_name ); ?></p>
            <p><?php _e( 'Thank you for your interest but you have already got the discount.', \PS::$theme_name ); ?> <?php _e( 'Follow our news on the website, there will be discounts more than once.', \PS::$theme_name ); ?></p>
        </div>
        <div class="hello-popup-btn js-close-modal"><?php _e( 'Back', \PS::$theme_name ); ?></div>
    </div>
</div>

<div class="modal modal--sm js-modal search-mobile" data-modal="search-mobile">
    <div class="modal__overlay js-close-modal"></div>

    <form class="search-mobile-content search_form" action="<?php echo \PS\Functions\Plugins\Qtranslate::current_site_url(); ?>" method="GET">
        <div class="search-mobile-input">
            <img src="<?php echo \PS::$assets_url; ?>images/icon18.svg" alt="">
            <input type="text" class="header__search-input search-ajax" placeholder="<?php _e( 'Search', \PS::$theme_name ); ?>" name="s" maxlength="50" autocomplete="off" />
        </div>
        <div class="search-mobile-result">
            <div class="header-search-result search-ajax-results"></div>
        </div>
    </form>
</div>

<div class="modal modal--sm js-modal" data-modal="check-email-popup">
    <div class="modal__overlay js-close-modal"></div>
    <div class="thanks-popup-content">
        <div class="fill-out-form-close js-close-modal">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
        </div>
        <div class="thanks-popup-icon">
            <img src="<?php echo \PS::$assets_url; ?>images/check-icon.svg" alt="">
        </div>
        <div class="thanks-popup-title"><?php _e( 'check your e-mail', \PS::$theme_name ); ?></div>
        <div class="thanks-popup-description"><?php _e( 'We sent you a new temporary password', \PS::$theme_name ); ?></div>
    </div>
</div>

<?php if(!isset($_COOKIE['hide-cookies-banner']) && !is_page(\PS::$privacy_page)): ?>
    <div class="modal modal--sm js-modal" data-modal="cookies-popup">
        <div class="modal__overlay js-close-modal"></div>
        <div class="cookies-popup-content">
            <div class="cookies-title"><?php _e(get_field('cookies_title', \PS::$option_page)); ?></div>
            <a href="<?php echo get_the_permalink(\PS::$privacy_page); ?>" class="cookies-decline-btn" target="_blank"><?php echo get_the_title(\PS::$privacy_page); ?></a>
            <div class="cookies-text"><?php _e(get_field('cookies_text', \PS::$option_page)); ?></div>
            <div class="cookies-bottom">
                <div class="cookies-bottom-settings-btn cookies-accept-button js-close-modal"><?php _e( 'Accept', \PS::$theme_name ); ?></div>
                <div class="cookies-bottom-accsept-btn js-modal-link" data-target="cookies-preference-popup"><?php _e( 'Manage my preferences', \PS::$theme_name ); ?></div>
            </div>
        </div>
    </div>

    <div class="modal modal--sm js-modal" data-modal="cookies-preference-popup">
        <div class="modal__overlay js-close-modal"></div>
        <div class="cookies-preference-content">
            <div class="fill-out-form-close js-close-modal">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_491_6576)"><path fill-rule="evenodd" clip-rule="evenodd" d="M24.5424 24.5589C23.932 25.1696 22.942 25.1698 22.3314 24.5594C22.3312 24.5592 22.3311 24.5591 22.3309 24.5589L12.4872 14.7152L2.65248 24.5504C2.03855 25.1578 1.04845 25.1526 0.441031 24.5386C-0.161837 23.9293 -0.16182 22.9482 0.44107 22.3389L10.2761 12.504L0.442866 2.67081C-0.158909 2.05141 -0.144619 1.06145 0.474782 0.459676C1.0815 -0.129778 2.04698 -0.129863 2.65381 0.459483L12.4874 10.2926L22.3292 0.450888C22.9318 -0.167737 23.9217 -0.180748 24.5404 0.421825C25.159 1.0244 25.172 2.01437 24.5694 2.633C24.5598 2.64289 24.55 2.65266 24.5401 2.66229L14.6989 12.504L24.5426 22.3478C25.1532 22.9582 25.1532 23.948 24.5428 24.5586C24.5426 24.5587 24.5425 24.5588 24.5424 24.5589L24.5424 24.5589Z" fill="#CB94D3" /></g><defs><clipPath id="clip0_491_6576"><rect width="25" height="25" fill="white" /></clipPath></defs></svg>
            </div>
            <?php $cookies_settings_text = get_field('cookies_settings_text', \PS::$option_page); if($cookies_settings_text['title'] || $cookies_settings_text['text']): ?>
                <div class="cookies-preference-title"><?php echo __($cookies_settings_text['title']); ?></div>
                <div class="cookies-preference-text"><?php echo __($cookies_settings_text['text']); ?></div>
            <?php endif; ?>
            <?php $cookies_settings = get_field('cookies_settings', \PS::$option_page); if(is_array($cookies_settings['settings']) || count($cookies_settings['settings'])): ?>
                <div class="cookies-preference-title"><?php echo __($cookies_settings['title']); ?></div>
                <?php foreach ($cookies_settings['settings'] as $m => $checkbox): ?>
                    <div class="cookies-preferences-checking<?php if($m + 1 === count($cookies_settings['settings'])): ?> bottom<?php endif; ?>">
                        <div class="cookies-preferences-cheking-title"><?php echo __($checkbox['title']); ?></div>
                        <div class="cookies-preferences-cheking-check">
                            <?php if($checkbox['checkbox']): ?>
                                <input type="checkbox" id="highload<?php echo $m + 1; ?>" name="highload<?php echo $m + 1; ?>"<?php if($checkbox['checkbox_active']): ?> checked<?php endif; ?>>
                                <label for="highload<?php echo $m + 1; ?>" data-onlabel="<?php _e( 'Active', \PS::$theme_name ); ?>" data-offlabel="<?php _e( 'Inactive', \PS::$theme_name ); ?>" class="lb<?php echo $m + 1; ?>"></label>
                            <?php else: ?>
                                <?php _e( 'Always Active', \PS::$theme_name ); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="cookies-preference-text"><?php echo __($checkbox['text']); ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
            <div class="cookies-preference-btn-wr">
                <div class="cookies-preference-btn js-close-modal cookies-accept-button"><?php _e( 'Save my preferences', \PS::$theme_name ); ?></div>
            </div>
        </div>
    </div>
<?php endif; ?>