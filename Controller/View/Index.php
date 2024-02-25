<?php
declare(strict_types=1);

namespace Vivek\ShopByBrand\Controller\View;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\Layer\Resolver;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;
use Vivek\ShopByBrand\ViewModel\AttributeHelper;

class Index implements HttpGetActionInterface
{

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var Resolver
     */
    private $resolver;
    /**
     * @var Registry
     */
    private $registry;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    /**
     * @var Http
     */
    private $request;
    /**
     * @var AttributeHelper
     */
    private $attributeHelper;

    /**
     * Constructor
     *
     * @param PageFactory $resultPageFactory
     * @param Resolver $resolver
     * @param Registry $registry
     * @param CategoryRepositoryInterface $categoryRepository
     * @param StoreManagerInterface $storeManager
     * @param Http $request
     * @param AttributeHelper $attributeHelper
     */
    public function __construct(
        PageFactory $resultPageFactory,
        Resolver $resolver,
        Registry $registry,
        CategoryRepositoryInterface $categoryRepository,
        StoreManagerInterface $storeManager,
        Http $request,
        AttributeHelper $attributeHelper
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->resolver = $resolver;
        $this->registry = $registry;
        $this->categoryRepository = $categoryRepository;
        $this->storeManager = $storeManager;
        $this->request = $request;
        $this->attributeHelper = $attributeHelper;
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $this->setCurrentCategory();
        $this->resolver->create("brand");
        return $this->resultPageFactory->create();
    }

    private function setCurrentCategory()
    {
        $category = $this->categoryRepository->get($this->storeManager->getStore()->getRootCategoryId());
        $category->setName($this->getTitle());
        $this->registry->register('current_category', $category);
    }

    private function getTitle()
    {
        $brandId = $this->request->getParam('brand_id');
        return $this->attributeHelper->getOptionTitle($brandId);
    }
}
