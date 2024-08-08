<?php

namespace PS\Functions\Crm;

/**
 * Class Bitrix
 * @package     PS\Functions\Crm
 * @since       1.0.0
 */
class Bitrix {

    protected $log;
    protected $bitrix;

    public function __construct() {
        // init
        require_once \PS ::$libs_path . 'bitrix/CRest.php';
        require_once \PS::$libs_path . 'bitrix/Logger.php';
        require_once \PS::$libs_path. 'bitrix/BitrixService.php';

        $this->log = new \Logger();
        $this->bitrix = new \BitrixService($this->log);
    }

    // send order to CRM
    public function send_order_to_bitrix($post_id){
        $post_type = get_post_type($post_id); 
        if($post_type === 'shop_order'){
            // get order information
            $order = wc_get_order($post_id);
            $order_data = $order->get_data();
            $order_items = $order->get_items();
            $order_shipping = $order->get_items( 'shipping' );

            // lead
            $leadFields = [];
            $leadFields['title'] = 'New order #' . $post_id;

            // contact
            $contactFields = [];
            $contactFields['name'] = $order_data['billing']['first_name'] . ' ' . $order_data['billing']['last_name'];
            $contactFields['email'] = $order_data['billing']['email'];
            $contactFields['phone'] = $order_data['billing']['phone'];
            $contactFields['page'] = $order_data['billing']['country'];
            $contactFields['message'] = '';

            // products
            if(is_array($order_items) && count($order_items)){
                $contactFields['message'] .= '------------------Товары-------------------' . "<br>";

                foreach ($order_items as $item ){
                    $product = $item->get_product();

                    $product_name = $item->get_name();
                    $product_attributes = $product->get_attributes(); if(is_array($product_attributes) && count($product_attributes)){
                        $m = 1;
                        $product_name .= ' (';
                        foreach ($product_attributes as $taxonomy => $slug){
                            if($m > 1){$product_name .= ', ';}
                            $term = $term = get_term_by('slug', $slug, $taxonomy); $product_name .= $term->name;
                            $m++;
                        }
                        $product_name .= ')';
                    }

                    $contactFields['message'] .= 'SKU:' . $product->get_sku() . ' | Название товара: ' . $product_name . ' | Кол-во: ' . $item->get_quantity() . ' | Стоимость: ' . $product->get_price() . ' ' . $order_data['currency'] . "<br>";
                }

                $contactFields['message'] .= 'Доставка: ' . $order_data['shipping_total'] . ' ' . $order_data['currency'] . "<br>";
                if($order_data['discount_total'] != '0'){
                    $contactFields['message'] .= 'Купон: -' . $order_data['discount_total'] . ' ' . $order_data['currency'] . "<br>";
                }
                $contactFields['message'] .= 'Всего: ' . $order_data['total'] . ' ' . $order_data['currency'] . "<br>";
            }

            // shipping
            if(is_array($order_shipping) && count($order_shipping)){
                $contactFields['message'] .= '----------------Доставка-----------------' . "<br>";
                foreach( $order_shipping as $item ){
                    $contactFields['message'] .= $item->get_method_title() . ': ' . $item->get_total(). ' ' . $order_data['currency'] . "<br>";
                }
            }

            // payment
            $contactFields['message'] .= '----------------Оплата-----------------' . "<br>";
            $contactFields['message'] .= $order_data['payment_method_title'] . "<br>";

            // additional
            $contactFields['message'] .= '----------------Дополнительно-----------------' . "<br>";
            $contactFields['message'] .= 'Адрес: ' . $order_data['billing']['address_1'] . ' ' . $order_data['billing']['address_2'] . "<br>";
            $contactFields['message'] .= 'Город: ' . $order_data['billing']['city'] . "<br>";
            $contactFields['message'] .= 'ZIP: ' . $order_data['billing']['postcode'] . "<br>";
            $contactFields['message'] .= 'Страна: ' . $order_data['billing']['country'];

            // search contact
            $contactID = null;
            $search_contact = $this->bitrix->findContactByEmail($contactFields['email']); 
            if(isset($search_contact['result']['CONTACT'][0])){
                $contactID = $search_contact['result']['CONTACT'][0];
            }

            // log
            $this->log->writeToLog([
                'leadFields' => $leadFields,
                'contactFields' => $contactFields,
                'contactID' => $contactID
            ], 'createLead');

            // create deal
            $create_lead = $this->bitrix->createLead($leadFields, $contactFields, $contactID);
            if(isset($create_lead['result']) && (int)$create_lead['result']){
                update_field('field_642b025cdb39d', '1', $post_id);
            }
        }
    }

    // send form to CRM
    public function send_form_to_bitrix($post_id){
        $post_types = [
            'letter' => 'Contact us',
            'questionnaire' => 'Questionnaire',
            'partner' => 'Become partner',
            'ambassador' => 'Become ambassador',
            'coupons' => 'Get 5% discount'
        ];

        $post_type = get_post_type($post_id); 
        if(isset($post_types[$post_type])){
            // lead
            $leadFields = [];
            $leadFields['title'] = 'New lead ' . get_the_title($post_id) . ' (' . $post_types[$post_type] . ')';
            $leadFields['utm_medium'] = get_field('utm_medium', $post_id);
            $leadFields['utm_source'] = get_field('utm_source', $post_id);
            $leadFields['utm_campaign'] = get_field('utm_campaign', $post_id);
            $leadFields['utm_term'] = get_field('utm_term', $post_id);
            $leadFields['utm_content'] = get_field('utm_content', $post_id);

            // contact
            $contactFields = [];
            $contactFields['name'] = get_field('name', $post_id);
            $contactFields['email'] = get_field('email', $post_id);
            $contactFields['phone'] = get_field('phone', $post_id);
            $contactFields['page'] = get_field('country', $post_id);
            if($post_type === 'letter' || $post_type === 'partner' || $post_type === 'ambassador'){
                $contactFields['message'] = get_field('message', $post_id);
            }elseif($post_type === 'questionnaire'){
                $contactFields['message'] = get_field('course', $post_id);
            }elseif($post_type === 'coupons'){
                $contactFields['message'] = get_field('coupon', $post_id);
            }
            if($post_type === 'ambassador'){
                $contactFields['instagram'] = get_field('instagram', $post_id);
                $contactFields['buy'] = get_field('buy', $post_id);
                $contactFields['customer'] = get_field('customer', $post_id);
                $contactFields['other'] = get_field('other', $post_id);
            }elseif($post_type === 'questionnaire'){
                $contactFields['instagram'] = get_field('social', $post_id);
            }

            // create contact
            $contactID = null;
            $search_contact = $this->bitrix->findContactByEmail($contactFields['email']); if(isset($search_contact['result']['CONTACT'][0])){
                $contactID = $search_contact['result']['CONTACT'][0];
            }else{
                $create_contact = $this->bitrix->createContact($contactFields); if(isset($create_contact['result'])){
                    $contactID = $create_contact['result'];
                }
            }

            // log
            $this->log->writeToLog([
                'leadFields' => $leadFields,
                'contactFields' => $contactFields,
                'contactID' => $contactID
            ], 'createLead');

            // create deal
            $create_lead = $this->bitrix->createLead($leadFields, $contactFields, $contactID);
           
            $this->log->writeToLog([
                'leadId' => $create_lead
            ], 'createdLead');
            
            if(isset($create_lead['result']) && (int)$create_lead['result']){
                update_field('field_640797c02457b', '1', $post_id);
            }
        }
    }

}