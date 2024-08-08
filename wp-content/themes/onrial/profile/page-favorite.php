<?php /* Template Name: Profile favourite Page */

if (!is_user_logged_in()) {
    wp_redirect(get_permalink(\PS::$login_page));exit;
}

global $product;
    
$favouriteIDs = \PS\Functions\Helper\Helper::get_favorite_ids();

$favouriteProducts = [];

if ($favouriteIDs) {
    $args = [ 'include' => $favouriteIDs, 'limit' => 20 ];
    $favouriteProducts = wc_get_products( $args );
}

get_header(); ?>

<body class="profile-favorite-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="profile-favorite">

        <div class="pagination">
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="/"><?= __( 'Home', \PS::$theme_name ); ?></a>
                </li>
                <li class="pagination__item">
                    <a href="<?= get_permalink(\PS::$profile_favourite_page) ?>"><?= __( 'Favourite', \PS::$theme_name ); ?></a>
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
                <a href="<?= get_permalink(\PS::$profile_favourite_page) ?>" class="profile-tabs-item active">
                    <?= __( 'favourite', \PS::$theme_name ); ?>
                </a>
                <a href="<?= get_permalink(\PS::$profile_history_page) ?>" class="profile-tabs-item">
                    <?= __( 'shopping history', \PS::$theme_name ); ?>
                </a>
            </div>
        </div>

        <div class="profile-favorite-slider-fluid">
            <div class="profile-favorite-slider-wrapper">
                <div class="profile-favorite-slider-arrows">
                    <div class="slick-prev">
                        <img src="<?php echo \PS::$assets_url; ?>images/arrow-prev.svg" alt="img">
                    </div>
                    <div class="slick-next">
                        <img src="<?php echo \PS::$assets_url; ?>images/arrow-next.svg" alt="img">
                    </div>
                </div>
            <div class="profile-favorite-slider">
                <? foreach($favouriteProducts as $product) : ?>
                    <div class="profile-favorite-slider-item">  
                        <?php wc_get_template_part('content', 'product'); ?>
                    </div>
                <? endforeach ?>
            </div>
        </div>
        <? if(empty($favouriteProducts)) : ?>
            <div class="profile-favorite-empty" style="display: block">
            <div class="profile-favorite-empty-text">
                <?= __( 'add products to favorite', \PS::$theme_name ); ?>
            </div>
            <a href="<?= get_permalink( wc_get_page_id( 'shop' ) ) ?>" class="profile-favorite-empty-btn">
                <span><?= __( 'go to the store', \PS::$theme_name ); ?></span>
                <img src="<?php echo \PS::$assets_url; ?>images/arrow10.svg" alt="i">
            </a>
            </div>
        <? endif ?>
    </div>
    

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