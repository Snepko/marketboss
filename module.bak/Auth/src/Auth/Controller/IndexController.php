<?php
namespace Auth\Controller;

// Authentication includes
use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session as SessionStorage;
use Zend\Authentication\Adapter\DbTable as AuthAdapter;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Auth\Form\LoginForm as LoginForm;
use Auth\Model\Auth as AuthModel;
use Zend\Session\SessionManager;
use Zend\Session\Container; 
use Auth\Table\AuthTable;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\Iterator;
use Zend\Paginator\Adapter\Adapter;
use Auth\Form\LoginFormFilter;


class IndexController extends AbstractActionController
{
    protected $authTable;
    //protected $identity;

    const DEFAULT_PAGE = 1;
    const DEFAULT_RECORDS_PER_PAGE = 20;

    public function __construct(AuthTable $authTable)
    {
        $this->authTable = $authTable;
        //$this->identity = new Container('auth');
        
    }

    public function loginAction()
    {

        //$user = $this->identity();
        $form = new LoginForm();
        $form->setInputFilter(new LoginFormFilter());

        $view = new ViewModel();
        // $user = $this->identity();
        // $view->setVariable('use', $user);

        if($this->getRequest()->isPost()){
            $form->setData($this->getRequest()->getPost());
            if($form->isValid()){
                
                $sm = $this->getServiceLocator();
                $db = $sm->get('db');
                $config = $sm->get('config');

                $username = $this->getRequest()->getPost('username');
                $credential = $this->getRequest()->getPost('password');

                $authAdapter = new AuthAdapter($db,
                    'resources', 
                    'username', 
                    'password',
                    'sha1(?) AND active = 1'
                );

                //Authenticate
                $authAdapter
                    ->setIdentity($username)
                    ->setCredential($credential);

                $auth = new AuthenticationService();
                $result = $auth->Authenticate($authAdapter);


                if($result->isValid()){
                    $columnsToOmit = array('password');
                    //echo "<br />User: " . print_r($authAdapter->getResultRowObject(null, $columnsToOmit));

                    $storage = $auth->getStorage();
                    $storage->write($authAdapter->getResultRowObject(null, 'password'));

                    $_SESSION['user_id'] = $this->identity()->id;
                    $_SESSION['user'] = get_object_vars($this->identity());
                    $_SESSION['company_id'] = $this->identity()->company_id;

                    $this->flashMessenger()->addMessage('User authenticated!');

                    //$this->redirect()->toRoute('auth');
                    $this->redirect()->toUrl('/h/homepage.php');
                    
                }else{
                    $this->flashMessenger()->addErrorMessage('User not authenticated.');
                }
            }
        }else{
            
        
        }
        $view->setVariable('form', $form);
        $view->setVariable('post_vars', $this->getRequest()->getPost());

        $this->layout('layout/login');

        return $view;
    }

    public function logoutAction()
    {

        $storage = new \Zend\Authentication\Storage\Session();
        $storage->clear();
        
        $this->redirect()->toRoute('auth-login');

        return new ViewModel();
    }

    public function indexAction()
    {
        
    	//$result = $auth->fetchById($this->identity->id);

    	$view = new ViewModel();

        $view->setVariables(array(
            'allRouteParams' => $this->params()->fromRoute(),
            'paramPage' => $this->params()->fromRoute('page'),
            'user' => $this->identity(),
        ));
        return $view;
    }

}



