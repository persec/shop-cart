<?php
	
	/**
	* 
	*/
	class Product
	{

		// database connection and table name
		private $conn;
		private $table_name;

		private $product_id;
		private $name;
		private $price;
		private $time;
		private $image_link;
		private $state;
		

		function __construct($db, $id)
		{
			# code...
			$this->conn = $db;
			$this->table_name  = "shop_products";
			$sql = "SELECT * FROM $this->table_name WHERE product_id='$id' ";
			//echo $sql;
			$retval = mysqli_query($db, $sql);
			if(!$retval){
				die("Error on product->construct, " . mysqli_error($db));
			}
			$row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
			$this->product_id = $row['product_id'];
			$this->name = $row['name'];
			$this->price = $row['price'];
			$this->time = $row['time'];
			$this->image_link = $row['image_link'];
			$this->state = $row['state'];
		}
		

		function addToCart($product_name){
			$this->cart->add($product_name);
		}

		function rmFromCart($product_name){
			$this->cart->rm($product);
		}

		function confirm(){
			echo "$name confirm $cart->products";
		}


		function setProduct_id($id){
			$this->product_id = $id;
		}
		function setName($name){
			$this->name = $name;
		}
		function setPrice($price){
			$this->price = $price;
		}
		function setTime($time){
			$this->time = $time;
		}
		function setState($state){
			$this->state = $state;
		}

		function getProduct_id(){
			return $this->product_id;
		}
		function getName(){
			return $this->name;
		}
		function getPrice(){
			return $this->price;
		}
		function getTime(){
			return $this->time;
		}
		function getImage_link(){
			return $this->image_link;
		}
		function getState(){
			return $this->state;
		}

	}
?>