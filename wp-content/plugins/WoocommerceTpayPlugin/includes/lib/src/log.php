<?php
exit;
?>
===========================
TException
===========================
2023-03-03 17:06:56
ip: 217.196.161.103
Invalid secret code in file /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/lib/src/_class_tpay/Validate.php line: 1730

#0 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/lib/src/_class_tpay/PaymentBasic.php(100): tpay\Validate::validateMerchantSecret('')
#1 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(238): tpay\PaymentBasic->__construct(98726, '')
#2 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(161): WC_Gateway_Tpay_Basic->createTransaction(Array)
#3 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_Gateway_Tpay_Basic->gateway_communication('')
#4 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters('', Array)
#5 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(517): WP_Hook->do_action(Array)
#6 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/woocommerce/includes/class-wc-api.php(161): do_action('woocommerce_api...')
#7 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_API->handle_api_requests(Object(WP))
#8 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters(NULL, Array)
#9 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(565): WP_Hook->do_action(Array)
#10 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(399): do_action_ref_array('parse_request', Array)
#11 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(780): WP->parse_request('')
#12 /var/www/onrial/onrial.d.gremsys.com/wp-includes/functions.php(1332): WP->main('')
#13 /var/www/onrial/onrial.d.gremsys.com/wp-blog-header.php(16): wp()
#14 /var/www/onrial/onrial.d.gremsys.com/index.php(17): require('/var/www/onrial...')
#15 {main}


===========================
TException
===========================
2023-03-03 17:08:27
ip: 217.196.161.103
Invalid secret code in file /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/lib/src/_class_tpay/Validate.php line: 1730

#0 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/lib/src/_class_tpay/PaymentBasic.php(100): tpay\Validate::validateMerchantSecret('')
#1 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(238): tpay\PaymentBasic->__construct(98726, '')
#2 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(161): WC_Gateway_Tpay_Basic->createTransaction(Array)
#3 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_Gateway_Tpay_Basic->gateway_communication('')
#4 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters('', Array)
#5 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(517): WP_Hook->do_action(Array)
#6 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/woocommerce/includes/class-wc-api.php(161): do_action('woocommerce_api...')
#7 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_API->handle_api_requests(Object(WP))
#8 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters(NULL, Array)
#9 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(565): WP_Hook->do_action(Array)
#10 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(399): do_action_ref_array('parse_request', Array)
#11 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(780): WP->parse_request('')
#12 /var/www/onrial/onrial.d.gremsys.com/wp-includes/functions.php(1332): WP->main('')
#13 /var/www/onrial/onrial.d.gremsys.com/wp-blog-header.php(16): wp()
#14 /var/www/onrial/onrial.d.gremsys.com/index.php(17): require('/var/www/onrial...')
#15 {main}


===========================
TException
===========================
2023-03-03 17:10:42
ip: 217.196.161.103
Invalid order ID  in file /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayGatewayBase.php line: 240

#0 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(184): TpayGatewayBase->getBaseTransactionConfigByOrderId(false, 'TPA!onrial2022')
#1 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(160): WC_Gateway_Tpay_Basic->getTransactionConfig('STFscEc0MVhRWDd...')
#2 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_Gateway_Tpay_Basic->gateway_communication('')
#3 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters('', Array)
#4 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(517): WP_Hook->do_action(Array)
#5 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/woocommerce/includes/class-wc-api.php(161): do_action('woocommerce_api...')
#6 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_API->handle_api_requests(Object(WP))
#7 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters(NULL, Array)
#8 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(565): WP_Hook->do_action(Array)
#9 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(399): do_action_ref_array('parse_request', Array)
#10 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(780): WP->parse_request('')
#11 /var/www/onrial/onrial.d.gremsys.com/wp-includes/functions.php(1332): WP->main('')
#12 /var/www/onrial/onrial.d.gremsys.com/wp-blog-header.php(16): wp()
#13 /var/www/onrial/onrial.d.gremsys.com/index.php(17): require('/var/www/onrial...')
#14 {main}


===========================
TException
===========================
2023-03-03 17:11:55
ip: 217.196.161.103
Invalid order ID  in file /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayGatewayBase.php line: 240

