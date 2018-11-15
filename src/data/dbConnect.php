<?php

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'proyectoweb');
define("BASE_URL", "http://localhost/thunder/"); // Eg. http://yourwebsite.com

// function dbConnect($hostname = DB_SERVER, $user = DB_USERNAME, $pass = DB_PASSWORD, $db = DB_DATABASE) {
// 	$mysqli = new mysqli($hostname, $user, $pass, $db);
// 	if ($mysqli->connect_error) {
// 		var_dump("Failed to connect to MySQL database");
//         die();
// 		return null;
// 	}
// 	$mysqli->set_charset('utf8');
// 	return $mysqli;
// }

/**
 * Database Connection
 */
class DataConnection {

	private static $instance = NULL;
	var $conn;


	private function __construct() {
		$mysqli = new mysqli($hostname, $user, $pass, $db);
		if ($mysqli->connect_error) {
			var_dump("Failed to connect to MySQL database");
	        die();
			return null;
		}
		$mysqli->set_charset('utf8');
		$this->conn = $mysqli;
	}
	// Initializer
	static function getDBConnection($hostname = DB_SERVER, $user = DB_USERNAME, $pass = DB_PASSWORD, $db = DB_DATABASE) {
		if(self::$instance == NULL) {
			return new DataConnection();
		}
		return self::$instance;
 	}

	function __destruct() {
		if($this->conn !== null) {
			$this->conn->close();
		}
	}
}
