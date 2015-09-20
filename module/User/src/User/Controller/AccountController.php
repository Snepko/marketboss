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
                echo "Form is submitted!";
            }else{
                
                echo "<p>Form not valid!</p>";
            }
        }
        
        //pass the data to the view for visualization
        return array('form1' => $form);
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
        return new ViewModel();
    }


}

