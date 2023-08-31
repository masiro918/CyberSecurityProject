<?php

include("db_conn.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$username = $_POST["username"];
$password = $_POST["password"];


function username_exists($username) {
	$conn = make_connection();
	$query = $conn->prepare("SELECT * FROM Users;");
	$query->execute();
	
	while ($line = $query->fetch()) {
		$_username = $line["username"];
		if ($_username == $username) {
			return true;
		}
	}
	return false;
}

if (username_exists($username) == false) {
	// create account and redirect to the main page
	$conn = make_connection();
	$sql = "insert into Users (username, password) values (?, ?);";  
	$statement = $conn->prepare($sql);  
	$statement->execute(array($username, md5($password)));  
	header("Location: index.php");
}

else {
	// redirect to the register page
	header("Location: register.php");
}

?>
	