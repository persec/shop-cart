<?php
	session_start();
	include("config.php");
	include('control/get_productid_from_name.php'); 
	include('model/product.php');
	include('model/cart.php');
	include('model/user.php');
	
	if(isset($_SESSION['username']) && isset($_SESSION['userid']) ){

		$user = new User($conn, $_SESSION['userid']);
		if(isset($_POST['remove'])){
			echo "haha". $_POST['remove'];
			$user->rmFromCart($_POST['remove']);
		}

		$product_array = $user->getProductsInCart();

	}
	else{
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Your Cart</title>
</head>
<body>
<h3><?php echo "Nguoi dung: ". $user->getUsername(); ?></h3>

<h3><?php echo "Dia chi : ". $user->getAddress(); ?></h3>
<h3><?php echo "So dien thoai: " . $user->getPhone();?></h3>
<div align="center">

	<form action="checkcart.php" method="post">	

	<table border="1" width="70%" >
		<?php
		// for p in products:
		// 	show products in each cell of table
			$count = count($product_array);
			for($i = 0; $i < $count; $i+=3){
			//echo $product_array[$i]->getName();
			//echo "<br>";
					
				$tmp_name1 = $product_array[$i]->getName();
				$tmp_price1 = $product_array[$i]->getPrice();
				$tmp_img1 = $product_array[$i]->getImage_link();
				$tmp_id1 = $product_array[$i]->getProduct_id();
				$html = "";
				$html .="<tr>";
				$html .="	<td align='center'>";
				$html .="		<img src='$tmp_img1' alt='$tmp_name1' width='250px' height='200px'> <br>";
				$html .="		<p>$tmp_name1 - $tmp_price1</p>";
				$html .="  <button type='submit' value='$tmp_id1' name='remove'> Remove from Cart </button>";
				$html .="	</td>";
						
				if($i + 1 < $count){
					$tmp_img2 = $product_array[$i+1]->getImage_link();
					$tmp_name2 = $product_array[$i+1]->getName();
					$tmp_price2 = $product_array[$i+1]->getPrice();
					$tmp_id2 = $product_array[$i+1]->getProduct_id();
					$html .="	<td align='center'>";
					$html .="		<img src='$tmp_img2' alt='$tmp_name2' width='250px' height='200px'><br>";
					$html .="		<p>$tmp_name2 - $tmp_price2</p>";
					$html .="  <button type='submit' value='$tmp_id2' name='remove'> Remove from Cart</button>";
					$html .="	</td>";
				}
				if($i + 2 < $count){
					$tmp_img3 = $product_array[$i+2]->getImage_link();
					$tmp_name3 = $product_array[$i+2]->getName();
					$tmp_price3 = $product_array[$i+2]->getPrice();
					$tmp_id3 = $product_array[$i+2]->getProduct_id();
					$html .="	<td align='center'>";
					$html .="		<img src='$tmp_img3' alt='$tmp_name3' width='250px' height='200px'><br>";
					$html .="		<p>$tmp_name3 - $tmp_price3</p>";
					$html .="  <button type='submit' value='$tmp_id3' name='remove'> Remove from Cart</button>";
					$html .="	</td>";
						
				}
				$html .="</tr>";

				echo $html;
					
			}
		?>
		<tr align="center">
			<td colspan="2">
			<button type='submit' style="width:200px; height:40px; font-size:20px" name='confirm' value='1'> Xac nhan </button>
			</td>
		</tr>
	</table>

	</form>
</div>
</body>
</html>