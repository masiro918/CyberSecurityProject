<?php

/*
 * Add sessions start to make authorization. Now everyone can put messages without sign in.
 * so type after <?php : 
 
 session_start(); 
 if (!isset($_SESSION["username"])) {
	echo "You are not logged in!";
	die();
 }
 */

include("db_conn.php");

$username = $_POST["username"]; // sanitize: $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
$message = $_POST["message"]; // sanitize: $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

/*
 * 
 * anyone can add messages without register by this page
 */

// add the message to the database
$conn = make_connection();
$query = $conn->prepare("insert into Messages (username, timestamp , message) values (?, NOW(), ?);");  
$query->execute(array($username, $message));

/*
SQL-injection would be:

$query = $conn->prepare("insert into Messages (username, timestamp , message) values ($username, NOW(), $password);");
$query->execute();

*/

header("Location: chat.php");

?>
