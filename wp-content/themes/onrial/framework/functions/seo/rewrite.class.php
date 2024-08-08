<?php

namespace PS\Functions\Seo;

/**
 * Class Rewrite
 * @package PS\Functions\Seo
 */
class Rewrite {

    /**
     * constructor
     */
    public function __construct() {
        // query_vars
        add_filter( 'query_vars', array( $this, 'add_query_vars_filter') );

        // rewrite
        add_action('init', array( $this, 'custom_rewrite_rule' ), 10, 0);
    }

    /**
     * query vars
     */
    public function add_query_vars_filter( $vars ) {
        $vars[] = 'section';

        // return
        return $vars;
    }

    /**
     * Правила перезаписи
     */
    public function custom_rewrite_rule() {
        // advices
        add_rewrite_rule('^advices/filter/([^/]*)/?$','index.php?page_id=' . \PS::$advices_page . '&section=$matches[1]','top');

        // advices
        add_rewrite_rule('^school/masters/?$','index.php?page_id=' . \PS::$school_page . '&section=masters','top');
        add_rewrite_rule('^school/instructors/?$','index.php?page_id=' . \PS::$school_page . '&section=instructors','top');
    }
}