<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Customer\Model\Customer as CustomerModel;
use User\Model\User as User;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {    
    	$leadStream = $this->serviceLocator->get('LeadStream');
    	$num_leads = $leadStream->getNumLeads();
    	
    	
    	// Customers
    	$customers = new CustomerModel;
    	$customers->setServiceLocator($this->serviceLocator);
    	
    	$customers = $customers->fetchAll();
    	
    	$num_customers = count($customers);
    	
    	
    	//Users
    	$users = new User($this->serviceLocator);
    	$users = $users->fetchAll();
    	$num_users = count($users);
    	
    	$viewModel = new viewModel();
    	$viewModel->setVariable('num_leads', $num_leads);
    	$viewModel->setVariable('num_customers', $num_customers);
    	$viewModel->setVariable('num_users', $num_users);
    	
        return $viewModel;
    }

    public function aboutAction()
    {
        return new ViewModel();
    }


}

