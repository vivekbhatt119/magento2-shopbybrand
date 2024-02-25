<?php
/**
 * Brand
 *
 * @copyright Copyright © 2024 Vivek Bhatt. All rights reserved.
 * @author    vivekbhatt119@gmail.com
 */

namespace Vivek\ShopByBrand\Model\Layer;

class Brand extends \Magento\Catalog\Model\Layer
{
    /**
     * @var \Vivek\ShopByBrand\Model\ConfigHelper
     */
    private $configHelper;
    /**
     * @var \Magento\Framework\App\Request\Http
     */
    private $request;

    public function __construct(
        \Magento\Catalog\Model\Layer\ContextInterface $context,
        \Magento\Catalog\Model\Layer\StateFactory $layerStateFactory,
        \Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $attributeCollectionFactory,
        \Magento\Catalog\Model\ResourceModel\Product $catalogProduct,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Registry $registry,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Vivek\ShopByBrand\Model\ConfigHelper $configHelper,
        \Magento\Framework\App\Request\Http $request,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $layerStateFactory,
            $attributeCollectionFactory,
            $catalogProduct,
            $storeManager,
            $registry,
            $categoryRepository,
            $data
        );
        $this->configHelper = $configHelper;
        $this->request = $request;
    }

    /**
     * Retrieve current layer product collection
     *
     * @return \Magento\Catalog\Model\ResourceModel\Product\Collection
     */
    public function getProductCollection()
    {
        if (isset($this->_productCollections[$this->getCurrentCategory()->getId()])) {
            $collection = $this->_productCollections[$this->getCurrentCategory()->getId()];
        } else {
            $collection = $this->collectionProvider->getCollection($this->getCurrentCategory());
            $this->prepareProductCollection($collection);
            $collection->addFieldToFilter($this->configHelper->getAttribute(), $this->getBrandId());
            $this->_productCollections[$this->getCurrentCategory()->getId()] = $collection;
        }

        return $collection;
    }

    public function getBrandId()
    {
        return $this->request->getParam("brand_id", null);
    }
}
