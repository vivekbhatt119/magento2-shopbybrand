# Mage2 Module Vivek ShopByBrand

    ``vivek/module-shopbybrand``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
shop by brand module enables you to listing products by brand

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Vivek`
 - Enable the module by running `php bin/magento module:enable Vivek_ShopByBrand`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require vivek/module-shopbybrand`
 - enable the module by running `php bin/magento module:enable Vivek_ShopByBrand`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

 - attribute (shop_by_brand/general/attribute)

 - Brand URL Key (shop_by_brand/general/url_key)


## Specifications

 - Controller
	- frontend > brand/index/index

 - Controller
	- frontend > brand/view/index


## Attributes



