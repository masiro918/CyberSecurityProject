<?php



echo "This api does not serve get responses!";




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
	send_response(null);
}

/**
 * Register
 */
function register($json) {
	send_response(null);
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

function send_response($res) {
	echo "this is response";
	die();
}



/**
 * And these functions blow are only used by this backend
 */
 
 
function check_login_status($username, $password, $device) {
	return "";
}

function add_to_database($sql) {
	return "";
}

function get_from_database($sql) {
	return "";
}

function delete_from_database($sql) {
	return "";
}