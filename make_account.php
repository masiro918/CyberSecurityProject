<?php

include("db_conn.php");

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

	/*
	 * password must be include at least 10 character and one special character inside password.
         * however only characters #,%,&,*,+ and = are 'special' characters in this example
    	 * 
         * if (strlen($username) < 10) return true;
	 * if (preg_match('/[#%&*+=]/', $username) == false) return true; 
	 */
	return false;
}

if (username_exists($username) == false) {
	$conn = make_connection();
	$sql = "insert into Users (username, password) values (?, ?);";  
	$statement = $conn->prepare($sql);  
	$statement->execute(array($username, md5($password)));  
	// safer: $statement->execute(array($username, hash("sha256", $password))); 
	header("Location: index.php");
}

else {
	// redirect to the register page
	header("Location: register.php");
}

?>
	
