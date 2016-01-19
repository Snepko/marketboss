<?php
namespace Customer;
use Zend\EventManager\EventManager;
use Zend\Mvc\MvcEvent;
class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

	public function onBootstrap(MvcEvent $event)
	{
		$eventManager 	=	$event->getApplication()->getEventManager();
		$sharedManager 	=	$eventManager->getSharedManager();

		$sharedManager->attach('customer', '*', [$this, 'customerEvent']);
		//.. This is a list of events to listen on. They will then fire the appropriate 
		//.. classes and methods
	}
	
	public function customerEvent($e)
	{
		
		echo "<h1>Function running for event!</h1>";
		echo "Event name: " . $e->getName() . "<br />";
		echo "Event class: " . get_class($e->getTarget()) . "<br />";
		
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
