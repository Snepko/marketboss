<?php
return array(
    'router' => array(
        'routes' => array(
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'lead-stream' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/lead-stream',
                    'defaults' => array(
                        '__NAMESPACE__' => 'LeadStream\Controller',
                        'controller'    => 'Index',
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
            
			'lead-stream-add' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/LeadStream/Index/add',
                    'defaults' => array(
                        '__NAMESPACE__' => 'LeadStream\Controller',
                        'controller'    => 'Index',
                        'action'        => 'add',
                    ),
                ),
             ),
			
			'lead-stream-list' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/lead',
                    'defaults' => array(
                        '__NAMESPACE__' => 'LeadStream\Controller',
                        'controller'    => 'Index',
                        'action'        => 'list',
                    ),
                ),
			),
        ),
    ),
    
    'service_manager' => array(
        'invokables'    =>  array(
           'LeadStream' => 'LeadStream\Model\LeadStream'
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
            'LeadStream\Controller\Index' => 'LeadStream\Controller\IndexController',
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
    			'label' => 'Lead Stream',
    			'route' => 'lead-stream',
    			'pages' => array(
    				array(
    					'label' => 'Lead Stream',
    					'route' => 'lead-stream',
    				),
    				array(
    					'label' => 'Add Lead',
    					'route' => 'lead-stream-add',
    				),
    				array(
    					'label' => 'List Leads',
    					'route' => 'lead-stream-list',
    				),
    			),
    		),
       	),
    ),
);
