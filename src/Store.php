<?php

	class Store
	{
		private $name;
		private $address;
		private $phone; 
		private $id; 


		function __construct($name, $address, $phone, $id = null)
		{
			$this->name = $name;
			$this->address = $address;
			$this->phone = $phone;
			$this->id = $id; 
		}

		// Get and Set methods

		function setName ($new_name)
		{
			$this->name = $new_name;
		}

		function getName ()
		{
			return $this->name;
		}

		function setAddress ($new_address)
		{
			$this->address = $new_address;
		}

		function getAddress ()
		{
			return $this->address;
		}

		function setPhone ($new_phone)
		{
			$this->phone = $new_phone; 
		}

		function getPhone ()
		{
			return $this->phone; 
		}

		function getId ()
		{
			return $this->id; 
		}




		// STATIC methods

		static function deleteAll()
		{
			try {
				$GLOBALS['DB']->exec("DELETE FROM stores;");
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }						
		}





	}
	
?>		