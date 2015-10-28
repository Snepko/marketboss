<?php

namespace LeadStream\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
    	
    	$leadStream = $this->serviceLocator->get('LeadStream');
    	$result = $leadStream->testLeadStream();
    
		$viewModel = new viewModel();
		$viewModel->setVariable('lead_stream', $result);
		
        return $viewModel;
    }

    public function addAction()
    {
        return new ViewModel();
    }

    public function listAction()
    {
        return new ViewModel();
    }


}

