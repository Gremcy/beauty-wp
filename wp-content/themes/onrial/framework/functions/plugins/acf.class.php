<?php

namespace PS\Functions\Plugins;

/**
 * Class ACF
 * @package PS\Functions\Plugins
 */
class ACF {

    /**
     * constructor
     */
    public function __construct() {
        // option page
        add_action('init', array( $this, 'register_option_page' ), 20);
		
        // translating
        add_filter('acf/prepare_field/type=text', array( $this, 'my_acf_prepare_field' ));
        add_filter('acf/prepare_field/type=textarea', array( $this, 'my_acf_prepare_field' ));
		
        // fix for object/relationship fields
        add_filter('acf/fields/post_object/query', array( $this, 'fix_relationship_query'), 10, 3);
        add_filter('acf/fields/relationship/query', array( $this, 'fix_relationship_query'), 10, 3);
		
        // fix for translating of object/relationship field
        add_filter('acf/fields/post_object/result', array( $this, 'my_relationship_result'), 10, 4);
        add_filter('acf/fields/relationship/result', array( $this, 'my_relationship_result'), 10, 4);

        // wysiwyg field
        add_filter( 'acf/fields/wysiwyg/toolbars', array( $this, 'my_toolbars') );
    }

    /**
     * Option page
     */
    public function register_option_page(){
        if( function_exists('acf_add_options_page') ) {
            acf_add_options_page(array(
                'page_title' 	=> __( 'Settings', \PS::$theme_name ),
                'menu_slug' 	=> 'other'
            ));
        }
    }

    /**
     * Translating
     */
    public function my_acf_prepare_field( $field ) {
        if(isset($field['wrapper']['class'])){
            $class_arr = explode(' ', $field['wrapper']['class']);
            if( !in_array('not_translate_it', $class_arr)) {
                $field['class'] = 'i18n-multilingual';
            }
        }
        return $field;
    }

    /**
     * Fix relationship/object query
     */
    public function fix_relationship_query( $args, $field, $post_id ) {
        // remove itself
        $args['post__not_in'] = array($post_id);
        // return
        return $args;
    }

    /**
     * Fix for translating of object/relationship field
     */
    public function my_relationship_result( $title, $post, $field, $post_id ) {
        // check for qtranlate format
        if(stripos($title, '[:') !== false){
            $title = substr($title, 5, stripos($title, '[:', 5) - 5);
        }
        // return
        return $title;
    }

    /**
     * Wysiwyg field
     */
    public function my_toolbars( $toolbars ){
        // change
        $toolbars['Basic'][1] = [
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'forecolor',
            'link',
            'pastetext',
            'removeformat'
        ];

        $toolbars['Full'][1] = [
            'formatselect',
            'bold',
            'italic',
            'underline',
            'strikethrough',
            'forecolor',
            'alignleft',
            'aligncenter',
            'alignright',
            'bullist',
            'numlist',
            'link',
            'pastetext',
            'removeformat'
        ];
        $toolbars['Full'][2] = [];

        return $toolbars;
    }

}