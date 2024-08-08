<?php /* Template Name: Forgot Password Page */ ?>
<?php 


if (is_user_logged_in())
    wp_redirect (get_permalink(\PS::$profile_info_page));

$showPopup = false;
$errors = false;
    
if ($_POST) {
    if (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL))
        $errors = true;

    if (!$errors) {
        $user = get_user_by('login', $_POST['username']);
        $showPopup = true;

        if ($user->ID) {
            $newPass = wp_generate_password();
            wp_set_password($newPass, $user->ID);

            wp_mail ($_POST['username'], 'Onrial reset password', "Hello!

If you forgot your password to your personal account and you need to recover it, follow the following scheme:
            
1. Use this temporary password that we generated for you to restore access to your personal account - $newPass
            
2. After that, go to your personal account and change the temporary password to the one you want and about which only you will know.
            
Thank you!");
        }
    }
}

get_header(); 

?>

<body class="password-recovery-page">
    <?php get_template_part('parts/_header'); ?>

    <main class="password-recovery-main">
        <form action="<? get_permalink() ?>" method="POST" class="registration-form">
            <div class="registration-title">
            <?= __( 'PASSWORD RECOVERY', \PS::$theme_name ); ?>
            </div>
            <div class="registration-input">
            <div class="form-group <?= $errors ? "error" : "" ?>">
                <label class="form-label" for="first">E-mail</label>
                <input id="first" name="username" class="form-input" type="email" />
                <div class="error-text">
                    <?= __( 'Write email', \PS::$theme_name ); ?>
                </div>
            </div>
            </div>

            <button type="submit" class="registration-submit-btn">
                <?= __( 'Send', \PS::$theme_name ); ?>
            </button>
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

    <?php if($showPopup) : ?>
        <script>
            $('[data-modal="check-email-popup"]').fadeIn(1).addClass('is-open');
        </script>
    <?php endif ?>

</body>
</html>