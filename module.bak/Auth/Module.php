<?php
namespace Auth;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleEvent;
use Zend\EventManager\Event;
use Zend\Mvc\MvcEvent;

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
    
    public function init(ModuleManager $moduleManager)
    {
        //Testing
    }
    
    public function getServiceConfig()
    {
	   
    }
    
    public function protectPage(MvcEvent $event)
    {
	    $match = $event->getRouteMatch();
	    if(!$match){
		    // we cannot do anything without a resolved route
		    return;
	    }
	    
	    $controller = $match->getParam('controller');
	    $action = $match->getParam('action');
	    $namespace = $match->getParam('__NAMESPACE__');
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
