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
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);

			//Act
			$result = $test_store->getName();

			//Assert
			$this->assertEquals($name, $result); 

		}

		function test_save()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);

			//Act
			$test_store->save(); 

			//Assert
			$result = Store::getAll(); 
			$this->assertEquals($test_store, $result[0]);

		}





	}
	
?>		