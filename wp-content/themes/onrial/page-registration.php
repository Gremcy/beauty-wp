<?php /* Template Name: Registration Page */ 
$errors = [];

if($_POST) {
 
	global $wpdb;
	
    $errors = false;
    $passwordMismatch = false;
 
	$username = sanitize_email($_REQUEST['username']);
	$password = sanitize_text_field($_REQUEST['password']);
	$passwordRepeat = sanitize_text_field($_REQUEST['password_repeat']);
	
	if(!$password || $passwordRepeat !== $password)
		$passwordMismatch = true;

    if(!filter_var($username, FILTER_VALIDATE_EMAIL))
        $errors = true;

    if (!$passwordMismatch && !$errors) {
        $user = wp_create_user($username, $password, $username ); 

        if (!is_wp_error($user)) {
            wp_clear_auth_cookie();
            wp_set_current_user($user);
            wp_set_auth_cookie($user);

            wp_mail($username, 'Onrial registration', 'Hello!

Thank you for registering on our website.');

            wp_redirect (get_permalink(\PS::$profile_info_page));
        } else {
            $errors = true;
        }
    }
 
}


if(is_user_logged_in())
    wp_redirect (get_permalink(\PS::$profile_info_page));
get_header();
?>

<body class="registration-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="registration-main">
        <form action="<?= get_permalink() ?>" method="POST" class="registration-form">
            <div class="registration-title">
            <?= __( 'registration', \PS::$theme_name ); ?>
            </div>
            <div class="registration-input">
            <div class="form-group <?= $errors ? "error" : "" ?>">
                <label class="form-label" for="first">E-mail</label>
                <input id="first" name="username" value="<?= @$_POST['username'] ?>"class="form-input" type="text" />
                <div class="error-text"><?= __( 'Check your email', \PS::$theme_name ); ?></div>
            </div>
            </div>
            <div class="registration-input">
            <div class="form-group">
                <label class="form-label" for="password"><?= __( 'Password', \PS::$theme_name ); ?></label>
                <input id="password" name="password" class="form-input" type="password" />
                <div class="error-text"><?= __( 'Use latin letters', \PS::$theme_name ); ?></div>
            </div>
            </div>
            <div class="registration-input">
            <div class="form-group <?= $passwordMismatch ? "error" : "" ?>">
                <label class="form-label" for="password_repeat"><?= __( 'Repeat Password', \PS::$theme_name ); ?></label>
                <input id="password_repeat" name="password_repeat" class="form-input" type="password" />
                <div class="error-text"><?= __( 'Check password', \PS::$theme_name ); ?></div>
            </div>
            </div>
            <div class="registration-subscribe">
                <input type="checkbox" name="subscribe" id="el1"> 
                <label for="el1">
                    <?= __( 'Receive news about discounts, letters, promotoins', \PS::$theme_name ); ?>
                </label>
            </div>
            <button type="submit" class="registration-submit-btn"><?= __( 'registration', \PS::$theme_name ); ?></button>
            <a href="<?= get_permalink(4001) ?>" class="registration-login-btn">
                <span>Log in</span>
                <svg width="46" height="16" viewBox="0 0 46 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8L45 8" stroke="#424242"/><path d="M35.8853 0.5L44.9992 6.81579V9.18421L35.8853 15.5" stroke="#424242"/></svg>
            </a>
        </form>

        <div class="registration-sales-news-fluid">
            <div class="registration-sales-news-centered">
            <div class="registration-sales-news-left">
                <?= __( 'be the first to know about sales and news!', \PS::$theme_name ); ?>
            </div>
            <div class="registration-sales-news-right">
                <form action="" class="registration-sales-news-input">
                <input type="text" placeholder="E-mail">
                <button type="submit" class="registration-sales-news-send-btn">
                    <img src="<?php echo \PS::$assets_url; ?>images/icon13.svg" alt="img">
                </button>
                </form>
            </div>
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