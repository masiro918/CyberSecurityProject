<?php

include("db_conn.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

header("Location: chat.php");

?>