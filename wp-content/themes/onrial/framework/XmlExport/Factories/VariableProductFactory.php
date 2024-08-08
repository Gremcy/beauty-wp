<?php

namespace PS\XmlExport\Factories;

use PS\XmlExport\Interfaces\IProduct;
use PS\XmlExport\Products\ProductVariation;
use PS\XmlExport\Products\VariableProduct;
use PS\XmlExport\XmlParser;
use WC_Product;
use WC_Product_Attribute;
use WC_Product_Variable;

class VariableProductFactory
{
    protected array $children;
    protected \WC_Product $wcProduct;

    /**
     * @param mixed $product
     * @param XmlParser $parser
     * @param array $attributes
     */
    public function __construct(protected array $product, XmlParser $parser, protected array $attributes)
    {
        $wcProduct = wc_get_product(wc_get_product_id_by_sku($product['sku']));
        if($wcProduct)
            $this->wcProduct = $wcProduct;
        else
            $this->wcProduct = new WC_Product_Variable();

        $this->children = $parser->getXmlItems($product['variations']['item']);
    }

    public function update() : void
    {
        $product = new VariableProduct($this->product, $this->wcProduct);
        $product->update();

        $this->assignAttributes();
        $this->updateChildren();
    }

    protected function assignAttributes(): void
    {
        $attrArray = [];

        foreach( $this->children as $itemVariation ) {
            if( isset( $itemVariation['attributes'] ) ) {
                foreach ($itemVariation['attributes'] as $attrSlug => $attrVal) {
                    $attrSlug = sanitize_title($attrSlug);
                    $attrArray[$attrSlug][] = $this->attributes[$attrSlug][sanitize_title($attrVal)] ?? $attrVal;
                    $attrArray[$attrSlug] = array_unique($attrArray[$attrSlug]);
                }
            }
        }

        if ($attrArray) {
            $productAttributes = [];
            foreach ($attrArray as $slug => $attributes) {
                $taxName = wc_sanitize_taxonomy_name(stripslashes($slug)); // remove any unwanted chars and return the valid string for taxonomy name

                /*foreach ($attributes as $option) {
                    wp_set_object_terms($product->wcProduct->get_id(), $option, $attr, true); // save the possible option value for the attribute which will be used for variation later
                }*/

                $attribute = new WC_Product_Attribute();
                $attr_id = wc_attribute_taxonomy_id_by_name('pa_' . $taxName);

                if (!$attr_id) {
                    $attr_id = wc_create_attribute(array(
                            'name'=> str_replace('_', ' ', ucfirst($slug)),
                            'slug' => $taxName,
                            'type' => 'select',
                            'order_by' => 'menu_order',
                            'has_archives' => false)
                    );
                    register_taxonomy( 'pa_' . $taxName, 'product' ); // Need to register taxonomy for using in this execution
                }

                $attribute->set_id($attr_id);
                $attribute->set_name('pa_' . $taxName);
                $attribute->set_options($attributes);
                $attribute->set_visible(true);
                $attribute->set_variation(true);
                $productAttributes[] = $attribute;

            }

            $this->wcProduct->set_attributes($productAttributes);
            $this->wcProduct->save();
        }
    }

    protected function updateChildren(): void
    {
        foreach($this->children as $child) {
            $variation = new ProductVariation($child, $this->wcProduct, $this->attributes);
            $variation->save();
        }
    }
}