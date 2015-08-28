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


		// BASIC DB ALTERING Methods

		function save ()
		{
			try {
				$GLOBALS['DB']->exec("INSERT INTO stores (name,address,phone) VALUES (
					'{$this->getName()}',
					'{$this->getAddress()}',
					'{$this->getPhone()}'
				);");
				$this->id = $GLOBALS['DB']->lastInsertId(); 
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }						
		}


		function delete()
		{
			try {
				$GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }			
		}


		function updateName ($new_name) {
			$GLOBALS['DB']->exec("UPDATE stores SET name = '{$new_name}' WHERE id = {$this->getId()};");
			$this->setName($new_name); 
		}


		function updateAddress ($new_address) {
			$GLOBALS['DB']->exec("UPDATE stores SET address = '{$new_address}' WHERE id = {$this->getId()};");
			$this->setAddress($new_address); 
		}


		function updatePhone ($new_phone) {
			$GLOBALS['DB']->exec("UPDATE stores SET phone = '{$new_phone}' WHERE id = {$this->getId()};");
			$this->setPhone($new_phone); 
		}


		// Methods involving other tables

		function addBrand ($new_brand)
		{
			$GLOBALS['DB']->exec("INSERT INTO partnerships (brand_id,store_id) VALUES (
				{$new_brand->getId()},
				{$this->getId()}
			);");
		}


		function getBrands ()
		{
			$brands_query = $GLOBALS['DB']->query(
				"SELECT brands.* FROM
					stores JOIN partnerships ON (stores.id = partnerships.store_id)
					       JOIN brands       ON (partnerships.brand_id = brands.id)
				 WHERE stores.id = {$this->getId()};	       
				"
			); 

			$matching_brands = array(); 

			foreach($brands_query as $brand) {
				$name = $brand['name'];
				$id = $brand['id'];
				$new_brand = new Brand($name, $id);
				array_push($matching_brands, $new_brand);
			}
			return $matching_brands; 
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


		static function find($search_id)
		{
			$found_store = null; 
			$stores = Store::getAll();
			foreach($stores as $store) {
				if($store->getId() == $search_id) {
					$found_store = $store;
				}
			}
			return $found_store; 
		}



	}
	
?>		