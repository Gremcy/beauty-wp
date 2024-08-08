<?php if (!defined('ABSPATH')){exit;} ?>

<header class="header js-header">
    <div class="header__inner">
        <div class="header__container">
            <div class="header__wrapper">
                <svg class="header__search-icon_mobile js-modal-link" data-target="search-mobile" width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.9838 23.0002L17.3557 18.3721" stroke-width="1.15703" stroke-linecap="round" stroke-linejoin="round" /><circle cx="10.4133" cy="10.4133" r="9.83479" stroke-width="1.15703" /></svg>
                <form class="header__search-wrapper search_form" action="<?php echo \PS\Functions\Plugins\Qtranslate::current_site_url(); ?>" method="GET">
                    <div class="header-search-result search-ajax-results"></div>
                    <input type="text" class="header__search-input search-ajax" placeholder="<?php _e( 'Search', \PS::$theme_name ); ?>" name="s" maxlength="50" autocomplete="off" />
                    <svg class="header__search-icon" width="23" height="24" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M21.9838 23.0002L17.3557 18.3721" stroke-width="1.15703" stroke-linecap="round" stroke-linejoin="round" /><circle cx="10.4133" cy="10.4133" r="9.83479" stroke-width="1.15703" /></svg>
                </form>
            </div>

            <div class="header__wrapper">
                <a href="<?php echo get_the_permalink(\PS::$front_page); ?>" class="header__logo">
                    <svg width="212" height="50" viewBox="0 0 212 50" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_745_28)"><path d="M21.4685 36.4379C23.543 37.7586 25.975 38.4376 28.4486 38.3866C32.1417 38.3866 35.1634 37.1631 37.5136 34.7162C39.8637 32.2692 41.0388 29.046 41.0388 25.0467C41.0388 21.021 39.8637 17.7749 37.5136 15.3082C35.1634 12.8415 32.1317 11.6098 28.4184 11.613C24.7252 11.613 21.6935 12.825 19.3231 15.249C16.9528 17.6729 15.7777 21.0375 15.7979 25.3427C15.8161 27.4371 16.2667 29.5062 17.1224 31.4256C18.0245 33.4859 19.5389 35.2325 21.4685 36.4379ZM22.0174 17.1532C22.8528 16.3052 23.859 15.6367 24.9722 15.1899C26.0854 14.7432 27.2813 14.5281 28.4838 14.5583C29.7036 14.5241 30.9159 14.754 32.0345 15.2316C33.1531 15.7091 34.1504 16.4225 34.9552 17.321C36.6339 19.1595 37.4733 21.7282 37.4733 25.027C37.4733 28.2731 36.6339 30.8237 34.9552 32.6787C34.1434 33.5894 33.1345 34.3112 32.0019 34.7917C30.8694 35.2722 29.6417 35.4992 28.4083 35.4562C27.1706 35.5026 25.9382 35.2732 24.8041 34.7852C23.6701 34.2973 22.6639 33.5635 21.8614 32.6392C20.2297 30.7645 19.4138 28.3504 19.4138 25.397C19.4205 21.6278 20.2884 18.8799 22.0174 17.1532Z"/><path d="M58.1069 17.6072L71.9813 37.9377H75.567V12.062H72.213V32.3777L58.3385 12.062H54.7528V37.9377H58.1069V17.6072Z"/><path d="M130.46 12.062H126.965V37.9377H130.46V12.062Z"/><path d="M154.603 15.8065H155.268C156.94 20.3896 163.698 37.9377 163.698 37.9377H167.682L156.869 12.062H153.107L142.96 37.9377H146.671C146.671 37.9377 153.092 20.4587 154.603 15.8065Z"/><path d="M196.176 34.8839H183.173V12.062H179.673V37.9377H196.176V34.8839Z"/><path d="M94.7342 28.061V14.9233H103.094C105.224 14.9233 106.695 15.3476 107.521 16.2011C107.916 16.5903 108.228 17.0523 108.44 17.5603C108.652 18.0683 108.759 18.6124 108.755 19.1611C108.793 19.7946 108.664 20.4271 108.38 20.9975C108.096 21.5679 107.666 22.0568 107.133 22.4172C106.05 23.1374 104.424 23.5025 102.248 23.5025H100.284V26.4625L109.304 37.9524H113.7L103.94 26.2504C106.378 25.9544 109.203 25.1108 110.487 23.8478C111.11 23.2276 111.598 22.4906 111.922 21.681C112.247 20.8714 112.401 20.0059 112.376 19.1364C112.412 17.6407 111.962 16.1724 111.091 14.9431C110.337 13.8403 109.222 13.0224 107.929 12.6244C106.311 12.2159 104.643 12.0315 102.973 12.0768H91.2593V37.9524H94.7544L94.7342 28.061Z"/><path d="M0 0V50H212.02V0H0ZM208.782 46.8673H3.208V3.1475H208.782V46.8673Z"/></g><defs><clipPath id="clip0_745_28"><rect width="212" height="50" fill="white"/></clipPath></defs></svg>
                </a>
            </div>

            <div class="header__wrapper">
                <div class="header__burger burger js-burger">
                    <span></span>
                </div>
                <ul class="panel__list">
                    <?php $languages = \PS\Functions\Plugins\Qtranslate::get_languages(); if(is_array($languages) && count($languages) > 1): ?>
                        <li class="panel__item language">
                            <span>
                                <svg class="lang" width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.58989 7.64118C8.79615 2.45871 11.2174 1.38648 12.5602 1.38647C15.3524 1.38647 16.9719 5.38875 17.5304 7.64118C18.826 12.0195 17.8655 16.9674 17.0836 19.1453C16.3576 20.9324 15.2407 23.5013 12.5602 23.5013C10.2705 23.5013 8.63233 20.6159 8.0925 19.1453C7.42235 17.47 6.38363 12.8236 7.58989 7.64118Z" stroke="white" stroke-width="1"/><path d="M12.5601 1.38647V23.3338" stroke="white"/><path d="M1.67041 12.3882H23.6177" stroke="white"/><path d="M5.5791 3.67627C6.97524 4.29057 10.5605 5.00539 12.6156 4.96072C14.6708 4.91604 18.0327 4.34642 19.5405 3.67627" stroke="white" stroke-width="1"/><path d="M5.52344 21.2677C6.91958 20.4859 10.449 19.8381 12.5041 19.9275C15.3522 20.0513 17.4744 20.3184 19.3731 21.2677" stroke="white" stroke-width="1"/><path d="M23.775 12.4999C23.775 18.7262 18.7523 23.7708 12.56 23.7708C6.3677 23.7708 1.345 18.7262 1.345 12.4999C1.345 6.2736 6.3677 1.22903 12.56 1.22903C18.7523 1.22903 23.775 6.2736 23.775 12.4999Z" stroke="white" stroke-width="1"/></svg>
                                <ul class="panel__language-list language__list">
                                    <?php foreach ($languages as $m => $language): ?>
                                        <li class="language__item">
                                            <a href="<?php echo $language['url']; ?>"><?php echo $language['name']; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </span>
                        </li>
                    <?php endif; ?>
                    
                    <li class="panel__item">
                        <a href="<?= get_permalink (is_user_logged_in() ? \PS::$profile_favourite_page : \PS::$login_page) ?>">
                            <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.72 3.2C6.131 3.2 1.6 7.79 1.6 13.454 1.6 23.71 13.56 33.031 20 35.2c6.44-2.169 18.4-11.49 18.4-21.746C38.4 7.791 33.87 3.2 28.28 3.2c-3.422 0-6.45 1.722-8.28 4.357a10.15 10.15 0 0 0-3.614-3.204A10.001 10.001 0 0 0 11.72 3.2Z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                        </a>
                        <span class="panel__item-like js-like-counter"><?= PS\Functions\Helper\Helper::count_favorite_ids() ?></span>
                    </li>


                    <?php if(!is_checkout()): ?>
                        <li class="panel__item js-modal-link" data-target="cart-popup">
                            <a href="javascript:void(0)">
                                <svg fill="none" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"><path d="M4.754 14.453a3.84 3.84 0 0 1 3.829-3.533h23.151a3.84 3.84 0 0 1 3.828 3.533l1.542 19.2a3.839 3.839 0 0 1-3.826 4.147H7.038a3.841 3.841 0 0 1-3.826-4.147l1.542-19.2v0Z" stroke-width="1.92" stroke-linecap="round" stroke-linejoin="round" /><path d="M27.837 17V8.68a7.68 7.68 0 1 0-15.36 0V17" stroke-width="1.92" stroke-linecap="round" stroke-linejoin="round" /></svg>
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
            </div>
        </div>

        <?php $header_menu = get_field('header_menu', \PS::$option_page); if(is_array($header_menu) && count($header_menu)): ?>
            <div class="header__menu">
                <nav class="menu-main">
                    <ul class="menu-main__list">
                        <?php foreach ($header_menu as $li): ?>
                            <?php if($li['submenu_active']): ?>
                                <li class="menu-main__item">
                                    <div class="menu-main__item-wrapper">
                                        <span href="<?php echo $li['link']; ?>" class="menu__link"><?php echo __($li['text']); ?></span>
                                        <svg width="12" height="8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 1 6.99 7H5.355L1 1" /></svg>
                                    </div>
                                    <?php if(is_array($li['submenu']) && count($li['submenu'])): ?>
                                        <ul class="menu-main__item-subitem subitem__list">
                                            <?php foreach ($li['submenu'] as $sub_li): ?>
                                                <li class="subitem__item">
                                                    <a href="<?php echo $sub_li['link']; ?>"><?php echo __($sub_li['text']); ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php else: ?>
                                <li class="menu-main__item">
                                    <a href="<?php echo $li['link']; ?>" class="menu-main__link"><?php echo __($li['text']); ?></a>
                                </li>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>
</header>