<?php /* Template Name: Login Page */

if(is_user_logged_in())
    wp_redirect (get_permalink(\PS::$profile_info_page));

if($_POST) {
 
	global $wpdb;
    $login_errors = false;
    
 
	$username = sanitize_email(@$_REQUEST['username']);
	$password = sanitize_text_field(@$_REQUEST['password']);
	$remember = isset($_REQUEST['remember']) ? true : false;

 
	$login_data = array();
	$login_data['user_login'] = $username;
	$login_data['user_password'] = $password;
	$login_data['remember'] = $remember;
 
	$user = wp_signon( $login_data, false ); 
 
	if ( !is_wp_error($user) ){
        wp_redirect (get_permalink(\PS::$profile_info_page));
	} else {
        $login_errors = true;
    }
 
}
get_header(); ?>

<body class="login-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="registration-main">

        <form action="<?= get_permalink() ?>" method="POST" class="registration-form">
            <div class="registration-title">
            <?= __( 'Log in', \PS::$theme_name ); ?>
            </div>
            <div class="registration-input">
            <div class="form-group <?= $login_errors ? "error" : "" ?>">
                <label class="form-label" for="username">E-mail</label>
                <input id="username" name="username" class="form-input" type="text" />
                <div class="error-text">
                <?= __( 'Wrong login or password', \PS::$theme_name ); ?>
                </div>
            </div>
            </div>
            <div class="registration-input">
            <div class="form-group">
                <label class="form-label" for="password"><?= __( 'Password', \PS::$theme_name ); ?></label>
                <input id="password" name="password" class="form-input" type="password" />
            </div>
            </div>
            <div class="registration-subscribe">
            <input type="checkbox" name="remember" id="el1"> <label for="el1">
                <?= __( 'Remember me', \PS::$theme_name ); ?>
            </label>
            </div>
            <button type="submit" class="registration-submit-btn">
                <?= __( 'Log in', \PS::$theme_name ); ?>
            </button>
            <div class="login-bottom-area">
            <a href="<?= get_permalink(4003) ?>" class="login-forgot-btn">
                <span><?= __( 'forgot password?', \PS::$theme_name ); ?></span>
            </a>
            <a href="<?= get_permalink(4002) ?>" class="registration-login-btn">
                <span><?= __( 'registration', \PS::$theme_name ); ?></span>
                <svg width="46" height="16" viewBox="0 0 46 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8L45 8" stroke="#424242"/><path d="M35.8853 0.5L44.9992 6.81579V9.18421L35.8853 15.5" stroke="#424242"/></svg>
            </a>
            </div>
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