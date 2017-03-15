<?php
	include("config.php");
	global $conn;
	if(isset($_POST['username']) && isset($_POST['address']) && isset($_POST['number']) && isset($_POST['password'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$address = $_POST['address'];
		$number = $_POST['number'];

		$sql = "SELECT user_id FROM shop_users WHERE name = '$username' or number='$number' ";
		$retval = mysqli_query($conn, $sql);
		$conn = mysqli_num_rows($retval);
		if(count == 1){
			$error = "Your username or phone number was used! Choose an other name";
		}
		else{
			$sql = "SELECT COUNT('user_id') as numrow FROM shop_users";
			$retval = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($retval, MYSQLI_ASSOC);
			$count = intval($row['numrow']);
			$count++;
			$sql = "INSERT INTO shop_users VALUES ($count, '$username', '$address', '$number', '$password' ) ";
			$retval = mysqli_query($conn, $sql);
			if($retval){
				die("Could not insert mysqli. " . mysqli._error($conn));
			}
			echo "<p> Success. Dang nhap <a href='login.php'> o day</a> </p>";
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>

</head>
<body>
	
	<div align="center" style="margin-top:100px">
		<h1>SIGN UP</h1>

		<h2><?php echo $error ?></h2>
		<form action="signup.php" method="post">
			<h2>
				Username:
				<input type="text" name="username" size="35" > 
			</h2>
			<h2>
				Password:
				<input type="password" name="password" size="35">
			</h2>
			<input type="submit" name="add" value="Sign up">
		</form>
		<p>Return to <a href="index.php">sign in</a> page.</p>
	</div>

</body>
</html>