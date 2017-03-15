
<?php
	session_start();

	include('config.php');
	// phai dung thu tu product, cart, user
	// get_productid_from_name dung trong cart.php
	include('control/get_productid_from_name.php'); 
	include('model/product.php');
	include('model/cart.php');
	include('model/user.php');
	
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!empty($_POST['addtocart'])){
			if(isset($_SESSION['username']) && isset($_SESSION['userid'])){
				$product_name = $_POST['addtocart'];
				$user = new User($conn, $_SESSION['userid']);
				$user->addToCart($product_name);
			}
			else{
				echo "Ban can phai dang nhap truoc!";
			}
		}
		if(isset($_POST['confirm'])){
			if( intval($_POST['confirm']) == 1){
				$user->confirm();
				$notify = "Xac nhan thanh cong";
			}
			else{
				$notify = "Xac nhan that bai";
			}
		}
	}
	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Kid's World</title>
</head>
<body>
	<header style="background:#efefef" >
		<table>
			<tr>
				<td>
					<?php 
						if(isset($_SESSION['username'])){
							$usr = $_SESSION['username'];
							echo "<p>Hello $usr </p>";
							echo "<br><a href='signout.php'>Dang xuat </a> ";
							echo "<br><a href='checkcart.php'>Xem gio hang</a>";

						}
						else{
							echo "<a href='login.php'>Dang nhap</a> ";	
						}

					?>
						
				</td>
				<td>
					<form>
						<input type="text" name="search">
						<input type="button" value="Timkiem">
					</form>
				</td>

			</tr>
		</table>
	</header>
	<form action="index.php" method="post">
		
	
	<table width="100%" >
		<?php
			// for p in products:
			// 	show products in each cell of table
			include("control/get_all_products.php");
			$product_array = get_all_products();
			$count = count($product_array);

			for($i = 0; $i < $count; $i+=3){
				//echo $product_array[$i]->getName();
				//echo "<br>";
				
				$tmp_name1 = $product_array[$i]->getName();
				$tmp_price1 = $product_array[$i]->getPrice();
				$tmp_img1 = $product_array[$i]->getImage_link();

				$html = "";
				$html .="<tr>";
				$html .="	<td align='center'>";
				$html .="		<img src='$tmp_img1' alt='$tmp_name1' width='250px' height='200px'> <br>";
				$html .="		<p>$tmp_name1 - $tmp_price1</p>";
				$html .="  <button type='submit' value='$tmp_name1' name='addtocart'> Add to Cart</button>";
				$html .="	</td>";
				
				if($i + 1 < $count){
					$tmp_img2 = $product_array[$i+1]->getImage_link();
					$tmp_name2 = $product_array[$i+1]->getName();
					$tmp_price2 = $product_array[$i+1]->getPrice();
					$html .="	<td align='center'>";
					$html .="		<img src='$tmp_img2' alt='$tmp_name2' width='250px' height='200px'><br>";
					$html .="		<p>$tmp_name2 - $tmp_price1</p>";
					$html .="  <button type='submit' value='$tmp_name2' name='addtocart'> Add to Cart</button>";
					$html .="	</td>";
				}
				if($i + 2 < $count){

					$tmp_img3 = $product_array[$i+2]->getImage_link();
					$tmp_name3 = $product_array[$i+2]->getName();
					$tmp_price = $product_array[$i+2]->getPrice();
					$html .="	<td align='center'>";
					$html .="		<img src='$tmp_img3' alt='$tmp_name3' width='250px' height='200px'><br>";
					$html .="		<p>$tmp_name3 - $tmp_price1</p>";
					$html .="  <button type='submit' value='$tmp_name3' name='addtocart'> Add to Cart</button>";
					$html .="	</td>";
					
				}
				$html .="</tr>";
				echo $html;
				
			}

		?>
	</table>
	
	</form>

	<footer style="background:#efefef; margin-bottom:0">
		<h3>Dia chi		: 		</h3>
		<h3>Email 		: 		</h3>
		<h3>SDT			: 		</h3>

	</footer>
</body>
</html>