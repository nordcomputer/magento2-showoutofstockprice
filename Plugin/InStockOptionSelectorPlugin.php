<?php

namespace Nordcomputer\Showoutofstockprice\Plugin;

use Magento\ConfigurableProduct\Model\ResourceModel\Attribute\OptionSelectBuilderInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\DB\Select;
use Magento\Store\Model\ScopeInterface;

/**
 * Plugin to keep configurable options visible when out-of-stock products
 * should be displayed on the storefront.
 */
class InStockOptionSelectorPlugin
{
    /** @var string */
    private const XML_PATH_SHOW_OUT_OF_STOCK = 'cataloginventory/options/show_out_of_stock';

    /** @var ScopeConfigInterface */
    private $scopeConfig;

    /**
     * InStockOptionSelectorPlugin constructor.
     *
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Remove the MSI salability filter
     *
     * Remove the MSI salability filter from the configurable option select
     * when out-of-stock products should be shown.
     *
     * @param OptionSelectBuilderInterface $subject
     * @param Select $select
     *
     * @return Select
     */
    public function afterGetSelect(
        OptionSelectBuilderInterface $subject,
        Select $select
    ): Select {
        if (!$this->isShowOutOfStockEnabled()) {
            return $select;
        }

        $whereParts = $select->getPart(Select::WHERE);
        if (empty($whereParts)) {
            return $select;
        }

        $filteredWhereParts = [];

        foreach ($whereParts as $wherePart) {
            $normalizedWherePart = strtolower((string) $wherePart);

            if (strpos($normalizedWherePart, 'stock.is_salable') !== false
                && strpos($normalizedWherePart, '= 1') !== false
            ) {
                continue;
            }

            $filteredWhereParts[] = $wherePart;
        }

        $select->setPart(Select::WHERE, $filteredWhereParts);

        return $select;
    }

    /**
     * Check whether out-of-stock products should be shown.
     *
     * @return bool
     */
    private function isShowOutOfStockEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(
            self::XML_PATH_SHOW_OUT_OF_STOCK,
            ScopeInterface::SCOPE_STORE
        );
    }
}
