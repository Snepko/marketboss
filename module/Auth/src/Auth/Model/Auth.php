<?php
namespace Auth\Model;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;

class Auth extends AbstractTableGateway
{

	public $serviceLocator;
	public $id;
	public $company_id;
	public $created_by;
	public $name;
	public $fname;
	public $mname;
	public $lname;
	public $address;
	public $city;
	public $province;
	public $postal_code;
	public $sin;
	public $drivers_license;
	public $dob;
	public $date_start;
	public $date_left;
	public $phone_home;
	public $phone_cell;
	public $sex;
	public $emergency_contact;
	public $emergency_phone;
	public $emergency_relationship;
	public $certified;
	public $starting_wage;
	public $current_wage;
	public $vacation_days;
	public $colour;
	public $type;
	public $access_level;
	public $username;
	public $password;
	public $password_verify;
	public $email;
	public $active;
	public $timestamp;
	
    public function __construct($serviceLocator = null)
    {
    	$this->serviceLocator = $serviceLocator;
    	
        $this->table = 'users';
        
        // Use the default database adapter
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
    
    
    
    /**
	*	Get users by roles
	*	@param
	*	@return
	*/
	public function fetchByRole(){
		$db = $this->getServiceLocator()->get('db');
		$args = func_get_args();
		
		$count = func_num_args();
		
		$sql = "
			SELECT * 
			FROM users
			WHERE company_id = '{$this->company_id}'
			AND (";
			foreach($args as $role){
				$sql .= "access_level = '{$role}' ";
				$count -= 1;
				if($count > 0){
					$sql .= " OR ";
				}
			}
			
		$sql .= ") AND active = 1
			ORDER BY lname, name
		";
		
		$result = $db->query($sql, array());
		
		return $result;
	}

	public function insert($set)
	{
		$set['photo'] = $set['photo']['tmp_name'];
		unset($set['password_verify']);
		unset($set['submit']);
		$set['password'] = md5($set['password']);
		
		return parent::insert($set);
	}
	
		public function exchangeArray($data)
	{
		$this->id = (isset($data['id']))? $data['id'] : null;
		$this->company_id = (isset($data['company_id']))? $data['company_id'] : null;
		$this->created_by = (isset($data['created_by']))? $data['created_by'] : null;
		$this->name = (isset($data['name']))? $data['name'] : null;
		$this->fname = (isset($data['fname']))? $data['fname'] : null;
		$this->mname = (isset($data['mname']))? $data['mname'] : null;
		$this->lname = (isset($data['lname']))? $data['lname'] : null;
		$this->address = (isset($data['address']))? $data['address'] : null;
		$this->city = (isset($data['city']))? $data['city'] : null;
		$this->province = (isset($data['province']))? $data['province'] : null;
		$this->postal_code = (isset($data['postal_code']))? $data['postal_code'] : null;
		$this->sin = (isset($data['sin']))? $data['sin'] : null;
		$this->drivers_license = (isset($data['drivers_license']))? $data['drivers_license'] : null;
		$this->dob = (isset($data['dob']))? $data['dob'] : null;
		$this->date_start = (isset($data['date_start']))? $data['date_start'] : null;
		$this->date_left = (isset($data['date_left']))? $data['date_left'] : null;
		$this->phone_home = (isset($data['phone_home']))? $data['phone_home'] : null;
		$this->phone_cell = (isset($data['phone_cell']))? $data['phone_cell'] : null;
		$this->sex = (isset($data['sex']))? $data['sex'] : null;
		$this->emergency_contact = (isset($data['emergency_contact']))? $data['emergency_contact'] : null;
		$this->certified = (isset($data['certified']))? $data['certified'] : null;
		$this->starting_wage = (isset($data['starting_wage']))? $data['starting_wage'] : null;
		$this->current_wage = (isset($data['current_wage']))? $data['current_wage'] : null;
		$this->vacation_days = (isset($data['vacation_days']))? $data['vacation_days'] : null;
		$this->colour = (isset($data['colour']))? $data['colour'] : null;
		$this->type = (isset($data['type']))? $data['type'] : null;
		$this->access_level = (isset($data['access_level']))? $data['access_level'] : null;
		$this->username = (isset($data['username']))? $data['username'] : null;
		$this->password = (isset($data['password']))? $data['password'] : null;
		$this->password_verify = (isset($data['password_verify']))? $data['password_verify'] : null;
		$this->email = (isset($data['email']))? $data['email'] : null;
		$this->active = (isset($data['active']))? $data['active'] : null;
		$this->timestamp = (isset($data['timestamp']))? $data['timestamp'] : null;
		
	}

}
