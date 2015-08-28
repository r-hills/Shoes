<?php

	class Brand
	{
		private $name;
		private $id; 


		function __construct($name, $id = null)
		{
			$this->name = $name; 
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

		function getId()
		{
			return $this->id; 
		}


		// DATABASE methods

		function save()
		{
			try {
				$GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');"); 
				$this->id = $GLOBALS['DB']->lastInsertId(); 
			} 
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }
		}		


		function delete()
		{
			try {
				$GLOBALS['DB']->exec("DELETE FROM brands WHERE id = {$this->getId()};");
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }			
		}



		// STATIC methods

		static function deleteAll()
		{
			try {
				$GLOBALS['DB']->exec("DELETE FROM brands;");
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




	}
?>