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
            'acl' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/acl',
                    'defaults' => array(
                        '__NAMESPACE__' => 'ACL\Controller',
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
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'invokables'    =>  array(
           
        ),
        'factories' => array(
            'acl' => 'ACL\Service\Factory\Acl',
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
            'paginator-default' => __DIR__ . '/../view/acl/index/partials/pagination.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    'acl' => array(
        'role' => array(
            'technician' => null,
            'lead_hand' => array('technician'),
            'estimator' => array('lead_hand'),
            'dispatch' => null,
            'management' => null,
        ),

        
        //List of modules to apply the ACL.
        //This is how we can specify if we have to protect the pages in our current module.
        'modules' => array(
            'ACL',
            'Employee'
        ),
    ),
);
