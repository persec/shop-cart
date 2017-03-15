<?php
	// function is included in index
	// $conn is specified
	function get_productid_from_name($product_name){
		$sql = "SELECT product_id FROM shop_products WHERE name='$product_name' and state='available'";
		global $conn;
		$retval = mysqli_query($conn, $sql);
		if(!$retval){
			echo "error in get_productid_from_name, " . mysqli_error($conn);
		}
		$row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
		$count = mysqli_num_rows($retval);
		
		return $row['product_id'];
	}
?>