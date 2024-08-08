<?php

namespace PS\XmlExport\Products;

use PS\XmlExport\UpdatablePriceTrait;
use WC_Product;
use WC_Product_Variation;

class ProductVariation
{
    use UpdatablePriceTrait;

    protected WC_Product $wcProduct;
    public function __construct(protected array $productData, protected WC_Product $parent, protected array $attributes)
    {
        $wcProductId =  wc_get_product_id_by_sku($productData['sku']);

        if($wcProductId)
            $this->wcProduct = wc_get_product($wcProductId);
        else
            $this->wcProduct = new WC_Product_Variation();
    }

    public function save(): int
    {
        $var_attributes = [];

        if(!$this->productData['attributes']) {
            throw new \InvalidArgumentException("No attributes for SKU:" . $this->productData['sku']);
        }

        foreach ($this->productData['attributes'] as $slug => $val) {
            $taxonomy = "pa_" . wc_sanitize_taxonomy_name(stripslashes($slug)); // name of variant attribute should be same as the name used for creating product attributes
            $attrVal = wc_sanitize_taxonomy_name(stripslashes($val));
            $var_attributes[$taxonomy] = $attrVal;
        }

        $this->wcProduct->update_meta_data("EAN13", $this->productData['EAN13'] ?: '');
        $this->wcProduct->update_meta_data("produkt_Kod_kreskowy", $this->productData['barcode'] ?: '');

        $this->wcProduct->set_parent_id($this->parent->get_id());

        if (!$this->wcProduct->get_id()) {
            $this->wcProduct->set_sku($this->productData['sku']);
            $this->wcProduct->set_stock_quantity( (int) $this->productData['quantity'] ?? 0 );
        }

        $this->wcProduct->set_attributes( $var_attributes );
        $this->wcProduct->set_manage_stock( true );
        $this->updatePrices();

        return $this->wcProduct->save();
    }
}