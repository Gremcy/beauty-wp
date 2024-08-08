<?php

namespace PS\XmlExport\Products;

use Exception;
use PS\XmlExport\Interfaces\IProduct;
use PS\XmlExport\UpdatablePriceTrait;

class SimpleProduct implements IProduct
{
    use UpdatablePriceTrait;

    protected ?\WC_Product $wcProduct;

    /**
     * @throws Exception
     */
    public function __construct(protected array $productData, bool $createIfNotFound = true)
    {
        $product = wc_get_product(wc_get_product_id_by_sku($productData['sku']));

        if($product)
            $this->wcProduct = $product;
        else {
            if(!$createIfNotFound)
                throw new Exception("No product with SKU " . $this->productData['sku']);

            $this->wcProduct = new \WC_Product_Simple();
        }
    }

    public function update(): int
    {
        if(!$this->wcProduct->get_sku()) {
            $this->wcProduct->set_name($this->productData['title']);
            $this->wcProduct->set_sku($this->productData['sku']);
            $this->wcProduct->set_status('draft');
            $this->wcProduct->set_stock_quantity( (int) $this->productData['quantity'] ?? 0 );
        }

        $this->wcProduct->update_meta_data("EAN13", $this->productData['EAN13'] ?: '');
        $this->wcProduct->update_meta_data("produkt_Kod_kreskowy", $this->productData['barcode'] ?: '');

        $this->updatePrices();
        $this->wcProduct->set_manage_stock( true );

        return $this->wcProduct->save();
    }

}