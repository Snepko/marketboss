<?php

namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Customer\Form\Customer as CustomerForm;
use Customer\Model\Customer as CustomerModel;
use Zend\EventManager\EventManager;

class AccountController extends AbstractActionController
{

    public function indexAction()
    {
        $form = new CustomerForm;
        
        // Manage the form submission
        if($this->getRequest()->isPost())
        {
            $data = array_merge_recursive($this->getRequest()->getPost()->toArray(), $this->getRequest()->getFiles()->toArray());
            $post = $this->getRequest()->getPost()->toArray();
            //echo 'Array of POST: ' . 
            print_r($post);
            
            $data = array_merge_recursive($this->getRequest()->getPost()->toArray());
            
            echo "Data is: ";
            print_r($data);
            echo "<p>This is a test.</p>";
            //$form->setData($data);
            
            /*
if($form->isValid())
            {
                // @todo:  save the data of the new customer
            }
*/
        }
        return array('form'=> $form);
    }

    public function addAction()
    {
    	$form = new CustomerForm();
        
        
        if($this->getRequest()->isPost())
        {
            $data = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            
            $form->setData($data);
            if($form->isValid()){
                // @todo: save the data of the new user
                $model = new CustomerModel();
                $id = $model->insert($form->getData());
                
                
                $message = "<p class='alert alert-success'>Form is submitted!</p>";
                
            }else{
            	$message = "<p class='alert alert-error'>Form not valid!</p>";
            }
        }

        $view = new ViewModel($data);
        $view->setVariable('message', $message);
        
        $view->setVariable('form', $form);
                //$view->setTemplate('customer-template');
        
        return $view;
    }

    public function editAction()
    {
        return new ViewModel();
    }

    public function deleteAction()
    {
        return new ViewModel();
    }

    public function viewAction()
    {
        $db = $this->getServiceLocator()->get('db');
        $sql = "
            SELECT *
            FROM customers
        ";
         
        $result = $db->query($sql, array());
        
        $view = new ViewModel();
        $view->setVariable('customers', $result);
        return $view;
    }
    
    public function listAction()
    {
    
    	$customer = $this->serviceLocator->get('CustomerModel');
    	$customer->setServiceLocator($this->serviceLocator);
    	
    	$customers = $customer->fetchAll();
                
        $num_customers = count($customers); 
        
        $view = new ViewModel();
        
        $view->setVariable('customers', $customers);
        $view->setVariable('num_customers', $num_customers);
        
        return $view;
    }

}

