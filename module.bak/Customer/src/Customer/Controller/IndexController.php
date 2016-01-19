<?php

namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\EventManager\EventManager;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        //return new ViewModel();
        /*
$serviceLocator		=	$this->getServiceLocator();
        $config = $serviceLocator->getService('config');
        $viewModel = new ViewModel();
        $viewModel->setVariables(
        	array(
        		'version'	=>	$config['application']['version'],
        		'applicationName'	=>	$config['application']['name'],
        	)
        );
*/
        
        $event = new EventManager('customer');
        $event->trigger(__FUNCTION__, $this, array('artist'=>'Adele'));
        
    }

    public function addAction()
    {
        return new ViewModel();
    }

    public function editAction()
    {
        return new ViewModel();
    }

    public function deleteAction()
    {
        return new ViewModel();
    }


}

