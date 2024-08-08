<?php

namespace PS\XmlExport;

class XmlParser implements Interfaces\IParser {
    public function __construct(protected string $filePath)
    {
    }

    public static function getXmlItems(array $items) : array
    {
        if ( array_keys($items) !== range(0, count($items) - 1) ) {
            return [$items];
        }
        
        return $items;
    }

    public function getProducts()
    {
        return $this->items;
    }

    public function parseData(string $filePath = null) : array
    {
        if (!$filePath) {
            $filePath = $this->filePath; 
        }
        
        // Read entire file into string
        $xmlfile = file_get_contents($filePath);

        // Convert xml string into an object
        $new = simplexml_load_string($xmlfile);

        // Convert into json
        $con = json_encode($new);

        // Convert into associative array
        $products = json_decode($con, true, 512, JSON_OBJECT_AS_ARRAY);
        
        return $products;
    }
}