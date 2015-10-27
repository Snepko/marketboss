<?php

namespace LeadStream\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class LeadStream extends AbstractTableGateway {
	
	
	public function __construct(){
		$this->table = 'lead_stream';
        $this->featureSet = new Feature\FeatureSet();
        $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
        $this->initialize();
	}
	
	/**
	 * Find all leads based on the main customer list filter
	 * @return object array
	 */
	/*
public static function fetchAll(){
		global $pdo;
		
		$sql = "
		SELECT *
		FROM lead_stream
		WHERE 1 = 1
		";

		$sql .= " AND lead_stream.company_id = '" .$_SESSION['company_id']."' ";
		
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
	
		$result = $stmt->fetchAll(PDO::FETCH_CLASS, "EcoLeadStream");

		return $result;
	}

	public static function matchCompany($company_name){
		global $pdo;
		$sql = "
			SELECT * FROM customers WHERE company LIKE '" . $company_name . "'";

		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		
		$result = $stmt->fetchAll(PDO::FETCH_CLASS, "EcoCustomer");

		return array_shift($result);
	}
*/
}
?>