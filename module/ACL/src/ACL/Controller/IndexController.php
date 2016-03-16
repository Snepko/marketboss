<?php
namespace ACL\Controller;

// Authentication includes
use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;


class IndexController extends AbstractActionController
{

   public function indexAction()
   {
        return new ViewModel();
   }

}



