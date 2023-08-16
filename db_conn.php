<?php

function make_connection() {
	return new PDO("mysql:host=localhost;dbname=chat-app","root", "");
}


