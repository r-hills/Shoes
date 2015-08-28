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


	}
	
?>		