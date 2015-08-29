<?php

	class Brand
	{
		private $name;
		private $id; 


		function __construct($name, $id = null)
		{
			$this->name = $name; 
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

		function getId()
		{
			return $this->id; 
		}


		// Basic Database altering methods

		function save()
		{
			try {
				$GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');"); 
				$this->id = $GLOBALS['DB']->lastInsertId(); 
			} 
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }
		}	

		function updateName ($new_name) {
			$GLOBALS['DB']->exec("UPDATE brands SET name = '{$new_name}' WHERE id = {$this->getId()};");
			$this->setName($new_name); 
		}			


		function delete()
		{
			try {
				$GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
				$GLOBALS['DB']->exec("DELETE FROM partnerships WHERE id = {$this->getId()};");
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }			
		}


		// DATABASE ALTERING Methods involving other tables

		function addStore ($new_store)
		{
			$GLOBALS['DB']->exec("INSERT INTO partnerships (brand_id,store_id) VALUES (
				{$this->getId()},
				{$new_store->getId()}
			);");
		}


		function getStores () 
		{
			$stores_query = $GLOBALS['DB']->query(
				"SELECT stores.* FROM
					brands JOIN partnerships ON (brands.id = partnerships.brand_id)
						   JOIN stores       ON (partnerships.store_id = stores.id)
				 WHERE brands.id = {$this->getId()};"
			);

			$matching_stores = array();

			foreach($stores_query as $store) {
				$name = $store['name'];
				$address = $store['address'];
				$phone = $store['phone'];
				$id = $store['id'];
				$new_store = new Store($name,$address,$phone,$id);
				array_push($matching_stores, $new_store);
			}
			return $matching_stores; 
		}


		// STATIC methods

		static function deleteAll()
		{
			try {
				$GLOBALS['DB']->exec("DELETE FROM brands;");
				$GLOBALS['DB']->exec("DELETE FROM partnerships");
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }						
		}


		static function getAll()
		{
			try {
				$returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands;");		
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); } 

			$brands = array();
			foreach ($returned_brands as $brand) {
				$name = $brand['name'];
				$id = $brand['id'];
				$new_brand = new Brand($name, $id);
				array_push($brands, $new_brand);
			}
			return $brands;	
		}


		static function find($search_id)
		{
			$found_brand = null; 
			$brands = Brand::getAll();
			foreach($brands as $brand) {
				if($brand->getId() == $search_id) {
					$found_brand = $brand;
				}
			}
			return $found_brand; 
		}


	}
?>