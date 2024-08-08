<?php if (!defined('ABSPATH')){exit;} ?>

<form class="<?php if(isset($args['page']) && $args['page'] === 'partnership'): ?>partnership-contact__form<?php else: ?>fill-out-form partner-form<?php endif; ?> parsley-form">
    <input name="action" value="add_new_partner" type="hidden">
    <input name="phone" value="" type="hidden">
    <input name="country" value="" type="hidden">

    <?php $form_partner_title = get_field('form_partner_title', \PS::$option_page); if($form_partner_title): ?>
        <?php if(isset($args['page']) && $args['page'] === 'partnership'): ?>
            <p class="contact-form__title"><?php echo __($form_partner_title); ?></p>
        <?php else: ?>
            <div class="fill-out-form-title"><?php echo __($form_partner_title); ?></div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="fill-out-form-input">
        <input type="text" placeholder="<?php _e( 'Your name', \PS::$theme_name ); ?>" name="name" autocomplete="off">
    </div>
    <div class="fill-out-form-input parsley-parent">
        <input class="parsley-check" type="text" placeholder="<?php _e( 'Your e-mail', \PS::$theme_name ); ?> *" name="email" data-parsley-required="true" data-parsley-type="email" autocomplete="off">
        <span class="contact-form__error-text error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
    </div>
    <div class="fill-out-form-input parsley-parent">
        <input class="parsley-check" id="partner-phone" type="tel" autocomplete="off">
        <span class="contact-form__error-text error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
    </div>
    <?php $form_partner_what = get_field('form_partner_what', \PS::$option_page); if(is_array($form_partner_what) && count($form_partner_what)): ?>
        <div class="fill-out-form-select">
            <select class="select-css" name="message">
                <option value="" disabled selected hidden><?php _e( 'What do you do?', \PS::$theme_name ); ?></option>
                <?php foreach ($form_partner_what as $option): ?>
                    <option value="<?php echo __($option['text']); ?>"><?php echo __($option['text']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    <?php endif; ?>

    <?php if(isset($args['page']) && $args['page'] === 'partnership'): ?>
        <span class="contact-form__button button" type="submit" data-default="<?php _e( 'Send', \PS::$theme_name ); ?>" data-wait="<?php _e( 'Wait', \PS::$theme_name ); ?>.."><?php _e( 'Send', \PS::$theme_name ); ?></span>
    <?php else: ?>
        <button type="submit" class="fill-out-form-btn" data-default="<?php _e( 'Send', \PS::$theme_name ); ?>" data-wait="<?php _e( 'Wait', \PS::$theme_name ); ?>.."><?php _e( 'Send', \PS::$theme_name ); ?></button>
    <?php endif; ?>
</form>