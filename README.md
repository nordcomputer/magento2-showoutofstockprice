# Module for Magento 2 to show price for out-of-stock products
This Magento2 Module adds prices to out-of-stock products. You can either download it and put it into /app/code/Nordcomputer/Showoutofstockprice/ or install it with composer (make sure, you have set your auth.json file correctly, to download from github. You need to set an Auth Token for your github account and put it into the auth.json file).
Install with composer from terminal:

`composer config repositories.nordcomputer/showoutofstockprice git "git@github.com:nordcomputer/magento2-showoutofstockprice.git"`

`composer require nordcomputer/showoutofstockprice <prefered version>`


# Note
If you would like to show options/swatches even if all children are out of stock you need to make a template change, you need to remove the `$product->isSalable()` checks from the `Magento_Catalog::product/view/form.phtml` template
