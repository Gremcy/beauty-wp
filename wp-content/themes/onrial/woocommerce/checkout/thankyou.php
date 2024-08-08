<?php
defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

            <div class="delivery-wrong" style="display: flex">
                <div class="delivery-wrong-icon">
                    <img src="<?php echo \PS::$assets_url; ?>images/icon6.svg" alt="">
                </div>
                <div class="delivery-wrong-title"><?php _e( 'Something went wrong', \PS::$theme_name ); ?></div>
                <div class="delivery-wrong-description"><?php _e( 'Try again', \PS::$theme_name ); ?><br><?php _e( 'or contact with your bank', \PS::$theme_name ); ?></div>
                <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>" class="delivery-congratulations-btn"><?php _e( 'Back to the store', \PS::$theme_name ); ?></a>
            </div>

		<?php else : ?>

            <div class="delivery-congratulations" style="display: flex">
                <div class="delivery-congratulations-icon">
                    <img src="<?php echo \PS::$assets_url; ?>images/check-icon3.svg" alt="">
                </div>
                <div class="delivery-congratulations-title"><?php _e( 'Congratulations!', \PS::$theme_name ); ?></div>
                <div class="delivery-congratulations-description"><?php _e( 'Your order has been received', \PS::$theme_name ); ?></div>
                <div class="delivery-congratulations-text">
                    <?php esc_html_e( 'Order number:', 'woocommerce' ); ?> <strong><?php echo $order->get_order_number(); ?></strong><br>
                    <?php _e( 'The order confirmation was sent on your e-mail.', \PS::$theme_name ); ?>
                </div>
                <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>" class="delivery-congratulations-btn"><?php _e( 'Back to the store', \PS::$theme_name ); ?></a>
            </div>

		<?php endif; ?>

	<?php else : ?>

        <div class="delivery-congratulations" style="display: flex">
            <div class="delivery-congratulations-icon">
                <img src="<?php echo \PS::$assets_url; ?>images/check-icon3.svg" alt="">
            </div>
            <div class="delivery-congratulations-title"><?php _e( 'Congratulations!', \PS::$theme_name ); ?></div>
            <div class="delivery-congratulations-description"><?php _e( 'Your order has been received', \PS::$theme_name ); ?></div>
            <div class="delivery-congratulations-text">
                <?php _e( 'The order confirmation was sent on your e-mail.', \PS::$theme_name ); ?>
            </div>
            <a href="<?php echo get_the_permalink(\PS::$shop_page); ?>" class="delivery-congratulations-btn"><?php _e( 'Back to the store', \PS::$theme_name ); ?></a>
        </div>

	<?php endif; ?>

</div>
