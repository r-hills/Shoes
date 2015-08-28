<?php
	
	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once "src/Store.php";
	// require_once "src/Brand.php";

	$server = 'mysql:host-localhost;dbname=shoes';
	$username = 'root';
	$password = '';
	$DB = new PDO ($server, $username, $password);

	class StoreTest extends PHPUnit_Framework_TestCase
	{

		protected function tearDown()
		{
			Store::deleteAll();
			// Brand::deleteAll(); 
		}

		function test_getName()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4";
			$test_store = new Store($name, $address, $phone);

			//Act
			$result = $test_store->getName();

			//Assert
			$this->assertEquals($name, $result); 

		}







	}
	
?>		