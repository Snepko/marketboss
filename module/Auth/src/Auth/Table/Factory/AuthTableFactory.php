<?php

namespace Auth\Table\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Auth\Table\AuthTable;

class AuthTableFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$tableGateway = $serviceLocator->get(
			'Auth\Table\AuthTableGateway'
		);

		$table = new AuthTable($tableGateway);

		return $table;
	}
}