#0 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(184): TpayGatewayBase->getBaseTransactionConfigByOrderId(false, 'TPA!onrial2022')
#1 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(160): WC_Gateway_Tpay_Basic->getTransactionConfig('STFscEc0MVhRWDd...')
#2 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_Gateway_Tpay_Basic->gateway_communication('')
#3 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters('', Array)
#4 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(517): WP_Hook->do_action(Array)
#5 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/woocommerce/includes/class-wc-api.php(161): do_action('woocommerce_api...')
#6 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_API->handle_api_requests(Object(WP))
#7 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters(NULL, Array)
#8 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(565): WP_Hook->do_action(Array)
#9 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(399): do_action_ref_array('parse_request', Array)
#10 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(780): WP->parse_request('')
#11 /var/www/onrial/onrial.d.gremsys.com/wp-includes/functions.php(1332): WP->main('')
#12 /var/www/onrial/onrial.d.gremsys.com/wp-blog-header.php(16): wp()
#13 /var/www/onrial/onrial.d.gremsys.com/index.php(17): require('/var/www/onrial...')
#14 {main}


===========================
TException
===========================
2023-03-03 17:13:08
ip: 217.196.161.103
Invalid order ID  in file /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayGatewayBase.php line: 240

#0 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(184): TpayGatewayBase->getBaseTransactionConfigByOrderId(false, 'TPA!onrial2022')
#1 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/WoocommerceTpayPlugin/includes/TpayBasic.php(160): WC_Gateway_Tpay_Basic->getTransactionConfig('STFscEc0MVhRWDd...')
#2 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_Gateway_Tpay_Basic->gateway_communication('')
#3 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters('', Array)
#4 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(517): WP_Hook->do_action(Array)
#5 /var/www/onrial/onrial.d.gremsys.com/wp-content/plugins/woocommerce/includes/class-wc-api.php(161): do_action('woocommerce_api...')
#6 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(308): WC_API->handle_api_requests(Object(WP))
#7 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp-hook.php(332): WP_Hook->apply_filters(NULL, Array)
#8 /var/www/onrial/onrial.d.gremsys.com/wp-includes/plugin.php(565): WP_Hook->do_action(Array)
#9 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(399): do_action_ref_array('parse_request', Array)
#10 /var/www/onrial/onrial.d.gremsys.com/wp-includes/class-wp.php(780): WP->parse_request('')
#11 /var/www/onrial/onrial.d.gremsys.com/wp-includes/functions.php(1332): WP->main('')
#12 /var/www/onrial/onrial.d.gremsys.com/wp-blog-header.php(16): wp()
#13 /var/www/onrial/onrial.d.gremsys.com/index.php(17): require('/var/www/onrial...')
#14 {main}


===========================
check basic payment
===========================
2023-03-03 17:55:48
ip: 148.251.96.163
$_POST: 
Array
(
    [id] => 98726
    [tr_id] => TR-2P4P-8EDJ1SX
    [tr_date] => 2023-03-03 18:55:45
    [tr_crc] => 3961
    [tr_amount] => 2.00
    [tr_paid] => 2.00
    [tr_desc] => Zamówienie nr 3961
    [tr_status] => TRUE
    [tr_error] => none
    [tr_email] => samosval2002@ukr.net
    [test_mode] => 0
    [md5sum] => e5db166219265a42a2c02059c08d6459
)



Check MD5: 1
===========================
check basic payment
===========================
2023-04-05 06:05:17
ip: 178.32.201.77
$_POST: 
Array
(
    [id] => 98726
    [tr_id] => TR-2P4P-8PPDP2X
    [tr_date] => 2023-04-05 08:05:12
    [tr_crc] => 4250
    [tr_amount] => 2.34
    [tr_paid] => 2.34
    [tr_desc] => Zamówienie nr 4250
    [tr_status] => TRUE
    [tr_error] => none
    [tr_email] => dolcheaqua@gmail.com
    [test_mode] => 0
    [md5sum] => 82f5f6a70213c16ee422f77f89ee6807
)



Check MD5: 1