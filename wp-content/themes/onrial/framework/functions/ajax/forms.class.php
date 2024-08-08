<?php

namespace PS\Functions\Ajax;

/**
 * Class Forms
 * @package     PS\Functions\Ajax
 * @since       1.0.0
 */
class Forms {

    public function __construct() {
        // contact us
        add_action( 'wp_ajax_add_new_letter', array( $this, 'add_new_letter' ) );
        add_action( 'wp_ajax_nopriv_add_new_letter', array( $this, 'add_new_letter' ) );

        // questionnaire
        add_action( 'wp_ajax_add_new_questionnaire', array( $this, 'add_new_questionnaire' ) );
        add_action( 'wp_ajax_nopriv_add_new_questionnaire', array( $this, 'add_new_questionnaire' ) );

        // become partner
        add_action( 'wp_ajax_add_new_partner', array( $this, 'add_new_partner' ) );
        add_action( 'wp_ajax_nopriv_add_new_partner', array( $this, 'add_new_partner' ) );

        // become ambassador
        add_action( 'wp_ajax_add_new_ambassador', array( $this, 'add_new_ambassador' ) );
        add_action( 'wp_ajax_nopriv_add_new_ambassador', array( $this, 'add_new_ambassador' ) );

        // get 5% coupon
        add_action( 'wp_ajax_add_new_coupon', array( $this, 'add_new_coupon' ) );
        add_action( 'wp_ajax_nopriv_add_new_coupon', array( $this, 'add_new_coupon' ) );
    }

    // contact us
    public function add_new_letter() {
        $return = [
            'success' => false
        ];

        // 1. vars
        $name = isset($_POST['name']) ? wp_strip_all_tags($_POST['name'], true) : '';
        $country = isset($_POST['country']) ? wp_strip_all_tags($_POST['country'], true) : '';
        $phone = isset($_POST['phone']) ? wp_strip_all_tags($_POST['phone'], true) : '';
        $email = isset($_POST['email']) ? wp_strip_all_tags($_POST['email'], true) : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        if($email){

            // 2. save letter
            $post_data = array(
                'post_title' => '',
                'post_type'   => 'letter',
                'post_status' => 'publish',
                'post_author' => 1
            );
            $post_id = wp_insert_post($post_data);
            if($post_id){
                // update title
                $update_data = array(
                    'ID'         => $post_id,
                    'post_title' => '#' . $post_id
                );
                wp_update_post( $update_data );

                // fields
                update_field("field_63a1d7e79579b", $name, $post_id);
                update_field("field_63a1d9184bde4", $email, $post_id);
                update_field("field_63a1d8ac6e27b", $phone, $post_id);
                update_field("field_63a1d8a66e27a", $country, $post_id);
                update_field("field_63a1d9234bde5", $message, $post_id);

                // 3. save additional data
                self::save_data($post_id);

                // 4. send to CRM
                $Bitrix = new \PS\Functions\Crm\Bitrix();
                $Bitrix->send_form_to_bitrix($post_id);

                // 5. send email
                $Email = new \PS\Functions\Helper\Email();
                $Email->send_notification($post_id);

                // success
                $return['success'] = true;
            }

        }

        // echo
        echo json_encode($return, JSON_UNESCAPED_UNICODE);
        exit();
    }

