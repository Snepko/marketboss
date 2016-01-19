<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {       	
    	$sl = $this->getServiceLocator();
    	$config = $sl->get('config');
    	
    	$layoutViewModel = new ViewModel();
    	$layoutViewModel->setTemplate('layout/layout-test');
    	
    	$viewModel = new ViewModel();
    	$viewModel->setTemplate('application/index/about');
    	
    	$layoutViewModel->addChild($viewModel, 'content');
    	
    	return $layoutViewModel;
    		
    }

    public function aboutAction()
    {
    	$vm = new ViewModel();
    	$vm->setTemplate('layout/layout-no-footer');
    	
    	$vm->setVariables(
    		array(
    			'var1' => 'variable 1 value',
    			'var2' => 'variable 2 value',
    			'var3' => 'variable 3 value',
    		)
    	);
    	
    	return $vm;
     }

	 public function testingAction()
	 {
		 $vm = new ViewModel();
		 $vm->setVariables(array(
		 	'testing' => 'This is the testing variable',
		 	'testing2' => 'This is the second testing variable',
		 ));
		 
		 return $vm;
	 }

}

