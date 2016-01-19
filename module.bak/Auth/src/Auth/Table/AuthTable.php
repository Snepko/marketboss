<?php

namespace Auth\Table;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\TableGateway\Where as WherePredicate;
use Auth\Model\Auth;

class AuthTable
{
	const DATETIME_FORMAT = 'Y-m-d';
	public $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function hello()
	{
		echo "Hello world!";
	}
	
	public function fetchAll($company_id = null, $active = 1)
    {
	    
    	$select = $this->tableGateway->getSql()->select();
	    $select->where(array(
				'company_id' => $company_id,
				'active' => $active,
			));
	    $select->order('name ASC');

	    $results = $this->tableGateway->selectWith($select);
		
		return $results->buffer();
    }

	public function save(Auth $auth)
	{
		if(!$auth->id){
			if($this->tableGateway->insert($auth->getArrayCopy())){
				return $this->tableGateway->getLastInsertValue();
			}
		}
	}
	
	public function delete($id)
	{
		if(!empty($id)){
			$select = $this->tableGateway->delete(
				array('id' => (int)$id)
			);
		}
	}
	
	public function fetchById($id)
	{
		if(!empty($id)){
			$select = $this->tableGateway->getSql()->select();
			$select->where(array('id' => $id));
			
			$results = $this->tableGateway->selectWith($select);
			if($results->count() == 1){
				return $results->current();
			}
		}
		
		return false;
	}
	
	public function fetchMostRecent($limit = 5)
	{
		$select = $this->tableGateway->getSql()->select();
		$select->limit((int)$limit)
				->order('timestamp DESC');
		$results = $this->tableGateway->selectWith($select);
		
		return $results->buffer();
	}
	
	/*
public function fetchByDateRange(\DateTime $startDate = null, \DateTime $endDate = null)
	{
		$select = $this->tableGateway->getSql()->select();
		$where = new WherePredicate;
		
		if(!is_null($startDate)){
			$where->greaterThanOrEqualTo(
				'releaseDate', $startDate->format(self::DATETIME_FORMAT)
			);
		}
		
		if(!is_null($endDate)){
			$where->lessThanOrEqualTo(
				'releaseDate', $endDate->format(self::DATETIME_FORMAT);
			);
		}
		
		$select->where($where)->order('releaseDate DESC');
		
		$results = $this->tableGateway->selectWith($select);
		 
		return $results->buffer();
	}
	
	public function fetchByDirector($director)
	{
		$select = $this->tableGateway->getSql()->select();
		$where = new WherePredicate;
		
		$select->join(
			'tbldirectors',
			$this->tableGateway->getTable() . '.directorId',
				array(
					'firstName','lastName', 'dateOfbirth','nationality'
				),
			\Zend\Db\Sql\Select::JOIN_LEFT
		);
		
		if(is_int($director)){
			$where->equalTo(
				$this->tableGateway->getTable() . '.directorId',
				$director
			);
		}
		
		if(is_string($director)){
			$where->like('firstName', $director . '%')
				->or
				->like('lastName', $director . '%');
		}
		
		$select->where($where)->order('releaseDate DESC');
		$results = $this->tableGateway->selectWith($select);
		
		return $results->buffer();
	}
*/
}