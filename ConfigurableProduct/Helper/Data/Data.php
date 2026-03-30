<?php

namespace Nordcomputer\Showoutofstockprice\ConfigurableProduct\Helper\Data;

use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Helper\Data as ConfigurableHelperData;

/**
 * Helper for configurable product option matrix.
 */
class Data extends ConfigurableHelperData
{
    /**
     * Build configurable option index for the given allowed child products.
     *
     * @param Product $currentProduct
     * @param Product[] $allowedProducts
     *
     * @return array
     */
    public function getOptions($currentProduct, $allowedProducts)
    {
        $options = [];
        $allowAttributes = $this->getAllowAttributes($currentProduct);

        foreach ($allowedProducts as $product) {
            if (!$product instanceof Product) {
                continue;
            }

            $productId = (int) $product->getId();
            if ($productId <= 0) {
                continue;
            }

            foreach ($allowAttributes as $attribute) {
                $productAttribute = $attribute->getProductAttribute();
                if ($productAttribute === null) {
                    continue;
                }

                $productAttributeId = (int) $productAttribute->getId();
                $attributeCode = (string) $productAttribute->getAttributeCode();
                $attributeValue = $product->getData($attributeCode);

                if ($productAttributeId <= 0 || $attributeValue === null || $attributeValue === '') {
                    continue;
                }

                $options[$productAttributeId][$attributeValue][] = $productId;
                $options['index'][$productId][$productAttributeId] = $attributeValue;
            }
        }

        return $options;
    }
}
