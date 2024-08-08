<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}
?>

<div class="woocommerce-error product-right-info-settings">
    <img src="<?php echo \PS::$assets_url; ?>images/icon29.svg" alt="">
    <?php foreach ( $notices as $m => $notice ) : ?>
        <?php if($m === 0): ?>
            <span<?php echo wc_get_notice_data_attr( $notice ); ?>>
                <?php echo wc_kses_notice( $notice['notice'] ); ?>
            </span>
        <?php endif; ?>
    <?php endforeach; ?>
</div>