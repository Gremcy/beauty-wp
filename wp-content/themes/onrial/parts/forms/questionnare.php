<?php if (!defined('ABSPATH')){exit;} ?>

<form class="fill-out-form questionnaire-form parsley-form">
    <?php $form_questionnaire_title = get_field('form_questionnaire_title', \PS::$option_page); if($form_questionnaire_title): ?>
        <div class="fill-out-form-title"><?php echo __($form_questionnaire_title); ?></div>
    <?php endif; ?>

    <input name="action" value="add_new_questionnaire" type="hidden">
    <input name="phone" value="" type="hidden">
    <input name="country" value="" type="hidden">
    <input name="master" value="" type="hidden">

    <div class="fill-out-form-input">
        <input placeholder="<?php echo mb_strtoupper(__( 'Your name', \PS::$theme_name )); ?>" type="text" name="name" autocomplete="off">
    </div>
    <div class="fill-out-form-input parsley-parent">
        <input class="parsley-check" placeholder="<?php echo mb_strtoupper(__( 'Your e-mail', \PS::$theme_name )); ?> *" type="text" name="email" data-parsley-required="true" data-parsley-type="email" autocomplete="off">
        <span class="error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
    </div>
    <div class="fill-out-form-input parsley-parent">
        <input class="parsley-check" id="questionnaire-phone" type="tel" autocomplete="off">
        <span class="contact-form__error-text error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
    </div>
    <div class="fill-out-form-input">
        <input placeholder="<?php echo mb_strtoupper(__( 'Link in social media', \PS::$theme_name )); ?>" type="text" name="social" autocomplete="off">
    </div>
    <button type="submit" class="fill-out-form-btn" data-default="<?php _e( 'Send', \PS::$theme_name ); ?>" data-wait="<?php _e( 'Wait', \PS::$theme_name ); ?>.."><?php _e( 'Send', \PS::$theme_name ); ?></button>
</form>