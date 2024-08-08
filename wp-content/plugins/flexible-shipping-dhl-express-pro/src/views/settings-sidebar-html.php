<?php
/**
 * Settings sidebar.
 *
 * @package WPDesk\FlexibleShippingDhlExpressPro
 *
 * @var $url string .
 */

?>
<div class="wpdesk-metabox">
	<div class="wpdesk-stuffbox">
		<h3 class="title"><?php esc_html_e( 'Hide shipping method based on:', 'flexible-shipping-dhl-express-pro' ); ?></h3>
		<div class="inside">
			<div class="main">
				<ul>
					<li>
						<span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Products', 'flexible-shipping-dhl-express-pro' ); ?>
					</li>
					<li>
						<span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Shipping Class', 'flexible-shipping-dhl-express-pro' ); ?>
					</li>
					<li>
						<span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Cart weight', 'flexible-shipping-dhl-express-pro' ); ?>
					</li>
					<li>
						<span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Cart value', 'flexible-shipping-dhl-express-pro' ); ?>
					</li>
					<li>
						<span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Time (Day/Hour)', 'flexible-shipping-dhl-express-pro' ); ?>
					</li>
					<li>
						<span class="dashicons dashicons-yes"></span> <?php esc_html_e( 'Location', 'flexible-shipping-dhl-express-pro' ); ?>
					</li>
				</ul>

				<a class="button button-primary" href="<?php echo esc_attr( $url ); // @phpstan-ignore-line ?>"
				   target="_blank"><?php esc_html_e( 'Get Conditional Shipping Methods →', 'flexible-shipping-dhl-express-pro' ); ?></a>
			</div>
		</div>
	</div>
</div>
