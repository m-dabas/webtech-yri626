<?php

	session_start();

	include('database.php');
	include('functions.php');

	//connect to DB
	$conn = connect_db();

	//Get data from the form
	$PID = sanitizeString($conn, $_POST['PID']);
	$UID = sanitizeString($conn, $_POST['UID']);
	$uname = sanitizeString($conn, $_POST['uname']);
	$comment = sanitizeString($conn, $_POST['comment']);

	$result_insert = mysqli_query($conn, "INSERT INTO comments(post_id, comment, user_id, user_Name) VALUES ($PID, '$comment', $UID, '$uname')");

	//check if insert was okay
	if($result_insert){
		//redirect to feed page 
		header("Location: feed.php");
	}else{
		//throw an error	
		echo "Oops! Something went wrong! Please try again!";
	}

 

?>