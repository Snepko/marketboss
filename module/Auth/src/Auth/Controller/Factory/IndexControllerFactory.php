<?php

namespace Auth\Controller\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Controller\IndexController;

class IndexControllerFactory implements FactoryInterface
{

	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$sm = $serviceLocator->getServiceLocator();
		$controller = new IndexController($sm->get('Auth\Table\AuthTable'));

		return $controller;
	}
}