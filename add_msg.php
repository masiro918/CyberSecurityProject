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

$username = $_POST["username"];
$message = $_POST["message"];

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
