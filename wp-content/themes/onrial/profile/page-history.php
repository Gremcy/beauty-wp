<?php /* Template Name: Profile history Page */ 

if( !is_user_logged_in() )
    wp_redirect(get_permalink(\PS::$login_page));

$args = array(
    'customer_id' => get_current_user_id(),
    'limit' => -1, // to retrieve _all_ orders by this user
);
$orders = wc_get_orders($args);

get_header(); ?>

<body class="profile-history-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="profile-history">
        <div class="pagination">
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="/"><?= __( 'Home', \PS::$theme_name ); ?></a>
                </li>
                <li class="pagination__item">
                    <a href="<?= get_permalink(\PS::$profile_history_page) ?>">Shopping history</a>
                </li>
            </ul>
        </div>

        <div class="profile-logout-fluid">
            <div class="profile-logout-centered">  
                <a href="<?php echo wp_logout_url( home_url() ); ?>" class="profile-logout-btn">
                    <?= __( 'Log out', \PS::$theme_name ); ?>
                </div>
            </div>
        </div>

        <div class="profile-tabs-fluid">
            <div class="profile-tabs-centered">
                <a href="<?= get_permalink(\PS::$profile_info_page) ?>" class="profile-tabs-item">
                    <?= __( 'Profile info', \PS::$theme_name ); ?>
                </a>
                <a href="<?= get_permalink(\PS::$profile_favourite_page) ?>" class="profile-tabs-item">
                    <?= __( 'favourite', \PS::$theme_name ); ?>
                </a>
                <a href="<?= get_permalink(\PS::$profile_history_page) ?>" class="profile-tabs-item active">
                    <?= __( 'shopping history', \PS::$theme_name ); ?>
                </a>
            </div>
        </div>

        <div class="profile-history-container-fluid">
            <div class="profile-history-container-centered">
                <? foreach($orders as $order) : ?>
                    <div class="profile-history-item">
                        <div class="profile-history-item-name">
                            <?= __( 'ORDER', \PS::$theme_name ); ?> #<?= $order->get_id() ?>
                        </div>
                        <div class="profile-history-item-top">
                            <div class="profile-history-item-top-images">
                                <? foreach(array_slice($order->get_items(), 0, 4) as $i => $item) : 
                                    $product = wc_get_product( $item['product_id'] ); ?>
                                    <div class="profile-history-item-top-images-img <?= $i === 3 ? 'overlay' : '' ?>">
                                        <div class="profile-history-item-top-images-overlay"></div>
                                        <? if(count($order->get_items()) > 4) : ?>
                                            <div class="profile-history-item-top-images-num">+<?= count($order->get_items())-4 ?></div>
                                        <? endif ?>
                                        <img src="<?= $product->get_image() ?>" alt="img">
                                    </div>
                                <? endforeach ?>
                            </div>
                            <div class="profile-history-item-top-right">
                                <div class="profile-history-item-top-right-up">
                                    <div class="profile-history-item-top-right-up-date">
                                        <span><?= __( 'Date of order:', \PS::$theme_name ); ?> </span> <?= $order->get_date_created()->date('j M Y, H:i') ?> 
                                    </div>
                                    <div class="profile-history-item-top-right-up-info">
                                        <div class="profile-history-item-top-right-up-info-icon">
                                            <img src="<?php echo \PS::$assets_url; ?>images/icon16.svg" alt="img">
                                            <div class="profile-history-item-top-right-up-info-tip">
                                            <img src="<?php echo \PS::$assets_url; ?>images/icon16.svg" alt="img">
                                            <span>
                                            <?= __( 'product availability
                                                and prices are subject
                                                to change.', \PS::$theme_name ); ?>
                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="<?= wp_nonce_url( add_query_arg( 'order_again', $order->get_id(), wc_get_cart_url()) , 'woocommerce-order_again' ) ?>" class="profile-history-item-top-right-order-again">
                                    <?= __( 'Order again', \PS::$theme_name ); ?>
                                </a>
                            </div>
                        </div>
                        <div class="profile-history-item-detalis-btn">
                            <span><?= __( 'order details', \PS::$theme_name ); ?></span>
                            <img src="<?php echo \PS::$assets_url; ?>images/icon17.svg" alt="img">
                        </div>
                        <div class="profile-history-item-drop">
                            <div class="profile-history-item-drop-item">
                            <div class="profile-history-item-drop-item-left">
                                <?= __( 'Total items:', \PS::$theme_name ); ?>
                            </div>
                            <div class="profile-history-item-drop-item-right">
                                <?= $order->get_item_count() ?>
                            </div>
                            </div>
                            <div class="profile-history-item-drop-item">
                            <div class="profile-history-item-drop-item-left">
                                <?= __( 'Total:', \PS::$theme_name ); ?>
                            </div>
                            <div class="profile-history-item-drop-item-right">
                               <?= $order->get_order_currency() ?> <?= $order->get_total() ?>
                            </div>
                            </div>
                            <div class="profile-history-item-drop-item">
                            <div class="profile-history-item-drop-item-left">
                                <?= __( 'Selected type of delivery', \PS::$theme_name ); ?>
                            </div>
                            <div class="profile-history-item-drop-item-right">
                                <?= $order->get_shipping_method() ?>
                            </div>
                            </div>
                            <div class="profile-history-item-drop-item">
                            <div class="profile-history-item-drop-item-left">
                                <?= __( 'Delivery address', \PS::$theme_name ); ?>
                            </div>
                            <div class="profile-history-item-drop-item-right">
                                <?= $order->get_formatted_shipping_address() ?>
                            </div>
                            </div>
                            <div class="profile-history-item-drop-item">
                            <div class="profile-history-item-drop-item-left">
                                <?= __( 'Selected payment method', \PS::$theme_name ); ?>
                            </div>
                            <div class="profile-history-item-drop-item-right">
                                <?= $order->get_payment_method_title() ?>
                            </div>
                            </div>
                            <div class="profile-history-item-drop-item">
                            <div class="profile-history-item-drop-item-left">
                                <?= __( 'Comment to your order', \PS::$theme_name ); ?>
                            </div>
                            <div class="profile-history-item-drop-item-right">
                                <?= $order->get_customer_note() ?>
                            </div>
                            </div>
                        </div>
                    </div>
                <? endforeach ?>
            </div>
        </div>
        <? if(empty($orders)) : ?>
            <div class="profile-history-empty" style="display: block">
                <div class="profile-history-empty-text">
                <?= __( 'You have no shopping history yet', \PS::$theme_name ); ?>
                </div>
                <a href="<?= get_permalink( wc_get_page_id( 'shop' ) ) ?>" class="profile-history-empty-btn">
                    <span><?= __( 'go to the store', \PS::$theme_name ); ?></span>
                    <img src="<?php echo \PS::$assets_url; ?>images/arrow10.svg" alt="i">
                </a>
            </div>
        <? endif?>

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