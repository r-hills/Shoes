<?php
	
	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disabled
	*/

	require_once "src/Store.php";
	// require_once "src/Brand.php";

	$server = 'mysql:host=localhost;dbname=shoes_test';
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

		function test_getPhone()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);

			//Act
			$result = $test_store->getPhone();

			//Assert
			$this->assertEquals($phone, $result); 

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

		function test_getAll()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);
			$test_store->save(); 

			$name2 = "Bob's Shoe Palace";
			$address2 = "456 Main Street";
			$phone2 = "1-800-NEW-SHOE";
			$test_store2 = new Store($name, $address, $phone);
			$test_store2->save(); 

			//Act
			$result = Store::getAll(); 

			//Assert
			$this->assertEquals([$test_store,$test_store2], $result);

		}

		function test_deleteAll()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);
			$test_store->save(); 

			$name2 = "Bob's Shoe Palace";
			$address2 = "456 Main Street";
			$phone2 = "1-800-NEW-SHOE";
			$test_store2 = new Store($name, $address, $phone);
			$test_store2->save(); 

			//Act
			Store::deleteAll();
			$result = Store::getAll(); 

			//Assert
			$this->assertEquals([], $result);

		}

		function test_delete()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);
			$test_store->save(); 

			$name2 = "Bob's Shoe Palace";
			$address2 = "456 Main Street";
			$phone2 = "1-800-NEW-SHOE";
			$test_store2 = new Store($name, $address, $phone);
			$test_store2->save(); 

			//Act
			$test_store->delete();
			$result = Store::getAll(); 

			//Assert
			$this->assertEquals([$test_store2], $result);

		}

		function test_find()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);
			$test_store->save(); 

			$name2 = "Bob's Shoe Palace";
			$address2 = "456 Main Street";
			$phone2 = "1-800-NEW-SHOE";
			$test_store2 = new Store($name, $address, $phone);
			$test_store2->save(); 

			//Act
			$result = Store::find($test_store2->getId()); 

			//Assert
			$this->assertEquals($test_store2, $result);

		}

		function test_updateName()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);
			$test_store->save(); 

			// Act
			$new_name = "Bob's Shoe Palace";
			$test_store->updateName($new_name);

			//Assert
			$this->assertEquals($new_name, $test_store->getName());

		}		

		function test_updateAddress()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);
			$test_store->save(); 

			// Act
			$new_address = "456 Main Street";
			$test_store->updateAddress($new_address);

			//Assert
			$this->assertEquals($new_address, $test_store->getAddress());

		}	

	}
	
?>		