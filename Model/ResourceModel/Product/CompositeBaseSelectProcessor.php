<?php
namespace Nordcomputer\Showoutofstockprice\Model\ResourceModel\Product;

use Magento\CatalogInventory\Model\ResourceModel\Product\StockStatusBaseSelectProcessor;

class CompositeBaseSelectProcessor extends \Magento\Catalog\Model\ResourceModel\Product\CompositeBaseSelectProcessor
{
    /**
     * REMOVE THE STOCK STATUS PROCESSOR
     *
     * @param  array $baseSelectProcessors
     */
    public function __construct(
        array $baseSelectProcessors
    ) {
        $finalProcessors = [];
        foreach ($baseSelectProcessors as $baseSelectProcessor) {
            if (!is_a($baseSelectProcessor, StockStatusBaseSelectProcessor::class)) {
                $finalProcessors[] = $baseSelectProcessor;
            }
        }

        parent::__construct($finalProcessors);
    }
}
