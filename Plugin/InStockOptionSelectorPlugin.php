<?php

namespace Nordcomputer\Showoutofstockprice\Plugin;

use Magento\CatalogInventory\Api\StockConfigurationInterface;
use Magento\CatalogInventory\Model\ResourceModel\Stock\Status;
use Magento\ConfigurableProduct\Model\ResourceModel\Attribute\OptionSelectBuilderInterface;
use Magento\Framework\DB\Select;
use \Magento\ConfigurableProduct\Plugin\Model\ResourceModel\Attribute\InStockOptionSelectBuilder;

class InStockOptionSelectorPlugin extends InStockOptionSelectBuilder
{
    /**
     * @var StockConfigurationInterface
     */
    private $stockConfiguration;
    /**
     * InStockOptionSelectBuilder constructor
     *
     * @param Status $stockStatusResource
     * @param StockConfigurationInterface $stockConfiguration
     */
    public function __construct(
        Status $stockStatusResource,
        StockConfigurationInterface $stockConfiguration
    ) {
        parent::__construct($stockStatusResource, $stockConfiguration);
        $this->stockConfiguration = $stockConfiguration;
    }
    /**
     * Only Add In stock Filter if Show Out Of Stock Products is set to No
     *
     * @param OptionSelectBuilderInterface $subject
     * @param Select $select
     * @return Select
     */
    public function afterGetSelect(
        OptionSelectBuilderInterface $subject,
        Select $select
    ) {
        if ($this->stockConfiguration->isShowOutOfStock()) {
            return parent::afterGetSelect($subject, $select);
        }
        return $select;
    }
}
