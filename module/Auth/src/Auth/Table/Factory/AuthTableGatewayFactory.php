<?php

namespace Auth\Table\Factory;

use Auth\Model\Auth;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ArraySerializable;
use Zend\Db\ResultSet\HydratingResultSet;
use Zend\Db\TableGateway\TableGateway;

class AuthTableGatewayFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		$dbAdapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
		$hydrator = new ArraySerializable();
		$prototype = new Auth();
		$resultSet = new HydratingResultSet($hydrator, $prototype);

		return new TableGateway('users', $dbAdapter, null, $resultSet);
	}
}