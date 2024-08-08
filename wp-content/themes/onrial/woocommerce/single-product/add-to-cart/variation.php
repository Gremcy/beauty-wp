<?php
defined( 'ABSPATH' ) || exit;
?>
<script type="text/template" id="tmpl-variation-template">
    <#  if (data.variation.price_html) { #>
        <div class="product-right-options">
            <div class="product-right-options-size"></div>
            <div class="product-right-options-price woocommerce-variation-price">{{{ data.variation.price_html }}}</div>
        </div>
    <# } #>
</script>
<script type="text/template" id="tmpl-unavailable-variation-template">
    <div class="product-right-info-settings">
        <img src="<?php echo \PS::$assets_url; ?>images/icon29.svg" alt="">
        <span><?php esc_html_e( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ); ?></span>
    </div>
</script>