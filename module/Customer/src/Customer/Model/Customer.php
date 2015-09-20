<?php
namespace Customer\Model;

use \Zend\Db\TableGateway\AbstractTableGateway;
use \Zend\Db\TableGateway\Feature;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;

class Customer extends AbstractTableGateway
{
    public function __construct()
    {
        $this->table = 'customers';
        $this->featureSet = new Feature\FeatureSet();
        $this->featureSet->addFeature(new GlobalAdapterFeature());
        $this->initialize();
    }
}