    // questionnaire
    public function add_new_questionnaire() {
        $return = [
            'success' => false
        ];

        // 1. vars
        $master = isset($_POST['master']) ? wp_strip_all_tags($_POST['master'], true) : '';
        $name = isset($_POST['name']) ? wp_strip_all_tags($_POST['name'], true) : '';
        $country = isset($_POST['country']) ? wp_strip_all_tags($_POST['country'], true) : '';
        $phone = isset($_POST['phone']) ? wp_strip_all_tags($_POST['phone'], true) : '';
        $email = isset($_POST['email']) ? wp_strip_all_tags($_POST['email'], true) : '';
        $social = isset($_POST['social']) ? wp_strip_all_tags($_POST['social'], true) : '';
        if($email){
            // 2. save letter
            $post_data = array(
                'post_title' => '',
                'post_type'   => 'questionnaire',
                'post_status' => 'publish',
                'post_author' => 1
            );
            $post_id = wp_insert_post($post_data);
            if($post_id){
                // update title
                $update_data = array(
                    'ID'         => $post_id,
                    'post_title' => '#' . $post_id
                );
                wp_update_post( $update_data );

                // fields
                update_field("field_6412ffddc5909", $master, $post_id);
                update_field("field_6412ffa38839f", $name, $post_id);
                update_field("field_6412ffa3883d5", $email, $post_id);
                update_field("field_6412ffa38840c", $phone, $post_id);
                update_field("field_6412ffa388443", $country, $post_id);
                update_field("field_6412ffa388479", $social, $post_id);

                // 3. save additional data
                self::save_data($post_id);

                // 4. send to CRM
                $Bitrix = new \PS\Functions\Crm\Bitrix();
                $Bitrix->send_form_to_bitrix($post_id);

                // 5. send email
                $Email = new \PS\Functions\Helper\Email();
                $Email->send_notification($post_id);

                // success
                $return['success'] = true;
            }

        }

        // echo
        echo json_encode($return, JSON_UNESCAPED_UNICODE);
        exit();
    }

    // become partner
    public function add_new_partner() {
        $return = [
            'success' => false
        ];

        // 1. vars
        $name = isset($_POST['name']) ? wp_strip_all_tags($_POST['name'], true) : '';
        $email = isset($_POST['email']) ? wp_strip_all_tags($_POST['email'], true) : '';
        $phone = isset($_POST['phone']) ? wp_strip_all_tags($_POST['phone'], true) : '';
        $country = isset($_POST['country']) ? wp_strip_all_tags($_POST['country'], true) : '';
        $message = isset($_POST['message']) ? wp_strip_all_tags($_POST['message'], true) : '';
        if($email){

            // 2. save letter
            $post_data = array(
                'post_title' => '',
                'post_type'   => 'partner',
                'post_status' => 'publish',
                'post_author' => 1
            );
            $post_id = wp_insert_post($post_data);
            if($post_id){
                // update title
                $update_data = array(
                    'ID'         => $post_id,
                    'post_title' => '#' . $post_id
                );
                wp_update_post( $update_data );

                // fields
                update_field("field_63ab74e63ac29", $name, $post_id);
                update_field("field_63ab74e63accc", $email, $post_id);
                update_field("field_63ab74e63ac96", $phone, $post_id);
                update_field("field_63ab74e63ac5f", $country, $post_id);
                update_field("field_63ab74e63ad03", $message, $post_id);

                // 3. save additional data
                self::save_data($post_id);

                // 4. send to CRM
                $Bitrix = new \PS\Functions\Crm\Bitrix();
                $Bitrix->send_form_to_bitrix($post_id);

                // 5. send email
                $Email = new \PS\Functions\Helper\Email();
                $Email->send_notification($post_id);

                // success
                $return['success'] = true;
            }

        }

        // echo
        echo json_encode($return, JSON_UNESCAPED_UNICODE);
        exit();
    }

    // become ambassador
    public function add_new_ambassador() {
        $return = [
            'success' => false
        ];

        // 1. vars
        $name = isset($_POST['name']) ? wp_strip_all_tags($_POST['name'], true) : '';
        $email = isset($_POST['email']) ? wp_strip_all_tags($_POST['email'], true) : '';
        $phone = isset($_POST['phone']) ? wp_strip_all_tags($_POST['phone'], true) : '';
        $country = isset($_POST['country']) ? wp_strip_all_tags($_POST['country'], true) : '';
        $instagram = isset($_POST['instagram']) ? wp_strip_all_tags($_POST['instagram'], true) : '';
        $buy = isset($_POST['buy']) ? wp_strip_all_tags($_POST['buy'], true) : '';
        $customer = isset($_POST['customer']) ? wp_strip_all_tags($_POST['customer'], true) : '';
        $other = isset($_POST['other']) ? wp_strip_all_tags($_POST['other'], true) : '';
        if($email){

            // 2. save letter
            $post_data = array(
                'post_title' => '',
                'post_type'   => 'ambassador',
                'post_status' => 'publish',
                'post_author' => 1
            );
            $post_id = wp_insert_post($post_data);
            if($post_id){
                // update title
                $update_data = array(
                    'ID'         => $post_id,
                    'post_title' => '#' . $post_id
                );
                wp_update_post( $update_data );

                // fields
                update_field("field_63ab74e63ac29", $name, $post_id);
                update_field("field_63ab74e63accc", $email, $post_id);
                update_field("field_63ab74e63ac96", $phone, $post_id);
                update_field("field_63ab74e63ac5f", $country, $post_id);
                update_field("field_63ac23af965de", $instagram, $post_id);
                update_field("field_63ac2b15611f3", $buy, $post_id);
                update_field("field_63ac2b21611f4", $customer, $post_id);
                update_field("field_63ac2b35611f5", $other, $post_id);

                // 3. save additional data
                self::save_data($post_id);

                // 4. send to CRM
                $Bitrix = new \PS\Functions\Crm\Bitrix();
                $Bitrix->send_form_to_bitrix($post_id);

                // 5. send email
                $Email = new \PS\Functions\Helper\Email();
                $Email->send_notification($post_id);

                // success
                $return['success'] = true;
            }

        }

        // echo
        echo json_encode($return, JSON_UNESCAPED_UNICODE);
        exit();
    }

