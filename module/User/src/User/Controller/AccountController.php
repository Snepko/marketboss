<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Form\User as UserForm;
use User\Model\User as UserModel;

class AccountController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function addAction()
    {
    	$viewModel = new ViewModel();
        $form = new UserForm();
        if($this->getRequest()->isPost())
        {
            $data = array_merge_recursive(
                $this->getRequest()->getPost()->toArray(),
                $this->getRequest()->getFiles()->toArray()
            );
            
            $form->setData($data);
            if($form->isValid()){
                // @todo: save the data of the new user
                $model = new UserModel();
                $id = $model->insert($form->getData());
                $viewModel->setVariable('message', "<p class='alert alert-success'>Form is submitted!</p>");
                
            }else{
            	$viewModel->setVariable('message', "<p class='alert alert-error'>Form not valid!</p>");
            }
        }
        
        $viewModel->setVariable('form1', $form);
        //pass the data to the view for visualization
        return $viewModel;
        
     }

    /**
     * This is used to register new accounts
     */
    public function registerAction()
    {
        return new ViewModel();
    }

    public function viewAction()
    {	
        return new ViewModel();
    }

    public function editAction()
    {
         return new ViewModel();
    }

    public function deleteAction()
    {
    	$id = $this->getRequest()->getQuery()->get('id');
    	if($id) {
	    	$userModel = new UserModel();
	    	$userModel->delete(array('id'=>$id));
    	}
    	
    	$this->flashMessenger()->addMessage('<span class="alert alert-success">The user has been deleted!</span>');
    	$this->redirect()->toRoute('user-list');
    	
        return new ViewModel();
    }

	public function listAction()
	{
		$db = $this->getServiceLocator()->get('db');
        $sql = "
            SELECT *
            FROM users
        ";
         
        $users = $db->query($sql, array());
        $view = new ViewModel();
        
        $view->setVariable('users', $users);
       // $view->setVariable('flashMessages', $this->flashMessenger()->getMessages());
        //print_r($result);
        return $view;
	}
	
	public function homeAction()
	{
		return new ViewModel();
	}

}

