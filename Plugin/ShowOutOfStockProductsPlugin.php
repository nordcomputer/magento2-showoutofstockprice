<?php

namespace Nordcomputer\Showoutofstockprice\Plugin;

class ShowOutOfStockProductsPlugin
{

    /**
     * Get Allowed Products
     *
     * @return \Magento\Catalog\Model\Product[]
     */
    public function beforeGetAllowProducts(\Magento\ConfigurableProduct\Block\Product\View\Type\Configurable $subject)
    {
        if (!$subject->hasAllowProducts()) {
            $allProducts = $subject->getProduct()->getTypeInstance()->getUsedProducts($subject->getProduct(), null);
            $products = [];
            foreach ($allProducts as $product) {
                if ($product->getStatus() != \Magento\Catalog\Model\Product\Attribute\Source\Status::STATUS_DISABLED) {
                    $products[] = $product;
                }
            }
            $subject->setAllowProducts($products);
        } else {
            $_children = $subject->getProduct()->getExtensionAttributes()->getConfigurableProductLinks();
            if ($_children!=null) {
                foreach ($_children as $child) {
                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                    $product = $objectManager->create(\Magento\Catalog\Model\Product::class)->load($child);
                    $products[] = $product;
                }
                $subject->setAllowProducts($products);
            }

        }

        return [];
    }
}
