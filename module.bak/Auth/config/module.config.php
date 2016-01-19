<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'auth' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Auth\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/index',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                    'view' => array(
                        'type' => 'Segment',
                        'options' => array(
                            'route' => '/view[/:id]',
                            'constraints' => array(
                                'id' => '[0-9]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'auth-login' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth/login',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Auth\Controller',
                        'controller'    => 'Index',
                        'action'        => 'login',
                        'id' => '[0-9]*', 
                    ),
                ),
            ),
            'auth-logout' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/auth/logout',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Auth\Controller',
                        'controller'    => 'Index',
                        'action'        => 'logout',
                        'id' => '[0-9]*', 
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'aliases' => array(
            'Zend\Authentication\AuthenticationService' => 'auth_service',
        ),
        'invokables'    =>  array(
           'AuthModel' => 'Auth\Model\Auth',
           'auth_service' => 'Zend\Authentication\AuthenticationService',
        ),
        'factories' => array(
            'Auth\Table\AuthTable' => 'Auth\Table\Factory\AuthTableFactory',
	       'Auth\Table\AuthTableGateway' => 'Auth\Table\Factory\AuthTableGatewayFactory',
        ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            // 'Auth\Controller\Account' => 'Auth\Controller\AccountController',
            // 'Auth\Controller\Index' => 'Auth\Controller\IndexController'
        ),
        'factories' => array(
            'Auth\Controller\Index' => 'Auth\Controller\Factory\IndexControllerFactory',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'paginator-default' => __DIR__ . '/../view/auth/index/partials/pagination.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
