<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\EventManager\EventManager;
use Zend\ServiceManager\ServiceManager;

class IndexController extends AbstractActionController
{

    public function indexAction()
    {
        return new ViewModel();
    }

    public function eventAction()
    {
        return new ViewModel();
    }


}

