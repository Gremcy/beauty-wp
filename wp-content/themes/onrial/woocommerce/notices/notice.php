<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! $notices ) {
	return;
}
?>

<?php foreach ( $notices as $notice ) : ?>
    <div class="woocommerce-error product-right-info-settings"<?php echo wc_get_notice_data_attr( $notice ); ?>>
        <img src="<?php echo \PS::$assets_url; ?>images/icon29.svg" alt="">
		<?php echo wc_kses_notice( $notice['notice'] ); ?>
	</div>
<?php endforeach; ?>
