<?php
	
	/**
	* 
	*/

	class Product_Image
	{
		
		private $conn;
		private $table_name = "shop_products";

		private $name;
		private $price;
		private $image_link;
		function __construct()
		{
			# code...
			//$this->conn = $db;
		}
		function setName($name){
			$this->name = $name;
		}
		function setPrice($price){
			$this->price = $price;
		}
		function setImage_link($image_link){
			$this->image_link = $image_link;
		}
		function getName(){
			return $this->name;
		}
		function getImage_link(){
			return $this->image_link;
		}
		function getPrice(){
			return $this->price;
		}
	}
?>