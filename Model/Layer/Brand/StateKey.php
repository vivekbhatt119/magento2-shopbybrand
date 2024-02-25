<?php
/**
 * StateKey
 *
 * @copyright Copyright © 2024 Vivek Bhatt. All rights reserved.
 * @author    vivekbhatt119@gmail.com
 */

namespace Vivek\ShopByBrand\Model\Layer\Brand;

use Magento\Catalog\Model\Layer\StateKeyInterface;

class StateKey extends \Magento\Catalog\Model\Layer\Category\StateKey implements StateKeyInterface
{
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    /**
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\App\Request\Http $request
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\App\Request\Http $request
    ) {
        $this->request = $request;
        parent::__construct($storeManager, $customerSession);
    }

    /**
     * @inheritdoc
     */
    public function toString($category)
    {
        return 'brand_' . $this->request->getParam('brand_id')
            . '_' . \Magento\Catalog\Model\Layer\Category\StateKey::toString($category);
    }
}
