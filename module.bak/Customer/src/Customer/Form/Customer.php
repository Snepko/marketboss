<?php
namespace Customer\Form;

use Customer\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\InputFilter\Factory as InputFactory;

class Customer extends \Zend\Form\Form
{
    
    public function __construct($name = 'customer')
    {
        parent::__construct($name);
        
        $this->add(array(
            'name' => 'company_name',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
              'label' => 'Company name',  
            ),
            'attributes' => array(
                
            ),
        ));
        $this->add(array(
            'name' => 'fname',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'First name',
            ),
            'attributes' => array(
              'required' => 'required',
            ),
            
        ));
        
        $this->add(array(
            'name' => 'lname',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Last Name'
            ),
            'attributes' => array(
                'required' => 'required',
            ),
        ));
        
        $this->add(array(
            'name' =>'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Submit',
            ),
        ));
    }
}