<?php

namespace PS\XmlExport;

use function Exception;

trait UpdatablePriceTrait
{
    protected function updatePrices(): void
    {

        $prices = array_change_key_case($this->productData['price'], CASE_UPPER);
        $prices = array_map('floatval', $prices);

        $defaultCurrency = get_option('woocommerce_currency');

        if(!isset($prices[$defaultCurrency])) {
            throw new Exception('No price in default currenct. ' . $defaultCurrency . 'not presented');
        }

        $this->wcProduct->set_regular_price($prices[$defaultCurrency]);
        unset($prices[$defaultCurrency]);

        $this->wcProduct->update_meta_data('_regular_price_wmcp', json_encode($prices));
    }
}