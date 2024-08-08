<!DOCTYPE html>
<html lang="<?php echo \PS::$current_language; ?>">
<head>
    <meta charset="UTF-8">

	<title><?php $wp_title = wp_title('', false); echo $wp_title; ?></title>
    <meta name="description" content='<?php $context = PS::get_context(); echo $context['seo_description']; ?>'>

    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo \PS::$assets_url; ?>images/favicon.png" />

    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#ffffff" />
					
    <meta property="og:title" content="<?php echo $wp_title; ?>"/>					
    <meta property="og:description" content="<?php echo $context['seo_description']; ?>"/>					
    <meta property="og:type" content="website" />
    <?php $img = get_field('img'); if(is_array($img) && count($img)): ?>
        <meta property="og:image" content="<?php echo $img['sizes']['960x0']; ?>" />
    <?php else: ?>
        <?php $og_img = get_field('og_img', \PS::$option_page); if(is_array($og_img) && count($og_img)): ?>
            <meta property="og:image" content="<?php echo $og_img['sizes']['960x0']; ?>" />
        <?php endif; ?>
    <?php endif; ?>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-5R3SN3H9');</script>
    <!-- End Google Tag Manager -->
    <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5R3SN3H9" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

	<?php /* DON'T REMOVE THIS */ ?>
	<?php wp_head(); ?>
	<?php /* END */ ?>
    <?php $facebook_pixel_id = get_field('facebook_pixel_id', 'options');
    if($facebook_pixel_id != ''){ ?>
    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
        // Insert Your Facebook Pixel ID below.
        fbq('init', '<?php echo $facebook_pixel_id; ?>');
        fbq('track', 'PageView');
        <?php if(is_product()){ ?>
        <?php $product = wc_get_product(get_the_ID());
            $terms = [];
            $term = get_the_terms( $product->get_id(), 'product_cat' );
            $term = $term[0];
            $terms[] = $term->name;
            while($term->parent != 0){
                $term = get_terms([
                    'taxonomy' => 'product_cat',
                    'include'  => $term->parent
                ]);
                $term = $term[0];
                $terms[] = $term->name;
            }
            $terms = array_reverse($terms); ?>
            fbq('track', 'ViewContent', {
                content_ids: ['<?php echo $product->get_id(); ?>'],
                content_name: '<?php echo $product->get_name(); ?>',
                content_category: '<?php echo implode(' > ', $terms); ?>',
                content_type: 'product',
                value: <?php echo $product->get_price(); ?>,
                currency: '<?php echo get_woocommerce_currency(); ?>'
            });
        <?php }else if(is_checkout()){ ?>
            <?php if ( is_wc_endpoint_url( 'order-received' ) ) { ?>
            <?php
                global $wp;
                $current_order_id =  intval( str_replace( 'checkout/order-received/', '', $wp->request ) );
                $order = wc_get_order( $current_order_id );
                $items_send = [];
                $items = $order->get_items();
                foreach($items as $item_id => $item ) {
                    $_product =  $item->get_product();
                    if(intval($_product->get_parent_id())){
                        $product_id =  $_product->get_parent_id();
                    }else{
                        $product_id =  $_product->get_id();
                    }
                    $terms = [];
                    $term = get_the_terms( $product_id, 'product_cat' );
                    $term = $term[0];
                    $terms[] = $term->name;
                    while($term->parent != 0){
                        $term = get_terms([
                            'taxonomy' => 'product_cat',
                            'include'  => $term->parent
                        ]);
                        $term = $term[0];
                        $terms[] = $term->name;
                    }
                    $items_send[] = [
                        'content_name' => $item->get_name(),
                        'content_ids' => [$product_id],
                        'price' => round($item->get_total()/$item->get_quantity(), 2, PHP_ROUND_HALF_UP),
                        'content_category' => implode(' > ', $terms),
                        'num_items' => $item->get_quantity(),
                    ];
                }
            ?>
        alert('Purchase');
                fbq('track', 'Purchase', {
                    contents: <?php echo json_encode($items_send); ?>,
                    content_type: 'product',
                    value: <?php echo floatval($order->get_total()); ?>,
                    currency: '<?php echo get_woocommerce_currency(); ?>'
                });
            <?php }else{ ?>
                    <?php
                        global $woocommerce;
                        $items_send = [];
                        $items = $woocommerce->cart->get_cart();
                        foreach($items as $item => $values) {
                            $_product =  wc_get_product( $values['data']->get_id());
                            $item_var = [];
                            if(!empty($values['variation'])){
                                foreach($values['variation'] as $variation){
                                    $item_var[] = $variation;
                                }
                            }
                            $terms = [];
                            $term = get_the_terms( $values['product_id'], 'product_cat' );
                            $term = $term[0];
                            $terms[] = $term->name;
                            while($term->parent != 0){
                                $term = get_terms([
                                    'taxonomy' => 'product_cat',
                                    'include'  => $term->parent
                                ]);
                                $term = $term[0];
                                $terms[] = $term->name;
                            }
                            $terms = array_reverse($terms);
                            $items_send[] = [
                                'content_name' => $_product->get_title(),
                                'content_ids' => [$values['product_id']],
                                'price' => round($values['line_total']/$values['quantity'], 2, PHP_ROUND_HALF_UP),
                                'content_category' => implode(' > ', $terms),
                                'num_items' => $values['quantity']
                            ];
                        }
                    ?>
                    fbq('track', 'InitiateCheckout', {
                        contents: <?php echo json_encode($items_send); ?>,
                        content_type: 'product',
                        value: <?php echo floatval($woocommerce->cart->total); ?>,
                        currency: '<?php echo get_woocommerce_currency(); ?>'
                    });
            <?php } ?>
        <?php } ?>
    </script>
    <!-- End Facebook Pixel Code -->
    <?php } ?>
</head>