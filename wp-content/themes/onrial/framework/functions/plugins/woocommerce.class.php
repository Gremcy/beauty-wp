<?php

namespace PS\Functions\Plugins;

/**
 * Class Woocommerce
 * @package PS\Functions\Plugins
 */
class Woocommerce {

    /**
     * constructor
     */
    public function __construct() {
        // init
        add_action( 'after_setup_theme', array( $this, 'woocommerce_support') );

        /* HELPER */
        // remove default css
        add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

        // remove notifications
        add_filter( 'wc_add_to_cart_message_html', '__return_false' );
        add_filter( 'woocommerce_cart_item_removed_notice_type', '__return_false' );

        // if price = 0
        add_filter( 'woocommerce_is_purchasable', array( $this, 'remove_add_to_cart_on_0'), 10, 2 );

        // price format
        add_filter( 'woocommerce_price_trim_zeros', '__return_true' );

        // show default variation price
        add_filter('woocommerce_variable_price_html', array( $this, 'custom_variation_price'), 10, 2);

        // cart
        add_shortcode( 'cart', array( $this, 'cart') );
        add_shortcode( 'minicart', array( $this, 'minicart') );

        /* WOOCOMMERCE LOAD MORE PRODUCTS */
        // change button
        add_filter( 'berocket_lmp_button_text', array( $this, 'berocket_lmp_button_text') );
        add_filter( 'berocket_lmp_button_style', array( $this, 'berocket_lmp_button_style') );
        add_filter( 'berocket_lmp_button_hover', array( $this, 'berocket_lmp_button_style') );

        /* CHECKOUT */
        // disable select2
        add_action( 'wp_enqueue_scripts', array( $this, 'wsis_dequeue_stylesandscripts_select2'), 100 );

        // change some fields
        add_filter( 'woocommerce_billing_fields', array( $this, 'woo_filter_fields_billing'), 10, 1 );
        add_filter( 'woocommerce_shipping_fields', array( $this, 'woo_filter_fields_billing'), 10, 1 );

        // stripe
        add_filter( 'wc_stripe_elements_styling', array( $this, 'my_theme_modify_stripe_fields_styles') );

        // custom checkout fields
        add_filter('woocommerce_checkout_fields', array( $this, 'custom_override_billing_checkout_fields'));
        //add_action('woocommerce_after_checkout_billing_form', array( $this, 'custom_checkout_field') );
        add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'custom_save_new_checkout_field') );
        add_action( 'woocommerce_admin_order_data_after_billing_address', array( $this, 'custom_show_new_checkout_field_order') );
        add_action('woocommerce_checkout_process', array( $this, 'customised_checkout_field_process') );

        // hide some fields for local pickup
        add_filter( 'woocommerce_checkout_fields', array( $this, 'hide_local_pickup_method') );

        // show some fields for inpost
        add_filter( 'woocommerce_checkout_fields', array( $this, 'show_inpost_fields') );

        // new order
        add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'new_order'),  1, 1  );

        // discounts
        add_action('woocommerce_cart_calculate_fees', array( $this, 'woo_discount_total'));
    }

    // init
    public function woocommerce_support() {
        add_theme_support( 'woocommerce' );
    }

    /* HELPER */
    // get categories
    public static function get_product_cats(){
        $return = [];
        $product_cats = get_terms(['taxonomy' => 'product_cat', 'parent' => 0]); if(is_array($product_cats) && count($product_cats)){
            foreach ($product_cats as $cat){
                $return[$cat->term_id]['category'] = $cat;
                $return[$cat->term_id]['sub'] = get_terms(['taxonomy' => 'product_cat', 'parent' => $cat->term_id]);
            }
        }
        return $return;
    }

    // if price = 0
    public function remove_add_to_cart_on_0 ( $is_purchasable, $product ){
        if( $product->get_price() == 0 ) {
            return false;
        } else {
            return $is_purchasable;
        }
    }

    // show default variation price
    public function custom_variation_price( $price, $product ) {
        $default_attributes = $product->get_variation_default_attributes();
        if($default_attributes){
            foreach($product->get_available_variations() as $variation) {
                $is_default = true;
                foreach($default_attributes as $attribute_key => $attribute_value) {
                    if($variation['attributes']['attribute_' . $attribute_key] !== $attribute_value){
                        $is_default = false;
                        break;
                    }
                }
                if($is_default && $variation['price_html']){
                    return $variation['price_html'];
                }else{
                    return $price;
                }
            }
        }else{
            return $price;
        }
    }

    // cart
    public function cart() {
        ob_start();
        get_template_part( 'woocommerce/cart/cart' );
        return ob_get_clean();
    }
    public function minicart() {
        ob_start();
        get_template_part( 'woocommerce/cart/mini-cart' );
        return ob_get_clean();
    }
    /* END */

    /* WOOCOMMERCE LOAD MORE PRODUCTS */
    // change button
    public function berocket_lmp_button_text(){
        return '<span>' . __('Load more', \PS::$theme_name) . '</span><img src="' . \PS::$assets_url . 'images/icon10.svg" alt="">';
    }
    public function berocket_lmp_button_style(){
        return '';
    }
    /* END */

    /* CHECKOUT */
    // disable select2
    public function wsis_dequeue_stylesandscripts_select2() {
        if ( is_checkout() && class_exists( 'woocommerce' ) ) {
            wp_dequeue_style( 'selectWoo' );
            wp_deregister_style( 'selectWoo' );

            wp_dequeue_script( 'selectWoo');
            wp_deregister_script('selectWoo');
        }
    }

    // change state field
    public function woo_filter_fields_billing( $address_fields ) {
        $address_fields['billing_state']['required'] = false;
        return $address_fields;
    }

    // stripe
    public function my_theme_modify_stripe_fields_styles( $styles ) {
        return array(
            'base' => array(
                'fontWeight' => '300',
                'fontSize' => '20px',
                'lineHeight' => '20px',
                'textTransform' => 'uppercase',
                'color' => '#000',
                '::placeholder' => array(
                    'fontWeight' => '300',
                    'fontSize' => '20px',
                    'lineHeight' => '20px',
                    'textTransform' => 'uppercase',
                    'color' => '#8b8f92'
                )
            )
        );
    }

    // custom checkout fields
    public function custom_override_billing_checkout_fields($fields) {
        $fields['billing']['custom_nip'] = array(
            'type' => 'text',
            'class' => array(
                'form-row form-row-first delivery-steps-input half inpost_fields'
            ),
            'label' => __('NIP', \PS::$theme_name),
            'placeholder' => __('NIP', \PS::$theme_name),
            'required' => false
        );

        $fields['billing']['custom_locker'] = array(
            'type' => 'text',
            'class' => array(
                'form-row form-row-first delivery-steps-input half inpost_fields'
            ),
            'label' => __('Parcel locker', \PS::$theme_name),
            'placeholder' => __('Parcel locker', \PS::$theme_name),
            'required' => true
        );

        return $fields;
    }

    /*public function custom_checkout_field($checkout){
        echo '<div class="delivery-steps-container woocommerce-billing-fields__field-wrapper">';
            // nip
            woocommerce_form_field(
                'custom_nip',
                array(
                    'type' => 'text',
                    'class' => array(
                        'form-row form-row-first delivery-steps-input half inpost_fields'
                    ),
                    'label' => __('NIP', \PS::$theme_name),
                    'placeholder' => __('NIP', \PS::$theme_name)
                ),
                $checkout->get_value('custom_nip')
            );

            // parcel locker
            woocommerce_form_field(
                'custom_locker',
                array(
                    'type' => 'text',
                    'class' => array(
                        'form-row form-row-first delivery-steps-input half inpost_fields'
                    ),
                    'label' => __('Parcel locker', \PS::$theme_name) . ' *',
                    'placeholder' => __('Parcel locker', \PS::$theme_name) . ' *',
                    'required' => true
                ),
                $checkout->get_value('custom_locker')
            );
        echo '</div>';
    }*/
    public function custom_save_new_checkout_field( $order_id ) {
        if ( $_POST['custom_nip'] ){
            update_post_meta( $order_id, 'custom_nip', esc_attr( $_POST['custom_nip'] ) );
        }
        if ( $_POST['custom_locker'] ){
            update_post_meta( $order_id, 'custom_locker', esc_attr( $_POST['custom_locker'] ) );
        }
    }
    public function custom_show_new_checkout_field_order( $order ) {
        $order_id = $order->get_id();
        if ( get_post_meta( $order_id, 'custom_nip', true ) ) echo '<p><strong>NIP:</strong> ' . get_post_meta( $order_id, 'custom_nip', true ) . '</p>';
        if ( get_post_meta( $order_id, 'custom_locker', true ) ) echo '<p><strong>Parcel locker:</strong> ' . get_post_meta( $order_id, 'custom_locker', true ) . '</p>';
    }

    public function customised_checkout_field_process(){
        // change below for the method
        $shipping_method_inpost = 'flat_rate:3';
        $chosen_methods_inpost = WC()->session->get( 'chosen_shipping_methods' );
        $chosen_shipping_inpost = isset($chosen_methods_inpost[0]) ? $chosen_methods_inpost[0] : false;
        if ($chosen_shipping_inpost == $shipping_method_inpost) {
            if (!$_POST['custom_locker']) wc_add_notice(__('Parcel locker', \PS::$theme_name) . ' ' . __('is a required field.') , 'error');
        }
    }

    // hide some fields for local pickup
    public function hide_local_pickup_method( $fields_pickup ) {
        // change below for the method
        $shipping_method_pickup ='local_pickup:2';
        // change below for the list of fields. Add (or delete) the field name you want (or don’t want) to use
        $hide_fields_pickup = array( 'billing_company', 'billing_country', 'billing_postcode', 'billing_address_1', 'billing_address_2' , 'billing_city', 'billing_state');

        $chosen_methods_pickup = WC()->session->get( 'chosen_shipping_methods' );
        $chosen_shipping_pickup = isset($chosen_methods_pickup[0]) ? $chosen_methods_pickup[0] : false;

        foreach($hide_fields_pickup as $field_pickup ) {
            if ($chosen_shipping_pickup == $shipping_method_pickup) {
                $fields_pickup['billing'][$field_pickup]['required'] = false;
                $fields_pickup['billing'][$field_pickup]['class'][] = 'hide_pickup';

                unset( $fields_pickup[ 'billing' ][$field_pickup][ 'validate' ] );
            }
            $fields_pickup['billing'][$field_pickup]['class'][] = 'billing-dynamic_pickup';
        }
        return $fields_pickup;
    }

    // show some fields for inpost
    public function show_inpost_fields( $fields_inpost ) {
        // change below for the method
        $shipping_method_inpost = 'flat_rate:3';
        // change below for the list of fields. Add (or delete) the field name you want (or don’t want) to use
        $hide_fields_inpost = array( 'custom_nip', 'custom_locker' );

        $chosen_methods_inpost = WC()->session->get( 'chosen_shipping_methods' );
        $chosen_shipping_inpost = isset($chosen_methods_inpost[0]) ? $chosen_methods_inpost[0] : false;

        foreach($hide_fields_inpost as $field_inpost ) {
            if ($chosen_shipping_inpost !== $shipping_method_inpost) {
                $fields_inpost['billing'][$field_inpost]['required'] = false;
                $fields_inpost['billing'][$field_inpost]['class'][] = 'show_if_inpost';

                unset( $fields_inpost[ 'billing' ][$field_inpost][ 'validate' ] );
            }
        }
        return $fields_inpost;
    }

    // new order
    public function new_order( $order_id ) {
        // fix for paypal + pickup
        if(!get_post_meta($order_id, '_billing_city', true) || get_post_meta($order_id, '_billing_city', true) === '-'){
            update_post_meta($order_id, '_billing_city', 'Krakow');
        }
        if(!get_post_meta($order_id, '_billing_postcode', true) || get_post_meta($order_id, '_billing_postcode', true) === '-'){
            update_post_meta($order_id, '_billing_postcode', '31-515');
        }
        if(!get_post_meta($order_id, '_shipping_city', true) || get_post_meta($order_id, '_shipping_city', true) === '-'){
            update_post_meta($order_id, '_shipping_city', 'Krakow');
        }
        if(!get_post_meta($order_id, '_shipping_postcode', true) || get_post_meta($order_id, '_shipping_postcode', true) === '-'){
            update_post_meta($order_id, '_shipping_postcode', '31-515');
        }

        // send to CRM
        $Bitrix = new \PS\Functions\Crm\Bitrix();
        $Bitrix->send_order_to_bitrix($order_id);
    }

    // discounts
    public function woo_discount_total() {
        $currency = get_woocommerce_currency();
        $woo_current_price = WC()->cart->get_subtotal();

        if($currency === 'PLN'){
            if ($woo_current_price >= get_field('subtotal_pln_1', \PS::$option_page)) {
                $discount = $woo_current_price * (get_field('discount_pln_1', \PS::$option_page) / 100); // 20%
                WC()->cart->add_fee('-' . get_field('discount_pln_1', \PS::$option_page) . '% ' . __('from', \PS::$theme_name) . ' ' . get_field('subtotal_pln_1', \PS::$option_page) . ' ' . $currency, -$discount);
            } elseif ($woo_current_price >= get_field('subtotal_pln_2', \PS::$option_page)) {
                $discount = $woo_current_price * (get_field('discount_pln_2', \PS::$option_page) / 100); // 15%
                WC()->cart->add_fee('-' . get_field('discount_pln_2', \PS::$option_page) . '% ' . __('from', \PS::$theme_name) . ' ' . get_field('subtotal_pln_2', \PS::$option_page) . ' ' . $currency, -$discount);
            }
        }elseif($currency === 'EUR' || $currency === 'USD'){
            if ($woo_current_price >= get_field('subtotal_other_1', \PS::$option_page)) {
                $discount = $woo_current_price * (get_field('discount_other_1', \PS::$option_page) / 100); // 20%
                WC()->cart->add_fee('-' . get_field('discount_other_1', \PS::$option_page) . '% ' . __('from', \PS::$theme_name) . ' ' . get_field('subtotal_other_1', \PS::$option_page) . ' ' . $currency, -$discount);
            } elseif ($woo_current_price >= get_field('subtotal_other_2', \PS::$option_page)) {
                $discount = $woo_current_price * (get_field('discount_other_2', \PS::$option_page) / 100); // 15%
                WC()->cart->add_fee('-' . get_field('discount_other_2', \PS::$option_page) . '% ' . __('from', \PS::$theme_name) . ' ' . get_field('subtotal_other_2', \PS::$option_page) . ' ' . $currency, -$discount);
            }
        }
    }
    /* END */

}
