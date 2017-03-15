<?php
	define('DB_SERVER', 'localhost:3306');
	define('DB_USERNAME', 'guest');
	define('DB_PASSWORD', 'guest123');
	define('DB_DATABASE', 'guestdb');
	$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);	
	if(!$conn){
		echo "Unable to connect to MySQL." . PHP_EOL;
		echo "Debugging errono: ". mysqli_connect_errno() . PHP_EOL;
		exit;
	}
?>