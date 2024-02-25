<?php

namespace Vivek\ShopByBrand\ViewModel;

use Magento\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Api\ProductAttributeRepositoryInterface;
use Magento\Eav\Model\Entity\Attribute\Source\TableFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Vivek\ShopByBrand\Model\ConfigHelper;

class AttributeHelper implements ArgumentInterface
{
    /**
     * @var ConfigHelper
     */
    private $configHelper;
    /**
     * @var ProductAttributeRepositoryInterface
     */
    private $attributeRepository;
    /**
     * @var TableFactory
     */
    private $tableFactory;
    /**
     * @var ProductAttributeInterface
     */
    private $attribute;

    public function __construct(
        ConfigHelper $configHelper,
        ProductAttributeRepositoryInterface $attributeRepository,
        TableFactory $tableFactory
    ) {
        $this->configHelper = $configHelper;
        $this->attributeRepository = $attributeRepository;
        $this->tableFactory = $tableFactory;
    }

    public function getAttributeOptions()
    {
        try {
            $attribute = $this->getAttribute($this->configHelper->getAttribute());
        } catch (NoSuchEntityException $e) {
            return [];
        }
        /** @var \Magento\Eav\Model\Entity\Attribute\Source\Table $sourceModel */
        $sourceModel = $this->tableFactory->create();
        $sourceModel->setAttribute($attribute);
        return $sourceModel->getAllOptions(false);
    }

    public function getOptionTitle($id)
    {
        try {
            $attribute = $this->getAttribute($this->configHelper->getAttribute());
        } catch (NoSuchEntityException $e) {
            return [];
        }
        /** @var \Magento\Eav\Model\Entity\Attribute\Source\Table $sourceModel */
        $sourceModel = $this->tableFactory->create();
        $sourceModel->setAttribute($attribute);
        return $sourceModel->getOptionText($id);
    }

    /**
     * Get attribute by code.
     *
     * @param string $attributeCode
     * @return ProductAttributeInterface
     * @throws NoSuchEntityException
     */
    private function getAttribute($attributeCode)
    {
        if (!$this->attribute) {
            $this->attribute = $this->attributeRepository->get($attributeCode);
        }
        return $this->attribute;
    }
}
