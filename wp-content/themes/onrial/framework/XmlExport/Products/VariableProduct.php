<?php

namespace PS\XmlExport\Products;

use PS\XmlExport\Interfaces\IProduct;

class VariableProduct implements IProduct
{
    public function __construct(
        protected array         $productData,
        public \WC_Product      $wcProduct,
    )
    {
    }

    public function update(): int
    {
        if(!$this->wcProduct->get_sku()) {
            $this->wcProduct->set_name($this->productData['title']);
            $this->wcProduct->set_sku($this->productData['sku']);
            $this->wcProduct->set_status('draft');
        }

        $this->wcProduct->set_manage_stock( false );
        return $this->wcProduct->save();
    }

}