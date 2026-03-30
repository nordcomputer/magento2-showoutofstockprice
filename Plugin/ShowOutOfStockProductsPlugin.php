<?php
namespace Nordcomputer\Showoutofstockprice\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Attribute\Source\Status;
use Magento\ConfigurableProduct\Block\Product\View\Type\Configurable;
use Magento\ConfigurableProduct\Model\Product\Type\Configurable as ConfigurableType;

/**
 * Plugin to expose configurable child products even when they are out of stock.
 */
class ShowOutOfStockProductsPlugin
{
    /**
     * Return allowed child products for configurable product view.
     *
     * Uses the original result if available and filters only disabled products.
     * Falls back to all used products when Magento returns an empty array.
     *
     * @param Configurable $subject
     * @param callable $proceed
     *
     * @return Product[]
     */
    public function aroundGetAllowProducts(Configurable $subject, callable $proceed): array
    {
        $products = $proceed();

        if (!empty($products)) {
            return $this->filterEnabledProducts($products);
        }

        $product = $subject->getProduct();
        $typeInstance = $product->getTypeInstance();

        if (!$typeInstance instanceof ConfigurableType) {
            return [];
        }

        $usedProducts = $typeInstance->getUsedProducts($product, null);

        return $this->filterEnabledProducts($usedProducts);
    }

    /**
     * Filter disabled child products from the given product array.
     *
     * @param array $products
     *
     * @return Product[]
     */
    private function filterEnabledProducts(array $products): array
    {
        $filteredProducts = [];

        foreach ($products as $product) {
            if (!$product instanceof Product) {
                continue;
            }

            if ((int) $product->getStatus() === Status::STATUS_DISABLED) {
                continue;
            }

            $filteredProducts[] = $product;
        }

        return $filteredProducts;
    }
}
