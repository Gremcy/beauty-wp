<?php

namespace PS\Functions\Ajax;

/**
 * Class Search
 * @package     PS\Functions\Ajax
 * @since       1.0.0
 */
class Search {

    public function __construct() {
        add_action( 'wp_ajax_search_of_items', array( $this, 'search_of_items' ) );
        add_action( 'wp_ajax_nopriv_search_of_items', array( $this, 'search_of_items' ) );
    }

    /**
     * search
     */
    public function search_of_items() {
        ob_start();

        $s = wp_strip_all_tags($_POST['search'], true);

        global $wp_query;
        \PS\Functions\Helper\Helper::search_products(\PS\Functions\Helper\Helper::search_results($s));
        $custom_query = $wp_query;

        include(locate_template('parts/elements/search.php'));
        $html = ob_get_clean();

        echo json_encode(
            array(
                'success' => true,
                'html'   => $html
            ),
            JSON_UNESCAPED_UNICODE
        );
        exit();
    }
}