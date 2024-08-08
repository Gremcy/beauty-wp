<?php /* DON'T REMOVE THIS */ ?>
<?php wp_footer(); ?>
<?php /* END */ ?>
<?php
if($_SERVER['REMOTE_ADDR'] == '46.149.86.197'){
    $order = wc_get_order(5095);
    $url = $order->get_checkout_order_received_url();
    var_dump($url);
}
if(is_product()){
    global $product;
    $terms = [];
    $term = get_the_terms( $product->get_id(), 'product_cat' );
    $term = $term[0];
    $terms[] = $term;
    while($term->parent != 0){
        $term = get_terms([
            'taxonomy' => 'product_cat',
            'include'  => $term->parent
        ]);
        $term = $term[0];
        $terms[] = $term;
    }
    $terms = array_reverse($terms);
    ?>
    <script>
        window.dataLayer = window.dataLayer || [];
        dataLayer.push({
            'event': 'view_item',
            'ecommerce': {
                'items': [{
                    'item_name': '<?php echo $product->get_name(); ?>',
                    'item_id': '<?php echo $product->get_id(); ?>',
                    'price': '<?php echo $product->get_price(); ?>',
                    'item_brand': 'Onrial',
                    <?php if(!empty($terms)){ ?>
                    <?php foreach($terms as $k=>$term){ ?>
                    'item_category<?php echo $k>0 ? $k+1 : ''; ?>': '<?php echo $term->name; ?>',
                    <?php } ?>
                    <?php } ?>
                    'index': 1,
                    'quantity': '1'
                }]
            }
        });

    </script>
<?php
    }else if(is_checkout()){
    if ( is_wc_endpoint_url( 'order-received' ) ) {
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
            $item_var = [];
            $terms = [];
            $term = get_the_terms( $product_id, 'product_cat' );
            $term = $term[0];
            $terms[] = $term;
            $tmas = [];
            $tmas['item_category'] = $term->name;
            $ik = 1;
            while($term->parent != 0){
                $term = get_terms([
                    'taxonomy' => 'product_cat',
                    'include'  => $term->parent
                ]);
                $term = $term[0];
                $terms[] = $term;
                $tmas['item_category'.$ik] = $term->name;
                $ik++;
            }
            $terms = array_reverse($terms);
            $items_send[] = array_merge([
                'item_name' => $item->get_name(),
                'item_id' => $product_id,
                'price' => round($item->get_total()/$item->get_quantity(), 2, PHP_ROUND_HALF_UP),
                'item_brand' => 'Onrial',
                'quantity' => $item->get_quantity(),
                /*'item_variant' => implode(', ', $item_var)*/
            ], $tmas);
        }
        $coupons = [];
        $order_itemsc = $order->get_items('coupon');
        if(!empty($order_itemsc)){
            foreach($order_itemsc as $o_item){
                $coupons[] = $o_item->get_name();
            }
        }
        ?>
        <script>
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push({
                event: 'purchase',
                ecommerce: {
                    currency: '<?php echo $order->get_currency(); ?>',
                    value: <?php echo floatval($order->get_total()); ?>,
                    tax: <?php echo floatval($order->get_cart_tax()); ?>,
                    shipping: <?php echo floatval($order->get_shipping_total()); ?>,
                    transaction_id: '<?php echo $order->get_transaction_id(); ?>',
                    coupon: '<?php echo implode(', ', $coupons); ?>',
                    items: <?php echo json_encode($items_send); ?>
                }
            });
        </script>
        <?php
    }else{
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
            $terms[] = $term;
            $tmas = [];
            $tmas['item_category'] = $term->name;
            $ik = 1;
            while($term->parent != 0){
                $term = get_terms([
                    'taxonomy' => 'product_cat',
                    'include'  => $term->parent
                ]);
                $term = $term[0];
                $terms[] = $term;
                $tmas['item_category'.$ik] = $term->name;
                $ik++;
            }
            $terms = array_reverse($terms);
            $items_send[] = array_merge([
                'item_name' => $_product->get_title(),
                'item_id' => $values['product_id'],
                'price' => round($values['line_total']/$values['quantity'], 2, PHP_ROUND_HALF_UP),
                'item_brand' => 'Onrial',
                'quantity' => $values['quantity'],
                'item_variant' => implode(', ', $item_var)
            ], $tmas);
        }
        ?>
        <script>
            window.dataLayer = window.dataLayer || [];
            window.dataLayer.push
            ({event: 'begin_checkout',
                ecommerce:
                    {items:
                        <?php echo json_encode($items_send); ?>
                    }});

        </script>
        <?php
    }
}
?>

<?php if(!isset($_COOKIE['hide-cookies-banner']) && !is_page(\PS::$privacy_page)): ?>
    <script>
        // cookies
        $(document).ready(function (){
            $('body').addClass('is-hidden');
            $('[data-modal="cookies-popup"]').fadeIn(1).addClass('is-open');
        });

        $(document).on('click', '.cookies-accept-button', function() {
            setCookie('hide-cookies-banner', '1', '31');
        });

        $(document).on('click', '.cookies-preferences-save-btn', function() {
            $('.cookies-accept-button').trigger('click');
        });
    </script>
<?php endif; ?>