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
			$this->id = (int)$id; 
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


		// DATABASE ALTERING Methods

		function save ()
		{
			// try {
				$GLOBALS['DB']->exec("INSERT INTO stores (name,address,phone) VALUES (
					'{$this->getName()}',
					'{$this->getAddress()}',
					'{$this->getPhone()}'
				);");
				$this->id = $GLOBALS['DB']->lastInsertId(); 
			// }
			// catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }						
		}




		// STATIC Methods

		static function deleteAll()
		{
			try {
				$GLOBALS['DB']->exec("DELETE FROM stores;");
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }						
		}


		static function getAll()
		{
			try {
				$returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores;");
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); } 

			$stores = array();

			foreach($returned_stores as $store) {
				$name = $store['name'];
				$address = $store['address'];
				$phone = $store['phone'];
				$id = $store['id'];

				$new_store = new Store($name,$address,$phone,$id);
				array_push($stores, $new_store);
			}
			return $stores; 
		}





	}
	
?>		