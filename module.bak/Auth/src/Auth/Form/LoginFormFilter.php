<?php 
namespace Auth\Form;

use Zend\InputFilter\InputFilter;

class LoginFormFilter extends InputFilter
{
	public function __construct()
	{
		/* Input objects defined here */
		// $this->add(array(
		// 	'name' => 'username',
		// 	'required' => true,
		// 	'filters' => array(
		// 		'name' => 'StringTrim',
		// 	),
		// 	'validators' => array(
		// 		'name' => 'NotEmpty',
		// 	),
		// ));

		// $this->add(array(
		// 	'name' => 'password',
		// 	'required' => true,
		// 	'filters' => array(
		// 		'name' => 'StringTrim',
		// 	),
		// 	'validators' => array(
		// 		'name' => 'NotEmpty',
		// 	),
		// ));
	}
}