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





		// STATIC methods

		static function deleteAll()
		{
			try {
				$GLOBALS['DB']->exec("DELETE FROM brands;");
			}
			catch (PDOException $e) { echo "ERROR >>> ". $e->getMessage(); }						
		}


	}
?>