<?php
namespace User\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class User extends AbstractTableGateway
{

	public $serviceLocator;
	
    public function __construct($serviceLocator = null)
    {
    	$this->serviceLocator = $serviceLocator;
    	
        $this->table = 'users';
        $this->featureSet = new Feature\FeatureSet();
        $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
        $this->initialize();
    }
    
    public function setServiceLocator($serviceLocator)
    {
	    $this->serviceLocator = $serviceLocator;
    }
    
    public function getServiceLocator()
    {
	    return $this->serviceLocator;
    }
    
    public function fetchAll()
    {
	    $db = $this->getServiceLocator()->get('db');
        $sql = "
            SELECT *
            FROM {$this->table}
        ";
         
        $users = $db->query($sql, array());
		
		return $users;
    }
}
/*

$db = $this->getServiceLocator()->get('db');
        $sql = "
            SELECT *
            FROM users
        ";
         
        $users = $db->query($sql, array());
        
        $num_users = count($users);
*/