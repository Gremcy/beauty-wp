<?php

namespace PS\Functions\Post_Types;

/**
 * Class Coupons
 * @package PS\Functions\Post_Types
 */
class Coupons {

    /**
     * constructor
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'admin_menu', array( $this, 'count_new_post' ) );
    }

    /**
     * post type
     */
    public function register_post_type() {
        $labels = array(
            'name'               => __( 'Coupons', \PS::$theme_name ),
            'add_new'            => __( 'Add coupon', \PS::$theme_name ),
            'new_item'           => __( 'New coupon', \PS::$theme_name )
        );

        $args = array(
            'labels'             => $labels,
            'show_ui'             => true,
            'public'              => false,
            'publicly_queryable'  => false,
            'exclude_from_search' => true,
            'hierarchical'        => false,
            'query_var'           => false,
            'supports'            => array( 'title' ),
            'has_archive'         => false
        );

        register_post_type( 'coupons', $args );
    }

    /**
     * quantity
     */
    public function count_new_post() {
        global $menu, $wpdb;
        $count = $wpdb->get_var( "SELECT COUNT(ID) FROM {$wpdb->posts} WHERE post_type = 'coupons' and post_status = 'publish'" );
        foreach ($menu as $key => $item) {
            if ($item[2] == 'edit.php?post_type=coupons') {
                $menu[$key][0] .= " <span class='awaiting-mod count-{$count}'><span class='pending-count'>{$count}</span></span>";
            }
        }
    }

}