<?php if (!defined('ABSPATH')){exit;} ?>

<form class="<?php if(isset($args['page']) && $args['page'] === 'contacts'): ?>contacts__form<?php else: ?>contact-form<?php endif; ?> parsley-form">
    <input name="action" value="add_new_letter" type="hidden">
    <input name="phone" value="" type="hidden">
    <input name="country" value="" type="hidden">

    <?php if(isset($args['page']) && $args['page'] === 'contacts'): ?>
        <?php $form_letter_title = get_field('form_letter_title', \PS::$option_page); if($form_letter_title): ?>
            <p class="contact-form__title"><?php echo __($form_letter_title); ?></p>
        <?php endif; ?>
    <?php endif; ?>

    <ul class="contact-form__list">
        <li class="contact-form__item">
            <input class="contact-form__input" placeholder=" " type="text" name="name" autocomplete="off">
            <label for="name"><?php echo mb_strtoupper(__( 'Your name', \PS::$theme_name )); ?></label>
        </li>
        <li class="contact-form__item parsley-parent">
            <input class="contact-form__input parsley-check" placeholder=" " type="text" name="email" data-parsley-required="true" data-parsley-type="email" autocomplete="off">
            <label for="name"><?php echo mb_strtoupper(__( 'Your e-mail', \PS::$theme_name )); ?> *</label>
            <span class="contact-form__error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
        </li>
        <li class="contact-form__item parsley-parent">
            <input class="contact-form__input parsley-check" id="letter-phone" type="tel" autocomplete="off">
            <span class="contact-form__error-text error-text"><?php _e( 'Filling error, please check', \PS::$theme_name ); ?></span>
        </li>
        <li class="contact-form__item">
            <textarea spellcheck="false" placeholder=" " class="contact-form__textarea" name="message"></textarea>
            <label for="name"><?php echo mb_strtoupper(__( 'Your message', \PS::$theme_name )); ?></label>
        </li>
    </ul>

    <?php if(isset($args['page']) && $args['page'] === 'contacts'): ?>
        <span class="contact-form__button button" type="submit" data-default="<?php _e( 'Send', \PS::$theme_name ); ?>" data-wait="<?php _e( 'Wait', \PS::$theme_name ); ?>.."><?php _e( 'Send', \PS::$theme_name ); ?></span>
    <?php else: ?>
        <a href="javascript:void(0)" class="contact-form__button_arrow button_arrow" type="submit" data-default="<?php _e( 'Send', \PS::$theme_name ); ?>" data-wait="<?php _e( 'Wait', \PS::$theme_name ); ?>..">
            <span><?php _e( 'Send', \PS::$theme_name ); ?></span>
            <svg class="button_arrow__icon" width="46" height="16" viewBox="0 0 46 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 8L45 8" stroke="#424242" /><path d="M35.8856 0.5L44.9995 6.81579V9.18421L35.8856 15.5" stroke="#424242" /></svg>
            <svg class="button_arrow__icon-mobile" width="26" height="18" viewBox="0 0 26 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 9L24.887 9" stroke="#424242" /><path d="M16.0408 1L25.0001 7.73684V10.2632L16.0408 17" stroke="#424242" /></svg>
        </a>
    <?php endif; ?>
</form>