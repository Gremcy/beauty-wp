<?php

namespace PS\Functions\Helper;

/**
 * Class Email
 * @package PS\Functions\Helper
 */
class Email {

    /**
     * constructor
     */
    public function __construct() {}

    // send email
    public function send_email( $to, $subject, $body, $attachments = array() ) {
        $headers   = array();
        $headers[] = 'From: Onrial <info@' . str_ireplace(['http://', 'https://'], '', site_url()) . '>';
        $headers[] = 'Content-Type: text/html';
        $headers[] = 'charset=UTF-8';
        return wp_mail( $to, $subject, $body, $headers, $attachments );
    }

    // send notification
    public function send_notification( $post_id ) {

        // letter
        if ( get_post_type( $post_id ) === 'letter' ) {
            // to
            $to = get_field('form_letter_email', \PS::$option_page);

            // subject
            $subject = 'Form "Contact us"';

            // information
            $name = get_field('name', $post_id);
            $email = get_field('email', $post_id);
            $phone = get_field('phone', $post_id);
            $country = get_field('country', $post_id);
            $message = get_field('message', $post_id);

            // html
            ob_start();
            include( locate_template( 'parts/emails/letter.php' ) );
            $body = ob_get_contents();
            ob_end_clean();

            // send
            return $this->send_email( $to, $subject, $body );
        }

        // questionnaire
        elseif ( get_post_type( $post_id ) === 'questionnaire' ) {
            // to
            $to = get_field('form_questionnaire_email', \PS::$option_page);

            // subject
            $subject = 'Form "Questionnaire"';

            // information
            $course = get_field('course', $post_id);
            $name = get_field('name', $post_id);
            $email = get_field('email', $post_id);
            $phone = get_field('phone', $post_id);
            $country = get_field('country', $post_id);
            $social = get_field('social', $post_id);

            // html
            ob_start();
            include( locate_template( 'parts/emails/questionnaire.php' ) );
            $body = ob_get_contents();
            ob_end_clean();

            // send
            return $this->send_email( $to, $subject, $body );
        }

        // partner
        elseif ( get_post_type( $post_id ) === 'partner' ) {
            // to
            $to = get_field('form_partner_email', \PS::$option_page);

            // subject
            $subject = 'Form "Become our partner"';

            // information
            $name = get_field('name', $post_id);
            $email = get_field('email', $post_id);
            $phone = get_field('phone', $post_id);
            $country = get_field('country', $post_id);
            $message = get_field('message', $post_id);

            // html
            ob_start();
            include( locate_template( 'parts/emails/partner.php' ) );
            $body = ob_get_contents();
            ob_end_clean();

            // send
            return $this->send_email( $to, $subject, $body );
        }

        // ambassador
        elseif ( get_post_type( $post_id ) === 'ambassador' ) {
            // to
            $to = get_field('form_ambassador_email', \PS::$option_page);

            // subject
            $subject = 'Form "Become our ambassador"';

            // information
            $name = get_field('name', $post_id);
            $email = get_field('email', $post_id);
            $phone = get_field('phone', $post_id);
            $country = get_field('country', $post_id);
            $instagram = get_field('instagram', $post_id);
            $buy = get_field('buy', $post_id);
            $customer = get_field('customer', $post_id);
            $other = get_field('other', $post_id);

            // html
            ob_start();
            include( locate_template( 'parts/emails/ambassador.php' ) );
            $body = ob_get_contents();
            ob_end_clean();

            // send
            return $this->send_email( $to, $subject, $body );
        }

        // get 5% discount
        elseif ( get_post_type( $post_id ) === 'coupons' ) {
            // 1. to admin
            $to = get_field('form_coupons_email', \PS::$option_page);

            // subject
            $subject = 'Form "Get 5% discount"';

            // information
            $coupon = get_field('coupon', $post_id);
            $name = get_field('name', $post_id);
            $email = get_field('email', $post_id);
            $phone = get_field('phone', $post_id);
            $country = get_field('country', $post_id);
            $message = get_field('message', $post_id);

            // html
            ob_start();
            include( locate_template( 'parts/emails/coupons.php' ) );
            $body = ob_get_contents();
            ob_end_clean();

            // send
            $this->send_email( $to, $subject, $body );

            // 2. to user
            // subject
            $subject = 'Your coupon code';

            // html
            ob_start();
            include( locate_template( 'parts/emails/coupons_user.php' ) );
            $body = ob_get_contents();
            ob_end_clean();

            // send
            $this->send_email( $to, $subject, $body );

            // return
            return true;
        }

        // false
        else {
            return false;
        }
    }

}