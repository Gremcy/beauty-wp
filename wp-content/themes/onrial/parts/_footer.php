<?php if (!defined('ABSPATH')){exit;} ?>

<footer class="footer">
    <div class="footer-centered">
        <div class="footer-left">
            <a href="<?php echo get_the_permalink(\PS::$front_page); ?>" class="footer-logo">
                <img src="<?php echo \PS::$assets_url; ?>images/footer/logo.svg" alt="">
            </a>
            <div class="footer-catalog-menu">
                <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>" class="footer-catalog-menu-heading-link"><?php echo get_the_title(\PS::$shop_page); ?></a>
                <?php $product_cats = \PS\Functions\Plugins\Woocommerce::get_product_cats(); if(is_array($product_cats) && count($product_cats)): ?>
                    <?php foreach ($product_cats as $cat): ?>
                        <a href="<?php echo get_term_link( $cat['category']->term_id, 'product_cat' ); ?>" class="footer-catalog-menu-link"><?php echo $cat['category']->name; ?></a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="footer-right">
            <?php $footer_menu = get_field('footer_menu', \PS::$option_page); if(is_array($footer_menu) && count($footer_menu)): ?>
                <div class="footer-right-menu">
                    <?php foreach ($footer_menu as $li): ?>
                        <a href="<?php echo $li['link']; ?>" class="footer-right-menu-item"><?php echo __($li['text']); ?></a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <div class="footer-right-contacts">
                <div class="footer-right-contacts-title"><?php _e( 'Contacts', \PS::$theme_name ); ?></div>
                <div class="footer-right-contacts-social">
                    <?php $fb = get_field('fb', \PS::$contacts_page); if($fb): ?>
                        <a href="<?php echo $fb; ?>" class="footer-right-contacts-social-item" target="_blank">
                            <img src="<?php echo \PS::$assets_url; ?>images/facebook2.svg" alt="">
                        </a>
                    <?php endif; ?>
                    <?php $in = get_field('in', \PS::$contacts_page); if($in): ?>
                        <a href="<?php echo $in; ?>" class="footer-right-contacts-social-item" target="_blank">
                            <img src="<?php echo \PS::$assets_url; ?>images/insta2.svg" alt="">
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</footer>