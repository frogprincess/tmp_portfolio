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

     public function onBootstrap(MvcEvent $e)
    {
        $sem = $e->getApplication()->getEventManager()->getSharedManager();

        $sem->attach( 'Zend\Mvc\Controller\AbstractController', 'dispatch', function($e)
        {
            $config = $e->getApplication()->getServiceManager()->get('config');
            $routeMatch = $e->getRouteMatch();
            // $namespace = array_shift(explode('\\', $routeMatch->getParam('controller')));
            $controller = $e->getTarget();
            // $controllerNameArray = explode('\\', $routeMatch->getParam('controller'));
            // $controllerName = array_pop($controllerNameArray);
            $controllerName = $routeMatch->getMatchedRouteName();
            $actionName = strtolower($routeMatch->getParam('action'));

            // // Use the layout assigned to the action
            // if(isset($config['layouts'][$namespace]['controllers'][$controllerName]['actions'][$actionName]))
            // {
            //     $controller->layout($config['layouts'][$namespace]['controllers'][$controllerName]['actions'][$actionName]);
            // }
            // // Use the controller default layout
            // elseif(isset($config['layouts'][$namespace]['controllers'][$controllerName]['default']))
            // {
            //     $controller->layout($config['layouts'][$namespace]['controllers'][$controllerName]['default']);
            // }
            // // Use the module default layout
            // elseif(isset($config['layouts'][$namespace]['default']))
            // {
            //     $controller->layout($config['layouts'][$namespace]['default']);
            // }
            $controller->layout()->setVariables(array(
                'headerTemplate' => $config['layout']['header'],
                'bodyId' => $controllerName,
                'bodyClass' => $actionName
            ));

        }, 10);
    }


    public function onDispatch(MvcEvent $e) {
        $services = $event->getApplication()->getServiceManager();
        $config = new \Zend\Config\Config($services->get('config'));

        $controller = $e->getTarget();
        $controller->layout()->setVariables(array(
            'headerTemplate' => $config->layout->header,
            'bodyId' => 'admin',
            'bodyClass' => 'index',
            //'title' => $this->title,
        ));
    }
}
