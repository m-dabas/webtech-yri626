<?php
$dbhost = "localhost";	
$dbuser = "root";
$dbpass = "root";
$dbname = "myDB";

function connect_db(){
	$conn = mysqli_connect( $GLOBALS['dbhost'], $GLOBALS['dbuser'], $GLOBALS['dbpass'], $GLOBALS['dbname']);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	return $conn;
}	

?>	