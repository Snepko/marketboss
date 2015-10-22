<?php
namespace User\Form;

//use User\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;
use Zend\Form\Form;

class User extends Form
{
    public function __construct($name = 'user')
    {
        parent::__construct($name);
        
        $this->setAttribute('method', 'post');
        
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

        // Add the email element
        $this->add(array(
            'name' => 'email',
            'type' => 'Zend\Form\Element\Email',
            'options' => array(
                'label' => 'Email:',
            ),
            'attributes' => array(
                'type' => 'email',
                'required' => true,
                'placeholder' => 'Email Address...',
            ),
            
        ));
        
        // Add the phone input box
        $this->add(array(
            'name' => 'phone',
            'options' => array(
                'label' => 'Phone Number',
            ),
            'attributes' => array(
                'type' => 'tel', 
                'required' => 'required', 
                'pattern' => '^[\d-/]+$'
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
        
        
               
        // File
        $this->add(array(
            'type' => 'Zend\Form\Element\File',
            'name' => 'photo',
            'options' => array(
                'label' => 'Your photo'
            ),
            'attributes' => array(
                'required' => 'required', 
                'id' => 'photo'
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
    
    
    
	/*
public function getInputFilter()
	{
		if(! $this->filter){
			$inputFilter = new InputFilter();
			$factory = new InputFactory();
			
			$inputFilter->add($factory->createInput(
					['name' => 'email',
						'filters' => [
							['name' => 'StripTags'],
							['name' => 'StringTrim'],
						],
						'validators' => [
							[
							'name' => 'EmailAddress',
								'options' => 
								['messages' => 
									['emailAddressInvalidFormat' => 'Email address format is invalid.'],
								],
							],
							[
							'name' => 'NotEmpty', 
								'options' => [
									'messages' => ['isEmpty' => 'Email address is required.'],
								],
							],
						],
					]
				));


				// Email field
				$inputFilter->add($factory->createInput(
					['name' => 'name',
						'filters' => [
							['name' => 'StripTags'],
							['name' => 'StringTrim'],
						],
						'validators' => [
							[
							'name' => 'NotEmpty',
								'options' => 
								['messages' => ['isEmpty' => 'Name is required.']],
							],
						]
					]
				));
				
				
			// Password field
			$inputFilter->add($factory->createInput(
				[
					'name' => 'password',
					'filters' => [
						['name' => 'StripTags'], 
						['name' => 'StringTrim']
					],
					'validators' => [
						[
							'name' => 'NotEmpty',
							'options' => ['messages'	=> ['isEmpty' => 'Password is required']]
						]
					],
				]
			));
			
			// Password verify field
			$inputFilter->add($factory->createInput(
				[
					'name' => 'password_verify',
					'filters' => [
						['name' => 'StripTags'], 
						['name' => 'StringTrim']
					],
					'validators' => [
						[
							'name' => 'NotEmpty',
							'options' => ['messages'	=> ['isEmpty' => 'Password Verify is required']]
						]
					],
				]
			));
			
			// Files size and validation
			$inputFilter->add($factory->createInput(
				[
					'name' => 'photo',
					'validators' => [
						[
							'name' => 'filesize',
							'options' => ['max'	=> 2097152]
						],
						
						[
							'name' => 'filemimetype',
							'options' => ['mimeType' =>	'image/png, image/x-png, image/jpg, image/jpeg, image/gif']
						],
						
						[
							'name' => 'fileimagesize',
							'options' => [
								'maxWidth' => 200,
								'maxHeight' => 200,
							]
						]
					],
					
					'filters' => [
						[
							'name' => 'filerenameupload',
							'options' => [
								'target' => 'data/image/photos/',
								'randomize' => true,
							],
						],
					],
				]
			));

		}
	}
	
	public function setInputFilter(InputFilterInterface $inputFilter)
	{
		throw new \Exception('It is not allowed to set the input filter');
	}
*/
}