<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonPortfolio for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            'portfolio' => array(
                'type' => 'literal',
                'options' => array(
                    'route'    => '/portfolio',
                    'defaults' => array(
                        'controller' => 'portfolio-portfolio-controller',
                        'action'     => 'index'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'single' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/:title',
                            'defaults' => array(
                                'action' => 'view'
                            ),
                        ),
                    ),
                ),
            ),
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /portfolio/:controller/:action
            'admin' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/admin/portfolio',
                    'defaults' => array(
                        'controller' => 'portfolio-admin-controller',
                        'action'     => 'index',
                    )
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'edit' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/:action[/:id]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'id' => '\d+',
                            ),
                            'defaults' => array(
                                'action' => 'add'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'invokables' => array(
            // 'Portfolio\Controller\Index' => 'Portfolio\Controller\IndexController',

        ),
        'factories' => array(
            'db-adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
            'portfolio-portfolio-service' => 'Portfolio\Factory\PortfolioServiceFactory'
        ),
    ),
    'controllers' => array(
        'invokables' => array(
        ),
        'factories' => array(
            'portfolio-portfolio-controller' => 'Portfolio\Factory\PortfolioControllerFactory',
            'portfolio-admin-controller' => 'Portfolio\Factory\AdminControllerFactory'
        )
    ),
    'view_manager' => array(
        'template_map' => array(
            'admin/layout'           => __DIR__ . '/../../Application/view/layout/admin.phtml',
        ),
        'template_path_stack' => array(
            'portfolio' => __DIR__ . '/../view',
        ),
        'layout' => 'admin/layout',
    ),
    'view_helpers' => array(
        'factories' => array(
            'portfolioUrl' => function($sm) {
                return new Portfolio\View\Helper\PortfolioUrl($sm->getServiceLocator()->get('Request'));
            },
        )
    ),
    'form_elements' => array(
        'invokables' => array(
            'portfolio-portfolio-form' => 'Portfolio\Form\PortfolioForm',
        ),
        'factories' => array(
                // 'portfoliofieldset' => 'Portfolio\Factory\PortfolioFieldsetFactory'
        )
    ),
);
