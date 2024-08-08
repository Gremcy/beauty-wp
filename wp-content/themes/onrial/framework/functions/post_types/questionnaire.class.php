<?php

namespace PS\Functions\Post_Types;

/**
 * Class Questionnaire
 * @package PS\Functions\Post_Types
 */
class Questionnaire {

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
            'name'               => __( 'Questionnaire', \PS::$theme_name ),
            'add_new'            => __( 'Add questionnaire', \PS::$theme_name ),
            'new_item'           => __( 'New questionnaire', \PS::$theme_name )
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

        register_post_type( 'questionnaire', $args );
    }

    /**
     * quantity
     */
    public function count_new_post() {
        global $menu, $wpdb;
        $count = $wpdb->get_var( "SELECT COUNT(ID) FROM {$wpdb->posts} WHERE post_type = 'questionnaire' and post_status = 'publish'" );
        foreach ($menu as $key => $item) {
            if ($item[2] == 'edit.php?post_type=questionnaire') {
                $menu[$key][0] .= " <span class='awaiting-mod count-{$count}'><span class='pending-count'>{$count}</span></span>";
            }
        }
    }

}