<?php

namespace ACL\Service\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Permissions\Acl\Acl as AccessControlList;

class Acl implements FactoryInterface {

	public function createService(ServiceLocatorInterface $serviceLocator)
	{

		$request = $serviceLocator->get('Request');
		$router  = $serviceLocator->get('Router');
		$match   = $router->match($request); // \Zend\Mvc\Router\RouteMatch
		$params = $match->getParams();
		$controller = array_shift($params);
		$controller_exploded = explode('\\', $controller);
		$module = array_shift($controller_exploded);
		
		$config = $serviceLocator->get('config');
		$aclConfig = $config['acl'];
		$aclConfigModule = $config['acl'][$module];

		$acl = new AccessControlList();

	
		// Add the defined resources
		//print_r($aclConfig['resource']);
		//$acl->addResource('employeeaccount');

		foreach($aclConfigModule['resource'] as $resource=>$parent){
			$acl->addResource($resource, $parent);
		}


		// Add the defined roles
		foreach($aclConfig['role'] as $role=>$parents){
			$acl->addRole($role, $parents);
		}

		// Add the allow and deny definitions
		foreach(array('allow','deny') as $action){
			foreach($aclConfigModule[$action] as $definition){
				call_user_func_array(array($acl, $action), $definition);
			}
		}

		return $acl;

	}

}