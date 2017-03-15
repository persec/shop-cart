<?php
	
	/**
	* 
	*/
	class Cart
	{
		
		//private $products = array();
		private $conn;
		private $table_name = 'shop_carts';
		private $owner;
		function __construct($db, $user_id)
		{
			# code...
			$this->conn = $db;
			$this->owner = $user_id;
			$this->products = array();
			$sql = "SELECT * FROM $this->table_name WHERE user_id='$this->owner' ";
			if(!($retval = mysqli_query($this->conn, $sql) )){
				die("Error in cart->construct,". mysqli_error($this->conn));
			}
			$row = mysqli_fetch_array($retval, MYSQLI_ASSOC);

		}

		// insert product into cart
		function add($product_name){
			/*	##############################
				Need to chage state of product
			*/
			$product_id = get_productid_from_name($product_name);
			$sql = "INSERT INTO $this->table_name VALUES ($this->owner, $product_id)";
			if(!mysqli_query($this->conn, $sql)){

				die($sql."Error in Cart->add, ".mysqli_error($this->conn));
			}

		}

		// delete product from cart
		function rm($product_id){
			/*	##############################
				Need to chage state of product
			*/

			$sql = "DELETE FROM $this->table_name WHERE user_id='$this->owner' and product_id='$product_id'";
			if(!mysqli_query($this->conn, $sql)){
				die("Error in Cart->rm, ".mysqli_error($this->conn));
			}

		}

		function get_products(){
			$sql = "SELECT product_id FROM $this->table_name WHERE user_id='$this->owner'";
			$retval = mysqli_query($this->conn, $sql);
			if(!$retval){
				die("Error in Cart->show_products, ". mysqli_error($this->conn));
			}
			$product_array = array();
			$count = 0;
			while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC)){
				$product = new Product($this->conn, $row['product_id']);
				array_push($product_array, $product);
			}

			return $product_array;
		}


	}
?>