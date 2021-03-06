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
            'user' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/user',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
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
            'user-add' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/user/account/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'Account',
                        'action'        => 'add',
                    ),
                ),
             ),
             
             'user-view' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/user/account/view',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'Account',
                        'action'        => 'view',
                    ),
                ),
             ),
             
             'user-list' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/user/account/list',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'Account',
                        'action'        => 'list',
                    ),
                ),
             ),
			 'user-home' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/user/account/home',
                    'defaults' => array(
                        '__NAMESPACE__' => 'User\Controller',
                        'controller'    => 'Account',
                        'action'        => 'home',
                    ),
                ),
             ),

        ),
    ),
    'service_manager' => array(
        'invokables'    =>  array(
           'TestService' => 'User\Service\TestService'
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
            'User\Controller\Account' => 'User\Controller\AccountController',
            'User\Controller\Index' => 'User\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    
    'navigation' => array(
    	'default' => array(
    		array(
    			'label' => 'User',
    			'route' => 'user',
    			'pages' => array(
    				array(
    					'label' => 'User Home',
    					'route' => 'user-home',
    				),
    				array(
    					'label' => 'Add',
    					'route' => 'user-add',
    				),
    				array(
    					'label' => 'List Users',
    					'route' => 'user-list',
    				),
    			),
    		),
       	),
    ),
);
