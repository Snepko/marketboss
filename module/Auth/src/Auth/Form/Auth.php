<?php
namespace Auth\Form;

use Zend\Form\Form as Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factor as InputFactor;
use Zend\Session\Container; 

class Auth extends Form
{

	public $company_id;
    public $auth;
    
	public function __construct($name = 'auth')
    {
        parent::__construct($name);
        
        $this->auth = new Container('auth');
        $this->company_id = $this->auth->company_id;
        
        // Company_id 
        $this->add(array(
        	'name' => 'company_id',
        	'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
            	'value' => $this->auth->company_id,
            ),
        ));
       
       // Created by
        $this->add(array(
        	'name' => 'created_by',
        	'type' => 'Zend\Form\Element\Hidden',
            'attributes' => array(
            	'value' => $this->auth->id,
            ),
        ));
        
        // Add the email input box
        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'type' => 'Email', 
            ),
        ));
        
        // Password box
        $this->add(array(
            'name' => 'password', 
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'required' => 'required', 
                'placeholder' => 'Password here...'
            ),
            'options' => array(
                'label' => 'Password',
            ),
        ));
        
        // Password verify
        $this->add(array(
            'name' => 'password_verify',
            'type' => 'Zend\Form\Element\Password',
            'attributes' => array(
                'placeholder' => 'Verify Password here...', 
                'required' => 'required',
            ),
        ));
        
        
        // Name text box
        $this->add(array(
           'name' => 'name',
           'type' => 'Zend\Form\Element\Text',
            'attributes' => array(
                'placeholder' => 'Type name...',
                'required' => 'required', 
            ),
            'options' => array(
                'label' => 'Name'
            ),
        ));
        
        // First name
        $this->add(array(
        	'name' => 'fname',
        	'type' => 'Zend\Form\Element\Text',
        	'attributes' => array(
        		'placeholder' => 'First Name',
        		'required' => 'required',
        	),
        	'options' => array(
        		'label' => 'First Name',
        	),
        ));
        
        // Middel Name
        $this->add(array(
        	'name' => 'mname',
        	'type' => 'Zend\Form\Element\Text',
        	'attributes' => array(
        		'placeholder' => 'Middle Name',
        		'required' => false,
        	),
        	'options' => array(
        		'label' => 'Middle Name',
        	),
        ));
        
        // Last name
        $this->add(array(
        	'name' => 'lname',
        	'type' => 'Zend\Form\Element\Text',
        	'attributes' => array(
				'placeholder' => 'Last Name',
				'required' => false,
        	),
        	'options' => array(
        		'label' => 'Last Name',
        	),
        ));
        
        // Address
        $this->add(array(
        	'name' => 'address',
        	'type' => 'Zend\Form\Element\Text',
        	'attributes' => array(
        		'placeholder' => 'Address',
        		'required' => false
        	),
        	'options' => array(
        		'label' => 'Address',
        	),
        ));
        
        // City
        $this->add(array(
        	'name' => 'city',
        	'type' => 'Zend\Form\Element\Text',
        	'attributes' => array(
        		'placeholder' => 'City',
        		'required' => false,
        	),
        	'options' => array(
        		'label' => 'City',
        	),
        ));
        
        // Province
        $this->add(array(
        	'name' => 'province',
        	'type' => 'Zend\Form\Element\Select',
        	'attributes' => array(
        	
        	),
        	'options' => array(
        		'value_options' => array(
        			'ON' => 'Ontario',
        			'QB' => 'Quebec',
        		),  
        		'label' => 'Province',  
        	),
        ));
        
        // Postal Code
        $this->add(array(
        	'name' => 'postal_code',
        	'type' => 'Zend\Form\Element\Text',
        	'attributes' => array(
        		'placeholder' => 'Postal Code',
        		'required' => false,
        	),
        	'options' => array(
        		'label' => 'Postal Code',
        	),
        ));
        
        // Phone Number box
        $this->add(array(
            'name' => 'phone', 
            'options' => array(
                'label' => 'Phone number'
            ),
            'attributes' => array(
                'type' => 'tel',
                'required' => 'required', 
                'pattern' => '^[\d-/]+$'
            ),
        ));
        
        // File
        $this->add(array(
            'type' => 'Zend\Form\Element\File',
            'name' => 'photo',
            'options' => array(
                'label' => 'Your photo'
            ),
            'attributes' => array(
                'required' => false, 
                'id' => 'photo'
            ),
        ));
        
        /*
         *	Details 
         */
        $this->add(array(
        	'name' => 'sin',
        	'type' => 'Zend\Form\Element\Text',
        	'options' => array(
        		'label' => 'Social Insurance Number',
        	),
        	'attributes' => array(
        		'required' => false,
        	),
        ));
        
        $this->add(array(
        	'name' => 'drivers_license',
        	'type' => 'Zend\Form\Element\Text',
        	'attributes' => array(
        		'placeholder' => 'Drivers License',
        	),
        	'options' => array(
        		'label' => 'Drivers License',
        	),
        ));
        
        $this->add(array(
        	'name' => 'dob',
        	'type' => 'Zend\Form\Element\Text',
        	'attributes' => array(
        		'required' => false,
        	),
        	'options' => array(
        		'label' => 'Date of Birth',
        	),
        ));
        
        
        
        // Special code that protects our form from being submitted from automated scripts
        $this->add(array(
            'name' => 'csrf', 
            'type' => 'Zend\Form\Element\Csrf',
        ));
        
        // Submit button
        $this->add(array(
            'name' => 'submit', 
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Submit',
                'required' => 'false'
            ),
        ));
    }
    
}