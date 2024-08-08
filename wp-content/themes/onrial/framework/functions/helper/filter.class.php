<?php

namespace PS\Functions\Helper;

/**
 * Class Filter
 * @package PS\Functions\Helper
 */
class Filter {

    /**
     * constructor
     */
    public function __construct() {
        add_action( 'pre_get_posts', array( $this, 'my_pre_get_posts') );
    }


    public function my_pre_get_posts( $query ) {

        // front
        if ( ! is_admin() && $query->is_main_query() ) {

            // search
            if ( is_search() ) {
                // posts per page
                $query->set('nopaging', true);

                // sorting
                $query->set('orderby', 'menu_order');
                $query->set('order', 'ASC');
            }

        }

        // return
        return $query;
    }

}