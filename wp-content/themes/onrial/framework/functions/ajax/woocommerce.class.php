<?php

namespace PS\Functions\Ajax;

/**
 * Class Woocommerce
 * @package     PS\Functions\Ajax
 * @since       1.0.0
 */
class Woocommerce {

    public function __construct() {
        /* CART */

        // add to cart
        add_action( 'wp_ajax_update_cart', array( $this, 'update_cart' ) );
        add_action( 'wp_ajax_nopriv_update_cart', array( $this, 'update_cart' ) );

        // change quantity / remove
        add_action( 'wp_ajax_change_quantity_in_cart', array( $this, 'change_quantity_in_cart' ) );
        add_action( 'wp_ajax_nopriv_change_quantity_in_cart', array( $this, 'change_quantity_in_cart' ) );

        /* COUPONS */

        // apply coupon
        add_action( 'wp_ajax_apply_coupon', array( $this, 'apply_coupon' ) );
        add_action( 'wp_ajax_nopriv_apply_coupon', array( $this, 'apply_coupon' ) );

        // remove coupon
        add_action( 'wp_ajax_remove_coupon', array( $this, 'remove_coupon' ) );
        add_action( 'wp_ajax_nopriv_remove_coupon', array( $this, 'remove_coupon' ) );

        /* OTHER */
        // favourite
        add_action( 'wp_ajax_toggle_favourite', array( $this, 'toggle_favourite' ) );
        add_action( 'wp_ajax_nopriv_toggle_favourite', array( $this, 'toggle_favourite' ) );
    }

    /* CART */

    // add to cart
    public function update_cart() {
        ob_start();

        $type = $_POST['type'];

        echo json_encode(
            [
                'quantity' => WC()->cart->get_cart_contents_count(),
                'sum' => WC()->cart->get_cart_subtotal(),
                'minicart' => do_shortcode('[' . $type . ']')
            ]
        );
        exit();
    }

    // change quantity / remove
    function change_quantity_in_cart(){
        ob_start();

        $type = $_POST['type'];
        $cart_item_key = $_POST['cart_item_key'];
        $quantity = (int)$_POST['quantity'];
        if($cart_item_key){
            WC()->cart->set_quantity($cart_item_key, $quantity);
        }

        echo json_encode(
            [
                'quantity' => WC()->cart->get_cart_contents_count(),
                'sum' => WC()->cart->get_cart_subtotal(),
                'minicart' => do_shortcode('[' . $type . ']')
            ]
        );
        exit();
    }

    /* COUPONS */

    // apply coupon
    public function apply_coupon() {
        $success = false;
        ob_start();

        // check coupon
        $is_valid = false;
        $coupon_code = wp_strip_all_tags($_POST['coupon'], true);
        if($coupon_code){
            $coupon = new \WC_Coupon( $coupon_code );
            $discounts = new \WC_Discounts( WC()->cart );
            $response = $discounts->is_coupon_valid( $coupon );
            $is_valid = is_wp_error( $response ) ? false : true;
            if($is_valid){
                WC()->cart->remove_coupons();
                $success = WC()->cart->apply_coupon($coupon_code);
            }
        }

        // return
        echo json_encode(
            [
                'success' => $success,
                'quantity' => WC()->cart->get_cart_contents_count(),
                'sum' => WC()->cart->get_cart_subtotal(),
                'minicart' => do_shortcode('[minicart]')
            ]
        );
        exit();
    }

    // remove coupon
    public function remove_coupon() {
        ob_start();

        // remove coupon
        WC()->cart->remove_coupons();

        // return
        echo json_encode(
            [
                'success' => true,
                'quantity' => WC()->cart->get_cart_contents_count(),
                'sum' => WC()->cart->get_cart_subtotal(),
                'minicart' => do_shortcode('[minicart]')
            ]
        );
        exit();
    }

    /* OTHER */

    // add to favorite function
    function toggle_favourite() {
        $product_id = $_POST['product_id'] ?? false;
        
        $favs = \PS\Functions\Helper\Helper::get_favorite_ids();
        

        if ($product_id) {
            if( in_array($product_id, $favs) )
                $favs = array_diff($favs, [$product_id]);
            else
                array_push($favs, $product_id);

            $favs = array_unique($favs);

            $result = \PS\Functions\Helper\Helper::set_favorite_ids($favs);


            echo json_encode(["success" => $result]);
            exit;
        }

        echo json_encode(["success" => false]);
        exit;
    }
    
    // delete from favorite function
    function rm_favorite() {
        $post_id = (int)$_POST['post_id'];
        if (!empty($post_id)) {
            $favorite_id_array = favorite_id_array();
            if (($delete_post_id = array_search($post_id, $favorite_id_array)) !== false) {
                unset($favorite_id_array[$delete_post_id]);
            }
            setcookie('favorite_post_ids', implode(',', $favorite_id_array) , time() + 3600 * 24 * 30, '/');
            echo count($favorite_id_array);
        }
        die();
    }
}