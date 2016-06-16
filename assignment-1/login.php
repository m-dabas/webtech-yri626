<?php
		
	//start session
	session_start();	

	//get username and password from $_POST
	$username = $_POST["username"];
	$password = $_POST["password"];

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

	$num_of_rows = mysqli_num_rows($result);
	//Check in the DB
	if($num_of_rows > 0){

		//If authenticated: say hello!
		$_SESSION["username"] = $username;
		header("Location: feed.php");
		//echo "Success!! Welcome ".$username;

	}else{
		//else ask to login again..	
		echo "Invalid password! Try again!";

	}
?>