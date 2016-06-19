<!DOCTYPE html>
<html>
<head>
	<title>MyFacebook Feed</title>
</head>
<body>
<?php
	include('database.php');
	
	session_start();

	$conn = connect_db();

	$username = $_SESSION["username"];
	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

	//user information 
	$row = mysqli_fetch_assoc($result);
	$uid = $row['id'];
	$uname = $row['Name'];

	echo "<h1>Welcome back ".$row['Name']."!</h1>";
	echo "<img src='".$row['profile_pic']."'>";
	echo "<hr>";

	echo "<form method='POST' action='posts.php'>";
	echo "<p><textarea name='content' placeholder='Say something...'></textarea></p>";
	echo "<input type='hidden' name='UID' value='$uid'>";
	echo "<p><input type='submit'></p>";	
	echo "</form>";

	echo "<br>";

	$result_posts = mysqli_query($conn, "SELECT * FROM posts");
	$num_of_rows = mysqli_num_rows($result_posts);

	echo "<h2>My Feed</h2>";
	if ($num_of_rows == 0) {
		echo "<p>No new posts to show!</p>";
	}

	//show all posts on myfacebook
	for($i = 0; $i < $num_of_rows; $i++) {
		echo "<hr>";

		$row = mysqli_fetch_row($result_posts);
		echo "$row[3] said $row[1] ($row[5])";
		echo "<form action='likes.php' method='POST'> <input type='hidden' name='PID' value='$row[0]'> <input type='submit' value='Like'> </form>";

		$result_comments = mysqli_query($conn, "SELECT * FROM comments WHERE post_id='$row[0]'");
		$comment_cnt = mysqli_num_rows($result_comments);

		if ($comment_cnt > 0) {
			for ($j = 0; $j < $comment_cnt; $j++) {
				$comm = mysqli_fetch_row($result_comments);
				echo "<p>    $comm[4] commented $comm[2]</p>";
			}
		} else {
			echo "<p>    No comments.</p>";
		}

		echo "<form method='POST' action='comments.php'>";
		echo "<textarea name='comment' placeholder='Write a comment!'></textarea><br>";
		echo "<input type='hidden' name='PID' value='$row[0]'>";
		echo "<input type='hidden' name='UID' value='$uid'>";
		echo "<input type='hidden' name='uname' value='$uname'>";
		echo "<input type='submit' value='Comment'>";
		echo "</form>";
		
		echo "<br>";
	}

?>

</body>
</html>
