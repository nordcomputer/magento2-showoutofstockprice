<?php

namespace Nordcomputer\Showoutofstockprice\ConfigurableProduct\Helper\Data;

class Data extends \Magento\ConfigurableProduct\Helper\Data
{

    public function getOptions($currentProduct, $allowedProducts)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $stockRegistry = $objectManager->get(\Magento\CatalogInventory\Api\StockRegistryInterface::class);

        $options = [];
        $allowAttributes = $this->getAllowAttributes($currentProduct);

        foreach ($allowedProducts as $product) {
            $productId = $product->getId();

            $product = $objectManager->get(\Magento\Catalog\Model\Product::class)->load($productId);
            $stockitem = $stockRegistry->getStockItem($product->getId(), $product->getStore()->getWebsiteId());
            if ($stockitem->getQty() == 0) {
                continue;
            }

            foreach ($allowAttributes as $attribute) {
                $productAttribute = $attribute->getProductAttribute();
                $productAttributeId = $productAttribute->getId();
                $attributeValue = $product->getData($productAttribute->getAttributeCode());

                $options[$productAttributeId][$attributeValue][] = $productId;
                $options['index'][$productId][$productAttributeId] = $attributeValue;
            }
        }
        return $options;
    }
}
