<?php

	/**
	* @backupGlobals disabled
	* @backupStaticAttributes disableed
	*/

	require_once "src/Brand.php";
	// require_once "src/Store.php";

	$server = 'mysql:host=localhost;dbname=shoes_test';
	$username = 'root';
	$password = '';
	$DB = new PDO($server, $username, $password);

	
	class BrandTest extends PHPUnit_Framework_TestCase
	{

		protected function tearDown()
		{
			Brand::deleteAll();
			// Store::deleteAll();
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






	}

?>