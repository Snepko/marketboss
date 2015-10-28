<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {    
    	$leadStream = $this->serviceLocator->get('LeadStream');
    	$num_leads = $leadStream->getNumLeads();
    	
    	$viewModel = new viewModel();
    	$viewModel->setVariable('num_leads', $num_leads);
    	
        return $viewModel;
    }

    public function aboutAction()
    {
        return new ViewModel();
    }


}