    // save utm
    public static function save_data($post_id){
        // utm
        $utms = ['utm_medium', 'utm_source', 'utm_campaign', 'utm_term', 'utm_content'];
        foreach($utms as $utm){
            if(isset($_SESSION[$utm])){
                update_field($utm, $_SESSION[$utm], $post_id);
            }
        }
    }

    // get 5% coupon
    public function add_new_coupon() {
        global $wpdb;
        $return = [
            'success' => false
        ];

        // 1. vars
        $name = isset($_POST['name']) ? wp_strip_all_tags($_POST['name'], true) : '';
        $email = isset($_POST['email']) ? wp_strip_all_tags($_POST['email'], true) : '';
        $phone = isset($_POST['phone']) ? wp_strip_all_tags($_POST['phone'], true) : '';
        $country = isset($_POST['country']) ? wp_strip_all_tags($_POST['country'], true) : '';
        $message = isset($_POST['message']) ? wp_strip_all_tags($_POST['message'], true) : '';
        if($email){
            // 2. check email
            $find_email = $wpdb->get_var("SELECT t1.ID FROM {$wpdb->posts} t1, {$wpdb->postmeta} t2 WHERE t1.ID = t2.post_id AND t1.post_type = 'coupons' AND post_status = 'publish' AND t2.meta_key = 'email' AND t2.meta_value = '{$email}'");
            if(!$find_email){
                // 3. save coupon
                $post_data = array(
                    'post_title' => '',
                    'post_type'   => 'coupons',
                    'post_status' => 'publish',
                    'post_author' => 1
                );
                $post_id = wp_insert_post($post_data);
                if($post_id){
                    // update title
                    $update_data = array(
                        'ID'         => $post_id,
                        'post_title' => '#' . $post_id
                    );
                    wp_update_post( $update_data );

                    // generate coupon
                    $coupon_code = wp_generate_password(8, false);
                    $coupon = new \WC_Coupon();
                    $coupon->set_code( $coupon_code );
                    $coupon->set_discount_type( 'percent' );
                    $coupon->set_amount( 5 );
                    $coupon->set_usage_limit( 1 );
                    $coupon->save();

                    // fields
                    update_field("field_64513bfa178c1", $coupon_code, $post_id);
                    update_field("field_64513be15c306", $name, $post_id);
                    update_field("field_64513be15c33c", $email, $post_id);
                    update_field("field_64513be15c374", $phone, $post_id);
                    update_field("field_64513be15c3ac", $country, $post_id);
                    update_field("field_64513be15c3e4", $message, $post_id);

                    // 4. save additional data
                    self::save_data($post_id);

                    // 5. send to CRM
                    $Bitrix = new \PS\Functions\Crm\Bitrix();
                    $Bitrix->send_form_to_bitrix($post_id);

                    // 6. send email
                    $Email = new \PS\Functions\Helper\Email();
                    $Email->send_notification($post_id);

                    // success
                    $return['success'] = true;
                    $return['coupon_code'] = $coupon_code;
                }
            }
        }

        // echo
        echo json_encode($return, JSON_UNESCAPED_UNICODE);
        exit();
    }

}