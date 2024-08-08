<?php if(!defined('ABSPATH')){ exit(); }

// init template
require_once get_template_directory() . '/framework/init.php';
// Отображение значения метаполя продукта на странице продукта


// Inserting a Custom Admin Field
add_action( 'woocommerce_product_options_sku', 'add_custom_text_field_create' );
function add_custom_text_field_create() {
    echo '<div class="options_group">';

    woocommerce_wp_text_input( array(
        'type'              => 'text',
        'id'                => 'EAN13',
        'label'             => __( 'EAN13', 'woocommerce' )
    ) );
    woocommerce_wp_text_input( array(
        'type'              => 'text',
        'id'                => 'produkt_Kod_kreskowy',
        'label'             => __( 'produkt_Kod_kreskowy', 'woocommerce' )
    ) );

    echo '</div>';
}

// Saving the field value when submitted
add_action( 'woocommerce_process_product_meta', 'add_custom_field_text_save' );
function add_custom_field_text_save( $post_id ){
    if( !empty( $_POST['EAN13'] ) )
        update_post_meta( $post_id, 'EAN13', esc_attr( $_POST['EAN13'] ) );

    if( !empty( $_POST['produkt_Kod_kreskowy'] ) )
        update_post_meta( $post_id, 'produkt_Kod_kreskowy', esc_attr( $_POST['produkt_Kod_kreskowy'] ) );
}