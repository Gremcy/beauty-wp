<?php if (!defined('ABSPATH')){exit;} ?>

<form class="fill-out-form ambassador-form parsley-form">
    <input name="action" value="add_new_ambassador" type="hidden">
    <input name="phone" value="" type="hidden">
    <input name="country" value="" type="hidden">
    <?php $form_ambassador_title = get_field('form_ambassador_title', \PS::$option_page); if($form_ambassador_title): ?>
        <div class="fill-out-form-title"><?php echo __($form_ambassador_title); ?></div>
    <?php endif; ?>
    <div class="fill-out-form-input">
        <input type="text" placeholder="<?php _e( 'Your name', \PS::$theme_name ); ?>" name="name" autocomplete="off">
    </div>
    <div class="fill-out-form-input parsley-parent">
        <input class="parsley-check" type="text" placeholder="<?php _e( 'Your e-mail', \PS::$theme_name ); ?> *" name="email" data-parsley-required="true" data-parsley-type="email" autocomplete="off">
        <span class="contact-form__error-text error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
    </div>
    <div class="fill-out-form-input parsley-parent">
        <input class="parsley-check" id="ambassador-phone" type="tel" autocomplete="off">
        <span class="contact-form__error-text error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
    </div>
    <div class="fill-out-form-input">
        <input type="text" placeholder="<?php _e( 'Link for Instagram', \PS::$theme_name ); ?>" name="instagram" autocomplete="off">
    </div>
    <div class="fill-out-form-input">
        <input type="text" placeholder="<?php _e( 'Where did you buy our products?', \PS::$theme_name ); ?>" name="buy" autocomplete="off">
    </div>
    <div class="fill-out-form-input">
        <input type="text" placeholder="<?php _e( 'Are you already our wholesale customer?', \PS::$theme_name ); ?>" name="customer" autocomplete="off">
    </div>
    <div class="fill-out-form-input">
        <input type="text" placeholder="<?php _e( 'You are an ambassador of other brands?', \PS::$theme_name ); ?>" name="other" autocomplete="off">
    </div>
    <button type="submit" class="fill-out-form-btn" data-default="<?php _e( 'Send', \PS::$theme_name ); ?>" data-wait="<?php _e( 'Wait', \PS::$theme_name ); ?>.."><?php _e( 'Send', \PS::$theme_name ); ?></button>
</form>