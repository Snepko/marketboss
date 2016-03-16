<?php
namespace ACL;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleEvent;
use Zend\EventManager\Event;
use Zend\Mvc\MvcEvent;
use Model\AclModel as AclModel;

use Zend\Authentication\AuthenticationService;

class Module
{

    public $identity; 

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    
    public function onBootstrap($e)
    {
        $eventManager = $e->getApplication()->getEventManager();
        $eventManager->attach('dispatch', array($this, 'checkPermissions'), 100);
    }

    public function checkPermissions(MvcEvent $e)
    {
        $matches = $e->getRouteMatch();
        $controller = $matches->getParam('controller');
        $action = $matches->getParam('action');

        $auth = new AuthenticationService;
        $this->identity = $auth->getIdentity();

       // echo "<p>The role is : " . $this->identity->access_level . "</p>";

        if(!$auth->hasIdentity()){
           $e->getRouteMatch()
            ->setParam('controller', 'Auth\Controller\Index')
            ->setParam('action', 'login');
        }

        $serviceManager = $e->getApplication()->getServiceManager();
        $acl = $serviceManager->get('acl');
        
            $this->identity->access_level;
            $allowed = $acl->isAllowed($this->identity->access_level, $controller, $action) ? true : false;
        
        if(!$allowed){
           $e->getRouteMatch()
            ->setParam('controller', 'Auth\Controller\Index')
            ->setParam('action', 'unauthorized');
        }
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
