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
            'customer' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/customer',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Customer\Controller',
                        'controller'    => 'Account',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'invokables'    =>  array(
           'testClass' => 'Customer\Model\TestClass'
        ),
        'factories' => array(
            
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
            'Customer\Controller\Account' => 'Customer\Controller\AccountController',
            'Customer\Controller\Index' => 'Customer\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'customer-template' => __DIR__ . '/../view/customer/account/customer-template.phtml',
            'customer-menu' => __DIR__ . '/../view/customer/account/customer-menu.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
);
