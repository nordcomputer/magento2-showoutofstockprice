<?php
namespace Nordcomputer\Showoutofstockprice\Plugin;

use Magento\Catalog\Model\Product;
use Magento\ConfigurableProduct\Pricing\Price\ConfigurablePriceResolver;

/**
 * Plugin to provide a fallback price for configurable products.
 */
class ShowPrice
{
    /**
     * Set fallback price if configurable price resolver returns an empty value.
     *
     * @param ConfigurablePriceResolver $subject
     * @param float|int|string|null $price
     * @param Product $product
     *
     * @return float
     */
    public function afterResolvePrice(
        ConfigurablePriceResolver $subject,
        $price,
        Product $product
    ): float {
        $resolvedPrice = $price !== null ? (float) $price : (float) $product->getData('price');

        return $resolvedPrice;
    }
}
