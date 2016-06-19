<?php

//start session
session_start();

include('functions.php');

$flag = false;
$hpassword = "";

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "root";
$dbname = "myDB";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if( mysqli_connect_errno($conn)){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

//get sign-up info from $_POST
$username = sanitizeString($conn, $_POST["username"]);
$password = sanitizeString($conn, $_POST["password"]);
$rpassword = sanitizeString($conn, $_POST["rpassword"]);
$name = sanitizeString($conn, $_POST["name"]);
$email = sanitizeString($conn, $_POST["email"]);
$dob = sanitizeString($conn, $_POST["dob"]);
$gender = sanitizeString($conn, $_POST["gender"]);
$vq = sanitizeString($conn, $_POST["vq"]);
$va = sanitizeString($conn, $_POST["va"]);
$location = sanitizeString($conn, $_POST["location"]);
$profile_pic = sanitizeString($conn, $_POST["profile_pic"]);

$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

$num_of_rows = mysqli_num_rows($result);

if ($num_of_rows > 0) {
    echo "<p>Sorry, but that username is already taken.</p>";
    $flag = true;
}
if (strcmp($password, $rpassword) != 0) {
    echo "<p>The two passwords do not match.</p>";
    $flag = true;
} else if (($hpassword = password_hash($password, PASSWORD_DEFAULT)) == false) {
    echo "<p>Oops! Something went wrong with the password hashing.</p>";
    $flag = true;
}

if ($flag == false) {
    $result_insert = mysqli_query($conn, "INSERT INTO users(Username, Password, Name, email, dob, gender, verification_question, verification_answer, location, profile_pic) VALUES ('$username','$hpassword', '$name', '$email', '$dob', '$gender', '$vq', '$va', '$location', '$profile_pic')");

    if ($result_insert) {
        //redirect to feed page
        header("Location: login.html");
    } else {
        //throw an error
        echo "Oops! Something went wrong! Please try again!";
    }
}

?>