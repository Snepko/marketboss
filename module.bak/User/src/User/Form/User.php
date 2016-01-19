<?php
namespace User\Form;

use User\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factor as InputFactor;

class User extends \Zend\Form\Form
{
    public function __construct($name = 'user')
    {
        parent::__construct($name);
        
        
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
}