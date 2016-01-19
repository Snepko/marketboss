<?php
namespace Debug;

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

    public function onBootstrap(MvcEvent $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach('MvcEvent::EVENT_DISPATCH_ERROR', array($this, 'handleError'));
        
        $eventManager->attach('MvcEvent::EVENT_RENDER', array($this, 'addDebugOverlay'),100);
        
       /*
 $timer = $serviceManager->get('Timer');
        $timer->start('mvc-execution');
        
        // Finish event is triggered
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_FINISH, array($this, 'getMvcDuration'),2);
*/
    }
    
    public function addDebugOverlay(MvcEvent $event)
    {
	    $viewModel	=	$event->getViewModel();
	    $sidebarView = new ViewModel();
	    $sidebarView->setTemplate('debug/layout/sidebar');
	    $sidebarView->addChild($viewModel, 'content');
	    
	    $event->setViewModel($sideBarView);
    }
    public function getMvcDuration(MvcEvent $event)
    {
       /*
 // Here we get the Service Manager
        $serviceManager = $event->getApplication()->getServiceManager();
        
        // Get the already created instance of our timer service
        $timer = $serviceManager->get('timer');
        $duration = $timer->stop('mvc-execution');
        
        //echo "MVC Duration: " . $duration . " seconds.";
*/
    }
    
    public function handleError(MvcEvent $event)
    {
       /*
 $controller =   $event->getController();
        $error      =   $event->getParam('error');
        $exception  =   $event->getParam('exception');
        
        $message    =   sprintf('Error dispatching controller "%s" Error was: "%s"', $controller, $error);
        echo $message;
        
        if($exception instanceof \Exception)
        {
            $message .= ',
                  Exception('.$exception->getMessage().'): ' . $exception->getTraceAsString();
        }
        error_log($message);
*/
    }
    
    
    public function init(ModuleManager $moduleManager)
    {
		$eventManager = $moduleManager->getEventManager();
		$eventManager->attach(ModuleEvent::EVENT_LOAD_MODULES_POST, array($this, 'loadedModulesInfo'));
    }
    
    public function loadedModulesInfo(Event $event)
    {
	    $moduleManager = $event->getTarget();
	    $loadedModules = $moduleManager->getLoadedModules();
	    
	    
	   // echo var_export($loadedModules, true);
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
