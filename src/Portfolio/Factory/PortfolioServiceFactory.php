<?php
// Filename: /module/Portfolio/src/Portfolio/Factory/PortfolioServiceFactory.php
namespace Portfolio\Factory;

use Portfolio\Service\PortfolioService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PortfolioServiceFactory implements FactoryInterface {
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator) {
        return new PortfolioService(
            $serviceLocator->get('db-adapter')
        );
    }
}