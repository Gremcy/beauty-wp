<?php

namespace PS\XmlExport;

use PS\XmlExport\Factories\VariableProductFactory;
use PS\XmlExport\Products\SimpleProduct;

class Exporter {
    protected array $products;
    protected array $currentAttributes;

    public function __construct(
        protected XmlParser $parser,
        protected \WC_Logger $logger
    )
    {
        $this->products = $this->parser->parseData();
        $this->products = $this->products['product'];
        $this->getAttributesAsArray();
    }

    public function refreshStock(array $items = [], $isVariation = false) : void
    {
        $items = $items ?: $this->products;

        
        foreach ($items as $product) {
            try {
                if (isset($product['variations']) && !empty($product['variations'])) {
                    $product = new VariableProductFactory($product, $this->parser, $this->currentAttributes);
                } else {
                    $product = new SimpleProduct($product);
                }
                $product->update();
            } catch (\Throwable $e) {
                print_r($e->getMessage());
            }
        }
    }

    private function getAttributesAsArray(): void
    {
        $taxonomiesList = wp_list_pluck(wc_get_attribute_taxonomies(), 'attribute_name');
        $attributes = [];

        foreach($taxonomiesList as $taxonomy) {
            $tax = get_terms( array('taxonomy' => 'pa_'.$taxonomy, 'hide_empty' => false) );
            foreach($tax as $value) {
                $attributes[$taxonomy][$value->slug] = $value->name;
            }
        }

        $this->currentAttributes = $attributes;
    }

}