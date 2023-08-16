<?php

include("db_conn.php");

echo "This api does not serve get responses!\n";


register('{ "username" : "kissa", "password" : "koira" }');


/**
 * Get request and json.
 */

/*
$req = $_POST["req"];
$json = $_POST["json"];
*/



$req = null;
$json = null;


/**
 * Functions blow are api-functions. So these functions return JSON to frontend.
 */
if ($req == "login") login($json);
if ($req == "register") register($json);
if ($req == "logout") logout($json);
if ($req == "send_message") send_message($json);
if ($req == "get_messages") get_messages($json);


/**
 * Login
 */
function login($json) {
	$obj = json_decode($json);
	
	// TODO: hae obj:sta user ja pass, löytyykö db:stä ja jos löytyy palauta json
	send_response(null);
}

/**
 * Register
 */
function register($json) {
	$obj = json_decode($json);
	
	//echo var_dump($obj);
	
	$obj_array = (array)$obj;
	
	echo var_dump($obj_array);
	
	//TODO: array tietokantaan
	
	/*
	
	$conn = make_connection();
	add_to_database($conn, "insert into users (username, password) values (?, ?);", $obj);
	
	send_response(null);
	*/
}

/**
 * Logout
 */
function logout($json) {
	send_response(null);
}


/**
 * Send message.
 */
function send_message($json) {
	send_response(null);
}

/**
 * Get messages
 */
function get_messages($json) {
	send_response(null);
}


/**
 * And these functions blow are only used by this backend
 */
 
 
function check_login_status($usename, $password, $device) {
	return "";
}

function add_to_database($conn, $sql, $obj) {
	/*
	try {
		$conn = $yhteys->prepare($sql);
		$conn->execute(array($obj));
	} catch (Exception $e) {
		return false;
	}
	return true;
	*/
	echo var_dump(array(obj));
}

function get_from_database($sql) {
	return "";
}

function delete_from_database($sql) {
	return "";
}

function send_response($res) {
	echo $res;
	die();
}

?>
