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
		// login successded
		// add session and redirect to the chat page
		//echo "try to match $username and $password to " . $blocks[0] . ";" . $blocks[1];
		$_SESSION["username"] = $username;
        header("Location: chat.php");
        die();
	}
}

// username or password was wrong
echo "wrong";
//header("Location: index.php");

function get_from_database($conn) {
	$users = array();
	try {
		echo "create prepare<br>";
		$query = $conn->prepare("SELECT * FROM Users;");
		echo "create execute<br>";
		$query->execute();
		
		$i=0;
		while ($line = $query->fetch()) {
			$users[$i] = $line["username"] . ";" . $line["password"];
			echo $users[$i];
			$i++;
		}
		return $users;
	} catch (Exception $e) {
		echo "ERROR: " . $e;
		die();
	}
}

?>
