<?php

namespace Vivek\ShopByBrand\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;

class Router implements RouterInterface
{
    protected $transportBuilder;
    protected $actionFactory;

    /**
     * Router constructor
     *
     * @param ActionFactory $actionFactory
     */
    public function __construct(ActionFactory $actionFactory)
    {
        $this->actionFactory = $actionFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function match(RequestInterface $request)
    {
        $result = null;

        if ($request->getModuleName() != 'brand' && $this->validateRoute($request)) {
            $request->setModuleName('brand')
                ->setControllerName('view')
                ->setActionName('index')
                ->setParam('brand_id', 3);
            $result = $this->actionFactory->create(Forward::class);
        }
        return $result;
    }

    /**
     * @param RequestInterface $request
     * @return bool
     */
    public function validateRoute(RequestInterface $request)
    {
        $identifier = trim($request->getPathInfo(), '/');
        return strpos($identifier, 'brand_router') !== false;
    }
}
