<?php
namespace Nordcomputer\Showoutofstockprice\Model\ConfigurableProduct\ResourceModel\Product;

use Magento\Framework\DB\Select;

class StockStatusBaseSelectProcessor extends \Magento\ConfigurableProduct\Model\ResourceModel\Product\StockStatusBaseSelectProcessor
{
    public function process(Select $select)
    {
        return $select;
    }
}
?>
