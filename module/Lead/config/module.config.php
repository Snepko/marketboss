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
            'lead' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/lead',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Lead\Controller',
                        'controller'    => 'Lead',
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
            'lead-add' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/lead/lead/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Lead\Controller',
                        'controller'    => 'Account',
                        'action'        => 'add',
                    ),
                ),
             ),
             
             'lead-view' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/lead/lead/view',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Lead\Controller',
                        'controller'    => 'Lead',
                        'action'        => 'view',
                    ),
                ),
             ),
             
             'lead-home' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/lead',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Lead\Controller',
                        'controller'    => 'Lead',
                        'action'        => 'index',
                    ),
                ),
             ),
			 
			 'lead-list' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/lead/lead/list',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Lead\Controller',
                        'controller'    => 'Lead',
                        'action'        => 'list',
                    ),
                ),
             ),

        ),
    ),
    'service_manager' => array(
        'invokables'    =>  array(
           
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
            'Lead\Controller\Lead' => 'Lead\Controller\LeadController',
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
    			'label' => 'Lead',
    			'route' => 'lead',
    			'pages' => array(
    				array(
    					'label' => 'Leads Home',
    					'route' => 'lead-home',
    				),
    				array(
    					'label' => 'Add',
    					'route' => 'lead-add',
    				),
    				array(
    					'label' => 'List Leads',
    					'route' => 'lead-list',
    				),
    			),
    		),
       	),
    ),
);
