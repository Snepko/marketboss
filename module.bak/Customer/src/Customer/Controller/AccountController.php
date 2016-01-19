<?php

namespace Customer\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Customer\Form\Customer as CustomerForm;
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
           // print_r($post);
            
            $data = array_merge_recursive($this->getRequest()->getPost()->toArray());
            
            /*
echo "Data is: ";
            print_r($data);
            echo "<p>This is a test.</p>";
*/
            $form->setData($data);
            
            if($form->isValid())
            {
                // @todo:  save the data of the new customer
            }
        }
        return array('form1'=> $form);
    }

    public function addAction()
    {
        $data = array(
            'test1' => 'Testing number 1',
            'test2' => 'Testing number 2',
        );
        
        $view = new ViewModel($data);
        $view->setVariable('testview', 'This is the variable test');
        $view->setVariables(array(
           'car' => 'porsche',
            'truck' => 'Avalance',
        ));
        //$view->setTemplate('customer-template');
        
        $event = new EventManager('customer');
        $event->trigger(__FUNCTION__, $this, array('test event' => 'this is the test'));
        return $view;
    }

    public function editAction()
    {
        $test = $this->getServiceManager();
        
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
            FROM testing
        ";
         
        $result = $db->query($sql, array());
        //print_r($result);
        return $result;
    }


}

