<?php
	
	session_start();

	include('database.php');
	include('functions.php');

	//connect to DB
	$conn = connect_db();
	$UID = sanitizeString($conn, $_POST['UID']);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE id='$UID'");
	$row = mysqli_fetch_assoc($result);

	//Get data from the form
	$content = sanitizeString($conn, $_POST['content']);

	//Fetch User information	
	$name = sanitizeString($conn, $row["Name"]);
	$profile_pic = sanitizeString($conn, $row["profile_pic"]);

	echo "$name";

	$result_insert = mysqli_query($conn, "INSERT INTO posts(content, UID, name, profile_pic, likes) VALUES ('$content', $UID, '$name', '$profile_pic', 0)");

	//check if insert was okay
	if($result_insert){

		//redirect to feed page 
		header("Location: feed.php");

	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}

 

?>