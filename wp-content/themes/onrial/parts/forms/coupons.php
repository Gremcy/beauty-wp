<?php if (!defined('ABSPATH')){exit;} ?>

<form class="fill-out-form parsley-form">
    <div class="fill-out-form-title"><?php _e( 'Get discount', \PS::$theme_name ); ?></div>

    <input name="action" value="add_new_coupon" type="hidden">
    <input name="phone" value="" type="hidden">
    <input name="country" value="" type="hidden">

    <div class="fill-out-form-input">
        <input type="text" placeholder="<?php _e( 'Your name', \PS::$theme_name ); ?>" name="name" autocomplete="off">
    </div>
    <div class="fill-out-form-input parsley-parent">
        <input class="parsley-check" type="text" placeholder="<?php _e( 'Your e-mail', \PS::$theme_name ); ?> *" name="email" data-parsley-required="true" data-parsley-type="email" autocomplete="off">
        <span class="contact-form__error-text error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
    </div>
    <div class="fill-out-form-input parsley-parent">
        <input class="parsley-check" id="coupons-phone" type="tel" autocomplete="off">
        <span class="contact-form__error-text error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
    </div>
    <?php $form_partner_what = get_field('form_partner_what', \PS::$option_page); if(is_array($form_partner_what) && count($form_partner_what)): ?>
        <div class="fill-out-form-select">
            <select class="select-css" name="message" style="text-transform: uppercase">
                <option value="" disabled selected hidden><?php _e( 'What do you do?', \PS::$theme_name ); ?></option>
                <?php foreach ($form_partner_what as $option): ?>
                    <option value="<?php echo __($option['text']); ?>"><?php echo __($option['text']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <button type="submit" class="fill-out-form-btn" data-default="<?php _e( 'Get 5% discount', \PS::$theme_name ); ?>" data-wait="<?php _e( 'Wait', \PS::$theme_name ); ?>.."><?php _e( 'Get 5% discount', \PS::$theme_name ); ?></button>
</form>