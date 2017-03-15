<?php
	session_start();
	include('config.php');
	global $conn;
	if(isset($_POST['username']) && isset($_POST['password'])){

		$username = mysqli_real_escape_string($conn, $_POST['username']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		
		if(!$conn){
			die("could not connect: ".mysqli_error($conn));
		}
		
		//mysqli_select_db($conn, 'guestdb');
		$sql = "SELECT user_id, name FROM shop_users WHERE name = '$username' and password = '$password' ";
		$retval = mysqli_query($conn, $sql);

		if(!$retval){
			die('could not get data: ' . mysqli_error($conn));
		}
		
		$row = mysqli_fetch_array($retval, MYSQLI_ASSOC);

		$count = mysqli_num_rows($retval);

		if($count == 1){
			$_SESSION['username'] = $username;
			$_SESSION['userid'] = $row['user_id'];
			header("Location: index.php");
		}
		else{
			$error = "Your login name or Password is invalid.";
		}


		
	}

	// if(isset($_POST['add'])){
	// 	if(!(isset($_POST['username'])) || (!isset($_POST['password'])) ) {
	// 		$error = "You must fill all field in sign up form.";
	// 	}
	// 	else{
	// 		$sql = "SELECT userID FROM cmsusers WHERE users='$_POST['username']'";
	// 		$retval = mysqli_query($conn, $sql);
	// 		$count = mysqli_num_rows($retval);
	// 		if($count != 0){
	// 			$error = "Your name was used! Please, Choose another username.";
	// 		}
	// 		else{
	// 			$sql = "SELECT userID FROM cmsusers";
	// 			$retval = mysqli_query($conn, $sql);
	// 			$count = mysqli_num_rows($retval);
	// 			$sql = "INSERT "
	// 		}
	// 	}	
	// }

	if(isset($_GET['signout'])){
		//unset($_SESSION['username']);
		if(session_destroy() ){
			header("Location: index.php");
		}

	}

?>

<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<div align="center" style="margin-top:100px">
			
			<h1> Login </h1>
			<p><?php echo $error ?></p>
			<form action="login.php" method="post">
				<h3> Username <input style="height:40px" type="text" name="username" size="35"> </h3>
				
				<h3>Password <input style="height:40px" type="password" name="password" size="35"></h3>
				
				<input type="submit" value="Sign in">
			</form>

			<a href="signup.php">Sign up</a>
		</div>
		
	</body>
</html>