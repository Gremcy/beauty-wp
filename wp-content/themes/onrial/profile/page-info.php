<?php /* Template Name: Profile Page */

if( !is_user_logged_in() )
    wp_redirect(get_permalink(\PS::$login_page));

$oldPassError = false;
$newPassError = false;
    
if($_POST) {
    $oldPassCorrect = false;
    $userdata = wp_get_current_user();

    if(@$_POST['old_password']) {
        if (wp_check_password($_POST['old_password'], $userdata->user_pass, $userdata->ID)) {
            if (@$_POST['new_password'] && @$_POST['new_password'] === @$_POST['repeat_password']) {
                wp_set_password(@$_POST['new_password'], $userdata->ID);
                // Log-in again.
                wp_set_auth_cookie($userdata->ID);
                wp_set_current_user($userdata->ID);
                do_action('wp_login', $userdata->user_login, $userdata);
            } else
                $newPassError = true;
        } else {
            $oldPassError = true;
        }
    }

    $data = ["ID" => $userdata->ID];

    if(!empty($_POST['first_name']))
        $data['first_name'] = sanitize_text_field($_POST['first_name']);

    if(!empty($_POST['last_name']))
        $data['last_name'] = sanitize_text_field($_POST['last_name']);

    wp_update_user($data);

    if( !empty($_POST['birthday_field']) ) {
        update_user_meta( $userdata->ID, 'birthday_field', sanitize_text_field($_POST['birthday_field']) );
    }

    if( !empty($_POST['billing_phone']) ) {
        update_user_meta( $userdata->ID, 'billing_phone', sanitize_text_field($_POST['billing_phone']) );
    }
        
}

get_header(); ?>

<body class="profile-info-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="profile-info-main">
        <div class="pagination">
            <ul class="pagination__list">
                <li class="pagination__item">
                    <a href="/"><?= __( 'Home', \PS::$theme_name ); ?></a>
                </li>
                <li class="pagination__item">
                    <a href="<?= get_permalink(\PS::$profile_info_page) ?>"><?= __( 'Profile info', \PS::$theme_name ); ?></a>
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
                <a href="<?= get_permalink(\PS::$profile_info_page) ?>" class="profile-tabs-item active">
                    <?= __( 'Profile info', \PS::$theme_name ); ?>
                </a>
                <a href="<?= get_permalink(\PS::$profile_favourite_page) ?>" class="profile-tabs-item">
                    <?= __( 'favourite', \PS::$theme_name ); ?>
                </a>
                <a href="<?= get_permalink(\PS::$profile_history_page) ?>" class="profile-tabs-item">
                    <?= __( 'shopping history', \PS::$theme_name ); ?>
                </a>
            </div>
        </div>

        <div class="profile-info-fluid">
            <div class="profile-info-centered">
                <form action="<?= get_permalink() ?>" method="POST" class="profile-info-form">
                    <div class="profile-info-block">
                        <div class="profile-info-title">
                            <?= __( 'edit your personal information', \PS::$theme_name ); ?>
                        </div>
                        <div class="profile-info-input">
                            <input type="text" maxlength="255" name="first_name" placeholder="<?= __( 'First name', \PS::$theme_name ); ?>" value="<?= get_user_meta(get_current_user_id(), 'first_name', true) ?>">
                            <div class="error-text"><?= __( 'Fill in the field', \PS::$theme_name ); ?></div>
                        </div>
                        <div class="profile-info-input">
                            <input type="text" maxlength="255" name="last_name" placeholder="<?= __( 'Last name', \PS::$theme_name ); ?>" value="<?= get_user_meta(get_current_user_id(), 'last_name', true) ?>">
                            <div class="error-text"><?= __( 'Fill in the field', \PS::$theme_name ); ?></div>
                        </div>
                        <div class="profile-info-input">
                            <input type="text" maxlength="255" name="birthday_field" placeholder="<?= __( 'Date of birth', \PS::$theme_name ); ?>" value="<?= get_user_meta(get_current_user_id(), 'birthday_field', true) ?>">
                            <div class="error-text"><?= __( 'Fill in the field', \PS::$theme_name ); ?></div>
                        </div>
                        <div class="profile-info-input">
                            <input type="text" maxlength="255" name="billing_phone" placeholder="<?= __( 'Phone', \PS::$theme_name ); ?>" value="<?= get_user_meta(get_current_user_id(), 'billing_phone', true) ?>">
                            <div class="error-text"><?= __( 'Fill in the field', \PS::$theme_name ); ?></div>
                        </div>
                        <button type="submit" class="profile-info-pass-btn">
                            <?= __( 'update', \PS::$theme_name ); ?>
                        </button>
                    </div>
                    <div class="profile-info-block">
                        <div class="profile-info-pass-top">
                            <div class="profile-info-title">
                                <?= __( 'Change password', \PS::$theme_name ); ?>
                            </div>
                            <div class="profile-info-input <?= $oldPassError ? 'error' : '' ?>">
                                <input type="password" maxlength="255" name="old_password" placeholder="Old password">
                                <div class="error-text"><?= __( 'Old password not correct', \PS::$theme_name ); ?></div>
                            </div>
                            <div class="profile-info-input <?= $newPassError ? 'error' : '' ?>">
                                <input type="password" maxlength="255" name="new_password" placeholder="New Password">
                                <div class="error-text"><?= __( 'Fill in the field', \PS::$theme_name ); ?></div>
                            </div>
                            <div class="profile-info-input <?= $newPassError ? 'error' : '' ?>">
                                <input type="password" maxlength="255" name="repeat_password" placeholder="Repeat Password">
                                <div class="error-text"><?= __( 'Repeat password', \PS::$theme_name ); ?></div>
                            </div>
                            <button type="submit" class="profile-info-pass-btn">
                                <?= __( 'Save', \PS::$theme_name ); ?>
                            </button>
                        </div>
                        <?php /*<a href="" class="profile-info-discount">
                            <span><?= __( '2% personal Discount', \PS::$theme_name ); ?></span>
                            <img src="<?php echo \PS::$assets_url; ?>images/arrow4.svg" alt="img">
                        </a>*/?>
                    </div>
                </form>
            </div>
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