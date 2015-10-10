<?php
namespace Portfolio\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use Portfolio\Model\Portfolio;
use Portfolio\Form\PortfolioFieldset;

class PortfolioFieldsetFactory implements FactoryInterface {
    /**
    * createService
    *
    * @param ServiceLocatorInterface $serviceLocator
    * @return BlogTable
    */
    public function createService (ServiceLocatorInterface $sm) {
        $serviceLocator = $sm->getServiceLocator();
        $portfolioFieldset = new PortfolioFieldset();
        $portfolioFieldset->setObject(new Portfolio());
        return $portfolioFieldset;
    }
}

