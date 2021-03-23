<?php
namespace Nordcomputer\Showoutofstockprice\Model\ResourceModel\Product;

use Magento\CatalogInventory\Model\ResourceModel\Product\StockStatusBaseSelectProcessor;

class CompositeBaseSelectProcessor extends \Magento\Catalog\Model\ResourceModel\Product\CompositeBaseSelectProcessor
{
    public function __construct(
        array $baseSelectProcessors
    ) {

        // REMOVE THE STOCK STATUS PROCESSOR
        //...................................
        $finalProcessors = [];
        foreach ($baseSelectProcessors as $baseSelectProcessor) {
            if (!is_a($baseSelectProcessor, StockStatusBaseSelectProcessor::class)) {
                $finalProcessors[] = $baseSelectProcessor;
            }
        }

        parent::__construct($finalProcessors);
    }
}
