<?php
namespace Customer\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;

class Customer extends AbstractTableGateway
{

	public $serviceLocator; 
	
    public function __construct()
    {
        $this->table = 'customers';
        $this->featureSet = new Feature\FeatureSet();
        $this->featureSet->addFeature(new GlobalAdapterFeature());
        $this->initialize();
    }
    
    public function fetchAll()
    {
	    $db = $this->serviceLocator->get('db');
	    
	    $sql = "
            SELECT *
            FROM customers
        ";
         
        $result = $db->query($sql, array());

	    return $result;
    }
    
    public function setServiceLocator($serviceLocator)
    {
    	$this->serviceLocator = $serviceLocator;
    }
}