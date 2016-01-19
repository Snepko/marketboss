<?php 
namespace Customer\Model;

class TestClass 
{
	public function __construct()
	{
		echo "<p><strong>This is the test class constructor</strong></p>";
	}
	
	public function customerEvent()
	{
		echo "<p><strong>This is the test method in the test class constructor</strong></p>";
	}
	
}