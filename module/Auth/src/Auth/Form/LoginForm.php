<?php

namespace Auth\Form;

use Zend\Form\Form as Form;
use Zend\Form\Element;


class LoginForm extends Form
{
	public function __construct($name = "Login")
	{
		parent::__construct($name);

		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'form-signin');
		$this->setAttribute('id', null);
		
		$this->add(array(
			'name' => 'username',
			'type' => 'Zend\Form\Element\Text',
			'attributes' => array(
				'required' => 'required',
				'placeholder' => 'username',
				'class' => 'form-control',
			),
			// 'options' => array(
			// 	'label' => 'Username:',
			// ),
		));

		$this->add(array(
			'name' => 'password',
			'type' => 'Zend\Form\Element\Password',
			'attributes' => array(
				'required' => 'required',
				'placeholder' => 'password',
				'class' => 'form-control',
			),
			// 'options' => array(
			// 	'label' => 'Password:',
			// ),
		));

		$this->add(array(
			'name' => 'submit',
			'type' => 'Zend\Form\Element\Submit',
			'attributes' => array(
				'value' => 'Login',
				'class' => 'btn btn-lg btn-primary btn-block',
			),
		));
	}
}