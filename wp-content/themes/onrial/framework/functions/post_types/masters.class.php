<?php

namespace PS\Functions\Post_Types;

/**
 * Class Masters
 * @package PS\Functions\Post_Types
 */
class Masters {

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
            'name'               => __( 'Masters', \PS::$theme_name ),
            'add_new'            => __( 'Add master', \PS::$theme_name ),
            'new_item'           => __( 'New master', \PS::$theme_name )
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

        register_post_type( 'masters', $args );
    }

    public function register_taxonomies(){
        // regions
        $labels = array(
            'name'              => __( 'Regions', \PS::$theme_name ),
            'add_new_item'      => __( 'Add region', \PS::$theme_name ),
            'new_item_name'     => __( 'New region', \PS::$theme_name )
        );

        $args = array(
            'hierarchical'      => false,
            'labels'            => $labels,
            'show_admin_column' => true
        );

        register_taxonomy( 'school_regions', 'masters', $args );
    }
}