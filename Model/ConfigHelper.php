<?php
/**
 * ConfigHelper
 *
 * @copyright Copyright © 2024 Staempfli AG. All rights reserved.
 * @author    juan.alonso@staempfli.com
 */

namespace Vivek\ShopByBrand\Model;


class ConfigHelper
{
    const XML_PATH_ATTRIBUTE = "shop_by_brand/general/attribute";
    const XML_PATH_URL = "shop_by_brand/general/url_key";

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return string
     */
    public function getAttribute()
    {
        return $this->getConfig(self::XML_PATH_ATTRIBUTE);
    }

    /**
     * @return string
     */
    public function getUrlKey()
    {
        return $this->getConfig(self::XML_PATH_URL);
    }

    private function getConfig($path)
    {
        return $this->scopeConfig->getValue($path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }
}
