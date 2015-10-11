<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Portfolio;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module {
    // public function onBootstrap(MvcEvent $e) {
    //     $eventManager        = $e->getApplication()->getEventManager();
    //     $moduleRouteListener = new ModuleRouteListener();
    //     $moduleRouteListener->attach($eventManager);
    // }

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    // public function onBootstrap(MvcEvent $event) {
    //     $services = $event->getApplication()->getServiceManager();
    //     $eventManager = $event->getApplication()->getEventManager();
    //     $eventManager->attach(MvcEvent::EVENT_DISPATCH_ERROR, array(
    //                             $this, 'handleError'
    //                             ));

    //     $sharedEventManager = $event->getApplication()->getEventManager()->getSharedManager();
    //     $sharedEventManager->attach('portfolio', 'portfolio-not-found', function($event) use($services) {
    //         $portfolio = $event->getParam('id');
    //         $log = $services->get('log');
    //         $log->warn('Error retrieving portfolio [' . $portfolio . ']');
    //     });
    // }

    // public function handleError(MvcEvent $event) {
    //     $controller = $event->getController();
    //     $error = $event->getParam('error');
    //     $exception = $event->getParam('exception');
    //     $message = 'Error: ' . $error;

    //     if ($exception instanceOf \Exception) {
    //         $message .= ', Exception(' . $exception->getMessage() . '): ' . $exception->getTraceAsString();
    //     }

    //     error_log($message);
    // }

    // public function onBootstrap(\Zend\EventManager\EventInterface $e) {
    //     $eventManager = $e->getApplication()->getEventManager();
    //     $sharedEventManager = $eventManager->getSharedManager();
    //     $sharedEventManager->attach('portfolio-admin-controller', \Zend\Mvc\MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'));
    // }

}
