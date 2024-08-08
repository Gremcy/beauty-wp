<?php

namespace PS\Functions\Post_Types;

/**
 * Class Advices
 * @package PS\Functions\Post_Types
 */
class Advices {

    /**
     * constructor
     */
    public function __construct() {
        add_action( 'init', array( $this, 'register_post_type' ) );
        add_action( 'init', array( $this, 'register_taxonomies' ), 0 );
    }

    /**
     * post type
     */
    public function register_post_type() {
        $labels = array(
            'name'               => __( 'Advices', \PS::$theme_name ),
            'add_new'            => __( 'Add advice', \PS::$theme_name ),
            'new_item'           => __( 'New advice', \PS::$theme_name )
        );

        $args = array(
            'labels'             => $labels,
            'show_ui'             => true,
            'public'              => true,
            'publicly_queryable'  => true,
            'exclude_from_search' => false,
            'hierarchical'        => false,
            'query_var'           => true,
            'supports'            => array( 'title' ),
            'has_archive'         => false
        );

        register_post_type( 'advices', $args );
    }

    public function register_taxonomies(){
        $labels = array(
            'name'              => __( 'Categories', \PS::$theme_name ),
            'add_new_item'      => __( 'Add category', \PS::$theme_name ),
            'new_item_name'     => __( 'New category', \PS::$theme_name )
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_admin_column' => true
        );

        register_taxonomy( 'advices_tags', 'advices', $args );
    }
}