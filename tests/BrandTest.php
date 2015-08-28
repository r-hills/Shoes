<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disableed
	*/

	require_once "src/Brand.php";
	require_once "src/Store.php";

	$server = 'mysql:host=localhost;dbname=shoes_test';
	$username = 'root';
	$password = '';
	$DB = new PDO($server, $username, $password);

	
	class BrandTest extends PHPUnit_Framework_TestCase
	{

		protected function tearDown()
		{
			Brand::deleteAll();
			Store::deleteAll();
		}

		function test_getName()
		{
			//Arrange
			$name = "Nike";
			$test_brand = new Brand($name);

			//Act
			$result = $test_brand->getName();

			//Assert
			$this->assertEquals($name, $result); 

		}

		function test_save()
		{
			//Arrange
			$name = "Nike";
			$test_brand = new Brand($name);

			//Act
			$test_brand->save(); 

			//Assert
			$result = Brand::getAll(); 
			$this->assertEquals($test_brand, $result[0]);

		}

		function test_getAll()
		{
			//Arrange
			$name = "Nike";
			$test_brand = new Brand($name);
			$test_brand->save(); 

			$name2 = "Adidas";
			$test_brand2 = new Brand($name2);
			$test_brand2->save(); 

			//Act
			$result = Brand::getAll(); 			

			//Assert
			$this->assertEquals([$test_brand,$test_brand2], $result);

		}

		function test_deleteAll()
		{
			//Arrange
			$name = "Nike";
			$test_brand = new Brand($name);
			$test_brand->save(); 

			$name2 = "Adidas";
			$test_brand2 = new Brand($name2);
			$test_brand2->save(); 

			//Act
			Brand::deleteAll(); 
			$result = Brand::getAll(); 

			//Assert
			$this->assertEquals([], $result);
			
		}

		function test_delete()
		{
			//Arrange
			$name = "Nike";
			$test_brand = new Brand($name);
			$test_brand->save(); 

			$name2 = "Adidas";
			$test_brand2 = new Brand($name2);
			$test_brand2->save(); 

			//Act
			$test_brand->delete(); 
			$result = Brand::getAll(); 

			//Assert
			$this->assertEquals([$test_brand2], $result);
			
		}

		function test_find()
		{
			//Arrange
			$name = "Nike";
			$test_brand = new Brand($name);
			$test_brand->save(); 

			$name2 = "Adidas";
			$test_brand2 = new Brand($name2);
			$test_brand2->save(); 

			//Act
			$test_brand->delete(); 
			$result = Brand::find($test_brand2->getId()); 

			//Assert
			$this->assertEquals($test_brand2, $result);
			
		}										

		function test_addStore()
		{
			//Arrange
			$name = "House of Shoes and Waffles";
			$address = "123 Street";
			$phone = "4-44";
			$test_store = new Store($name, $address, $phone);
			$test_store->save(); 

			$test_brand = new Brand("Nike");
			$test_brand->save();
	
			//Act
			$test_brand->addStore($test_store);			
		
			//Assert
			$result = $test_brand->getStores();
			$this->assertEquals([$test_store], $result); 

		}

		function test_getStores()
		{
			//Arrange
			$test_brand = new Brand("Nike");
			$test_brand->save();

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
			$test_brand->addStore($test_store);
			$test_brand->addStore($test_store2);			
		
			//Assert
			$result = $test_brand->getStores();
			$this->assertEquals([$test_store,$test_store2], $result); 

		}



	}

?>