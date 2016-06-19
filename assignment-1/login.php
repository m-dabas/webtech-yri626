<?php

	//start session
	session_start();

	include('functions.php');

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	//get username and password from $_POST
	$username = sanitizeString($conn, $_POST["username"]);
	$password = sanitizeString($conn, $_POST["password"]);

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
	$num_of_rows = mysqli_num_rows($result);

	//Check in the DB
	if ($num_of_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["Password"])) {
			//If authenticated: say hello!
			$_SESSION["username"] = $username;
			header("Location: feed.php");
			//echo "Success!! Welcome ".$username;
		} else {
			echo "Invalid password! Try again!";
		}
	} else {
		//else ask to login again..	
		echo "User \"$username\" not found! Try again!";
	}

?>

