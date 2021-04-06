# Module for Magento 2 to show price for out-of-stock products

<img src="https://img.shields.io/github/v/release/nordcomputer/magento2-showoutofstockprice"> <img src="https://img.shields.io/badge/magento-v2.4.2-green?style=plastic&logo=magento"> <img src="https://img.shields.io/codacy/grade/977f45272789467ca9a0c4d0460836b6"> <img src="https://img.shields.io/github/issues/nordcomputer/magento2-showoutofstockprice"> <img src="https://img.shields.io/github/forks/nordcomputer/magento2-showoutofstockprice"> <img src="https://img.shields.io/github/stars/nordcomputer/magento2-showoutofstockprice">

This Magento2 Module adds prices to out-of-stock products. You can either download it and put it into `/app/code/Nordcomputer/Showoutofstockprice/` or install it with composer (make sure, you have set your auth.json file correctly, to download from github. You need to set an Auth Token for your github account and put it into the auth.json file).
Install with composer from terminal:

`composer config repositories.nordcomputer/showoutofstockprice git "git@github.com:nordcomputer/magento2-showoutofstockprice.git"`

`composer require nordcomputer/showoutofstockprice <prefered version>`

## Configuration
You can now configure, if you want to show swatches and the add-to-cart button on the product page from the backend (`Stores -> Configuration -> Nordcomputer -> Show Price for out-of-stock products`)

## Note
If you have no swatches configured (for example by using Dropdown instead), the Dropdown wont show up. But the Add-to-cart button still works

## Contributers
Thank you to our contributers:
-   [@carlos-reynosa](https://www.github.com/carlos-reynosa)
