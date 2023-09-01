<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("db_conn.php");

$username = $_POST["username"];
$password = $_POST["password"];

$results = get_from_database(make_connection());
echo "try to match $username and " . md5($password);

foreach ($results as $key => $value) {
	$blocks = explode(";", $value);
	if (($username == $blocks[0]) && (md5($password) == $blocks[1])) {
		$_SESSION["username"] = $username;
        	header("Location: chat.php");
        	die();
	}
}

function get_from_database($conn) {
	$users = array();
	try {
		$query = $conn->prepare("SELECT * FROM Users;");
		$query->execute();
		
		$i=0;
		while ($line = $query->fetch()) {
			$users[$i] = $line["username"] . ";" . $line["password"];
			$i++;
		}
		return $users;
	} catch (Exception $e) {
		echo "ERROR: " . $e;
		die();
	}
}

?>
