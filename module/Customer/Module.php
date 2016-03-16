<?php
namespace Customer;
use Zend\EventManager\EventManager;
class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

	public function onBootstrap($e)
    {        
        $services = $e->getApplication()->getServiceManager();
        $dbAdapter = $services->get('db');
        \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::setStaticAdapter($dbAdapter);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
