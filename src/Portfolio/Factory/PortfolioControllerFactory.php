<?php
// Filename: /module/Portfolio/src/Portfolio/Factory/PortfolioControllerFactory.php
namespace Portfolio\Factory;

use Portfolio\Controller\PortfolioController;
// use Portfolio\Service\PortfolioService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PortfolioControllerFactory implements FactoryInterface {
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        // When using a Factory-Class that will be called from the ControllerManager it will
        // actually inject itself as the $serviceLocator. However, we need the real
        // ServiceManager to get to our Service-Classes. This is why we call the
        // function getServiceLocator()` who will give us the real ``ServiceManager.
        $realServiceLocator = $serviceLocator->getServiceLocator();
        $portfolioService = $realServiceLocator->get('portfolio-portfolio-service');

        return new PortfolioController($portfolioService);
    }
}