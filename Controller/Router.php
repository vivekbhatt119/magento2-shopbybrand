<?php
declare(strict_types=1);

namespace Vivek\ShopByBrand\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\Action\Forward;
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
        
        if ($request->getModuleName() != 'example' && $this->validateRoute($request)) {
            $request->setModuleName('example')
                ->setControllerName('index')
                ->setActionName('index')
                ->setParam('param', 3);
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

