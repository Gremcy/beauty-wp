<?php

namespace PS\Functions\Admin;

/**
 * Class Columns
 * @package PS\Functions\Admin
 */
class Columns {

    /**
     * constructor
     */
    public function __construct() {
        // advices
        add_filter('manage_edit-advices_columns', array( $this, 'columns_head_only_advices'), 15);
        add_filter('manage_advices_posts_custom_column', array( $this, 'columns_content_only_advices'), 10, 2);

        // instructors
        add_filter('manage_edit-instructors_columns', array( $this, 'columns_head_only_instructors'), 15);
        add_filter('manage_instructors_posts_custom_column', array( $this, 'columns_content_only_instructors'), 10, 2);

        // contact us
        add_filter('manage_edit-letter_columns', array( $this, 'columns_head_only_letter'), 15);
        add_filter('manage_letter_posts_custom_column', array( $this, 'columns_content_only_letter'), 10, 2);

        // questionnaire
        add_filter('manage_edit-questionnaire_columns', array( $this, 'columns_head_only_questionnaire'), 15);
        add_filter('manage_questionnaire_posts_custom_column', array( $this, 'columns_content_only_questionnaire'), 10, 2);

        // partner
        add_filter('manage_edit-partner_columns', array( $this, 'columns_head_only_letter'), 15);
        add_filter('manage_partner_posts_custom_column', array( $this, 'columns_content_only_letter'), 10, 2);

        // ambassador
        add_filter('manage_edit-ambassador_columns', array( $this, 'columns_head_only_letter'), 15);
        add_filter('manage_ambassador_posts_custom_column', array( $this, 'columns_content_only_letter'), 10, 2);

        // coupons
        add_filter('manage_edit-coupons_columns', array( $this, 'columns_head_only_coupons'), 15);
        add_filter('manage_coupons_posts_custom_column', array( $this, 'columns_content_only_coupons'), 10, 2);
    }

    /**
     * advices
     */
    public function columns_head_only_advices($defaults) {
        unset($defaults['title']);
        unset($defaults['taxonomy-advices_tags']);
        unset($defaults['date']);
        $defaults['img'] = 'Image';
        $defaults['title'] = 'Title';
        $defaults['taxonomy-advices_tags'] = 'Category';
        $defaults['date'] = 'Date';
        return $defaults;
    }

    public function columns_content_only_advices($column_name, $post_ID) {
        // image
        if ($column_name == 'img') {
            $img = get_field('img', $post_ID);
            echo (is_array($img) ? "<img src='" . $img['sizes']['100x100'] . "'>" : "-");
        }
    }

    /**
     * instructors
     */
    public function columns_head_only_instructors($defaults) {
        unset($defaults['title']);
        unset($defaults['date']);
        $defaults['img'] = 'Image';
        $defaults['title'] = 'Title';
        $defaults['type'] = 'Type';
        $defaults['date'] = 'Date';
        return $defaults;
    }

    public function columns_content_only_instructors($column_name, $post_ID) {
        // image
        if ($column_name == 'img') {
            $img = get_field('img', $post_ID);
            echo (is_array($img) ? "<img src='" . $img['sizes']['100x100'] . "'>" : "-");
        }
        // type
        elseif ($column_name == 'type') {
            $type = get_field('type', $post_ID);
            echo $type === 'masters' ? 'Masters' : 'Instructors';
        }
    }

    /**
     * contact us / partner / ambassador
     */
    public function columns_head_only_letter($defaults) {
        unset($defaults['title']);
        unset($defaults['date']);
        $defaults['title'] = __( 'ID', \PS::$theme_name );
        $defaults['name'] = __( 'Name', \PS::$theme_name );
        $defaults['email'] = __( 'E-mail', \PS::$theme_name );
        $defaults['phone'] = __( 'Phone', \PS::$theme_name );
        $defaults['country'] = __( 'Country', \PS::$theme_name );
        $defaults['date'] = __( 'Date', \PS::$theme_name );
        return $defaults;
    }

    public function columns_content_only_letter($column_name, $post_ID) {
        // name
        if ($column_name == 'name') {
            echo get_field('name', $post_ID);
        }
        // email
        elseif ($column_name == 'email') {
            echo get_field('email', $post_ID);
        }
        // phone
        elseif ($column_name == 'phone') {
            echo get_field('phone', $post_ID);
        }
        // country
        elseif ($column_name == 'country') {
            echo get_field('country', $post_ID);
        }
    }

    /**
     * questionnaire
     */
    public function columns_head_only_questionnaire($defaults) {
        unset($defaults['title']);
        unset($defaults['date']);
        $defaults['title'] = __( 'ID', \PS::$theme_name );
        $defaults['course'] = __( 'Course / master', \PS::$theme_name );
        $defaults['name'] = __( 'Name', \PS::$theme_name );
        $defaults['email'] = __( 'E-mail', \PS::$theme_name );
        $defaults['phone'] = __( 'Phone', \PS::$theme_name );
        $defaults['country'] = __( 'Country', \PS::$theme_name );
        $defaults['date'] = __( 'Date', \PS::$theme_name );
        return $defaults;
    }

    public function columns_content_only_questionnaire($column_name, $post_ID) {
        // сourse
        if ($column_name == 'course') {
            echo get_field('course', $post_ID);
        }
        // name
        elseif ($column_name == 'name') {
            echo get_field('name', $post_ID);
        }
        // email
        elseif ($column_name == 'email') {
            echo get_field('email', $post_ID);
        }
        // phone
        elseif ($column_name == 'phone') {
            echo get_field('phone', $post_ID);
        }
        // country
        elseif ($column_name == 'country') {
            echo get_field('country', $post_ID);
        }
    }

    /**
     * coupons
     */
    public function columns_head_only_coupons($defaults) {
        unset($defaults['title']);
        unset($defaults['date']);
        $defaults['title'] = __( 'ID', \PS::$theme_name );
        $defaults['coupon'] = __( 'Coupon', \PS::$theme_name );
        $defaults['name'] = __( 'Name', \PS::$theme_name );
        $defaults['email'] = __( 'E-mail', \PS::$theme_name );
        $defaults['phone'] = __( 'Phone', \PS::$theme_name );
        $defaults['country'] = __( 'Country', \PS::$theme_name );
        $defaults['date'] = __( 'Date', \PS::$theme_name );
        return $defaults;
    }

    public function columns_content_only_coupons($column_name, $post_ID) {
        // coupon
        if ($column_name == 'coupon') {
            echo get_field('coupon', $post_ID);
        }
        // name
        elseif ($column_name == 'name') {
            echo get_field('name', $post_ID);
        }
        // email
        elseif ($column_name == 'email') {
            echo get_field('email', $post_ID);
        }
        // phone
        elseif ($column_name == 'phone') {
            echo get_field('phone', $post_ID);
        }
        // country
        elseif ($column_name == 'country') {
            echo get_field('country', $post_ID);
        }
    }

}