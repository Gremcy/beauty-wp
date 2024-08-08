<?php

namespace PS\XmlExport;

use PS\XmlExport\Products\SimpleProduct;

class ShortExporter {
    protected array $products;

    public function __construct(
        protected XmlParser $parser,
        protected \WC_Logger $logger)
    {
        
        $this->products = $this->parser->parseData();
        $this->products = $this->products['item'];
    }

    public function refreshStock(array $items = []) : void
    {
        $items = $items ?: $this->products;

        foreach ($items as $product) {
            $this->updateProduct($product);
        }
    }

    protected function updateProduct($product): void
    {
        try {
            $product = new SimpleProduct($product, false);
            $product->update();
        } catch (\Exception $e) {
            $this->logger->warning($e->getMessage());
        }
    }
}