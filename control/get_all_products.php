<?php
	//include("/var/www/html/toyshop/config.php");
	include("model/product_image.php");
	
	function get_all_products(){
		$sql = "SELECT * FROM shop_products WHERE state='available' ";
		global $conn;
		$retval = mysqli_query($conn, $sql);
		if(!$retval){
			//die('could not get data: ' . mysqli_error($conn));
			printf("could not get data: %s\n", mysqli_error($conn));
			exit;
		}
		$c = mysqli_num_rows($retval);
		$product_array = array();
		
		for($i = 0; $i < $c; $i++){
			$row = mysqli_fetch_array($retval,MYSQLI_ASSOC);
			$product = new Product($conn, $row['product_id']);
			array_push($product_array, $product);
		}
		return $product_array;
	}
?>