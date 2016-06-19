<?php 
	include('database.php');

	//connect to DB
	$conn = connect_db();

	//get data from the form
	$PID = $_POST['PID'];

	//query DB for this Post

	$result = mysqli_query($conn, "SELECT * FROM posts WHERE id='$PID'");

	$row = mysqli_fetch_assoc($result);
	$likes = $row['likes'];

	//update likes
	$likes = $likes + 1;

	$result = mysqli_query($conn, "UPDATE posts SET likes='$likes' WHERE id='$PID'");
	if($result){
		header('Location: feed.php');
	}else{

		echo "Something is wrong!";
	}

 ?>

