<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<li class="delivery-chose-method-item wc_payment_method payment_method_<?php echo esc_attr( $gateway->id ); ?>">
	<input id="payment_method_<?php echo esc_attr( $gateway->id ); ?>" type="radio" class="delivery-steps-checkbox input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label class="delivery-steps-methods-item delivery-steps-checkbox-label" for="payment_method_<?php echo esc_attr( $gateway->id ); ?>">
        <div class="delivery-chose-method-item-inner">
            <div class="delivery-chose-method-item-left">
                <?php if($gateway->id === 'stripe'): ?>
                    <div class="delivery-chose-method-item-left-icon">
                        <img src="<?php echo \PS::$assets_url; ?>images/stripe.svg" alt="">
                    </div>
                <?php elseif($gateway->id === 'ppcp-gateway'): ?>
                    <div class="delivery-chose-method-item-left-icon">
                        <img src="<?php echo \PS::$assets_url; ?>images/pp.svg" alt="">
                    </div>
                <?php elseif($gateway->id === 'transferuj'): ?>
                    <div class="delivery-chose-method-item-left-icon">
                        <img src="<?php echo \PS::$assets_url; ?>images/blik.svg" alt="">
                    </div>
                <?php endif; ?>
                <div class="delivery-chose-method-item-left-name"><?php echo $gateway->get_title(); ?></div>
            </div>
        </div>
	</label>

	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo esc_attr( $gateway->id ); ?>" <?php if ( ! $gateway->chosen ) : /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>style="display:none;"<?php endif; /* phpcs:ignore Squiz.ControlStructures.ControlSignature.NewlineAfterOpenBrace */ ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>


<input type="radio" name="direction" id="var-5" class="delivery-steps-checkbox">
