<?php

namespace PS\Functions\Helper;

/**
 * Class Helper
 * @package PS\Functions\Helper
 * @since   1.0.0
 */
class Helper {

    /**
     * Init constructor.
     */
    public function __construct() {
        //
    }

    /**
     ******* GENERAL *******
     */
	 
	 // get posts by args
    public static function get_posts( $post_type, $post_status = 'publish', $posts_per_page = -1, $paged = 1, $meta_query = array(), $tax_query = array(), $post__in = array(), $post__not_in = array(), $orderby = 'menu_order', $order = 'ASC' ) {
        $args['post_type']      = $post_type;
        $args['post_status']    = $post_status;
        $args['posts_per_page'] = $posts_per_page;
        $args['paged'] = $paged;
        if ( count( $meta_query ) ) {
            $args['meta_query'] = $meta_query;
        }
        if ( count( $tax_query ) ) {
            $args['tax_query'] = $tax_query;
        }
        if ( count( $post__in ) ) {
            $args['post__in'] = $post__in;
        }
        if ( count( $post__not_in ) ) {
            $args['post__not_in'] = $post__not_in;
        }
        if($orderby){
            $args['orderby'] = $orderby;
        }
        if($order){
            $args['order'] = $order;
        }
        return query_posts( $args );
    }

    // count favorite posts
    public static function count_favorite_ids() { 
        $favs = [];

        if(get_current_user_id()) {
            $favs = self::get_favorite_ids();
        }
        
        return count($favs);
    }

    // favorite posts array
    public static function get_favorite_ids() { 
        $favs = [];

        if(get_current_user_id()) {
            $favs = get_user_meta(get_current_user_id(), 'favourite_products', true);
            
            if(empty($favs))
            	$favs = [];
        }
        
        return $favs;
    }
    /**
     * $fav_ids - Array of IDs for saving new Favourites
     */
    //set favorite posts array
    public static function set_favorite_ids($favs) {
        if(get_current_user_id()) {
            return update_user_meta(get_current_user_id(), 'favourite_products', $favs);
        }
        
        return false;
    }

    /**
     ******* FRONT PAGE *******
     */

    // get bestsellers
    public static function get_products($post__in){
        // return
        return \PS\Functions\Helper\Helper::get_posts(
            'product',
            'publish',
            -1,
            1,
            [],
            [],
            is_array($post__in) && count($post__in) ? $post__in : [0],
            [],
            'rand'
        );
    }

    // get advices
    public static function get_mainpage_advices(){
        // return
        return \PS\Functions\Helper\Helper::get_posts(
            'advices',
            'publish',
            3,
            1,
            [],
            [],
            [],
            [],
            'date',
            'DESC'
        );
    }
	
	/**
     ******* ADVICES *******
     */

    // get advices
    public static function get_advices($current_tag = false){
        // return
        return \PS\Functions\Helper\Helper::get_posts(
            'advices',
            'publish',
            -1,
            1,
            [],
            $current_tag ? [
                [
                    'taxonomy' => 'advices_tags',
                    'field'    => 'slug',
                    'terms'    => $current_tag
                ]
            ] : [],
            [],
            [],
            'date',
            'DESC'
        );
    }

    /**
     ******* SCHOOL *******
     */

    // get masters
    public static function get_school($post_type, $type = ''){
        $meta_query = [];
        if($type){
            $meta_query[] = [
                'key' => 'type',
                'value' => $type
            ];
        }

        // return
        return \PS\Functions\Helper\Helper::get_posts(
            $post_type,
            'publish',
            -1,
            1,
            $meta_query
        );
    }

    /**
     * SEARCH
     */

    // search page
    public static function search_results($search){
        global $wpdb;
        $return = [];

        // search
        if($search){
            $return = $wpdb->get_col("SELECT DISTINCT ID FROM {$wpdb->posts} WHERE post_type = 'product' AND post_status = 'publish' AND post_title LIKE '%{$search}%' ORDER BY menu_order ASC");
        }

        return $return;
    }

    // get search products
    public static function search_products($post__in){
        // return
        return \PS\Functions\Helper\Helper::get_posts(
            'product',
            'publish',
            -1,
            1,
            [],
            [],
            is_array($post__in) && count($post__in) ? $post__in : [0]
        );
    }

    // get random products
    public static function get_random_products(){
        // return
        return \PS\Functions\Helper\Helper::get_posts(
            'product',
            'publish',
            6,
            1,
            [],
            [],
            [],
            [],
            'rand'
        );
    }
	
}