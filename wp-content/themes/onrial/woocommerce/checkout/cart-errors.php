<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-error product-right-info-settings">
    <img src="<?php echo \PS::$assets_url; ?>images/icon29.svg" alt="">
    <span>
        <?php esc_html_e( 'There are some issues with the items in your cart. Please go back to the cart page and resolve these issues before checking out.', 'woocommerce' ); ?>
    </span>
</div>

<?php do_action( 'woocommerce_cart_has_errors' ); ?>