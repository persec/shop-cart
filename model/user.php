<?php
	/**
	* 
	*/
	class User
	{
		
		// database connection and table name
		private $conn;
		private $table_name = "shop_users";

		private $userID;
		private $username;
		private $password;
		private $address;
		private $phone;
		private $cart;

		function __construct($db, $id)
		{
			# code...
			$this->conn = $db;
			$sql = "SELECT * FROM $this->table_name WHERE user_id=$id";
			$retval = mysqli_query($this->conn, $sql);
			if(!$retval){
				echo "user cannot connect db, " . mysqli_error($this->conn);
			}

			$row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
			$this->userID = $row['user_id'];
			$this->username = $row['name'];
			$this->password = $row['password'];
			$this->address = $row['address'];
			$this->phone = $row['number'];
			$this->cart = new Cart($this->conn, $this->userID);

		}

		function addToCart($product_name){
			$this->cart->add($product_name);
		}
		function rmFromCart($product_id){

			$this->cart->rm($product_id);
		}

		function confirm(){
			// send email;
			$to = "gekko@localhost";
			$subject = "Confirm from $this->username";


			$msg =  "$this->username xac nhan cac mat hang \n";
			$product_array = $this->getProductsInCart();
			$count = count($product_array);
			for($i = 0; $i < $count; $i++){
				$msg .= " - ". $product_array[$i]->getName() . "\n";
			}
			
			//$header = "From:$this->username";
			$retval = mail($to, $subject, $msg);
			if($retval){
				echo "Message sent successfully ...";
			}
			else{
				echo "Message could not be sent ...";
			}
		}




		function getUserID(){
			return $this->userID;
		}
		function getUsername(){
			return $this->username;
		}
		function getPassword(){
			return $this->password;
		}
		function getAddress(){
			return $this->address;
		}
		function getPhone(){
			return $this->phone;
		}
		function getProductsInCart(){

			return $this->cart->get_products();
		}
	}
?>