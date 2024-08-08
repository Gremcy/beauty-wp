<?php if (!defined('ABSPATH')){exit;} ?>

<form class="registration-sales-news-right parsley-form">
    <input name="action" value="add_new_letter" type="hidden">
    <input name="phone" value="" type="hidden">
    <input name="country" value="" type="hidden">

    <div class="school-footer-textarea">
        <textarea spellcheck="false" placeholder="<?php _e( 'Your question', \PS::$theme_name ); ?>" name="message"></textarea>
    </div>

    <div class="registration-sales-news-input parsley-parent">
        <input class="parsley-check" placeholder="<?php echo mb_strtoupper(__( 'Your e-mail', \PS::$theme_name )); ?> *" type="text" name="email" data-parsley-required="true" data-parsley-type="email" autocomplete="off">
        <button type="submit" class="registration-sales-news-send-btn">
            <img src="<?php echo \PS::$assets_url; ?>images/icon13.svg" alt="">
        </button>
        <div class="error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></div>
    </div>
</form>