<?php
namespace Nordcomputer\Showoutofstockprice\Pricing\Render;

use Magento\ConfigurableProduct\Pricing\Render\FinalPriceBox as ConfigurableFinalPriceBox;
use Magento\Framework\Pricing\Render\PriceBox as BasePriceBox;
use Magento\Msrp\Pricing\Price\MsrpPrice;

/**
 * Custom final price box renderer for configurable products.
 */
class FinalPriceBox extends ConfigurableFinalPriceBox
{
    /**
     * Render final price HTML.
     *
     * @return string
     */
    protected function _toHtml(): string
    {
        $result = BasePriceBox::_toHtml();

        if ($this->isMsrpPriceApplicable()) {
            /** @var BasePriceBox $msrpBlock */
            $msrpBlock = $this->rendererPool->createPriceRender(
                MsrpPrice::PRICE_CODE,
                $this->getSaleableItem(),
                [
                    'real_price_html' => $result,
                    'zone' => $this->getZone(),
                ]
            );

            $result = $msrpBlock->toHtml();
        }

        return $this->wrapResult($result);
    }
}
