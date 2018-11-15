<?php

// Replace this with a DEBUG var
error_reporting(E_ALL);

// Global Definitions
define('DEBUG', true);
define('APP_PATH', '/thunder/');
define('WEBROOT', '/public/');

$base  = dirname($_SERVER['PHP_SELF']);

// Update request when we have a subdirectory
if(ltrim($base, '/')){

    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($base));
}

// Helper functions
function loadView($viewName) {
	require __DIR__.WEBROOT.$viewName;
}
function debug($arg) {
	echo "<pre>";
	var_dump($arg);
	echo "</pre>";
}


require_once 'src/data/dbConnect.php';
require_once 'src/controller/UsersController.php';
// include 'src/config/paths.php';

// Initailise app with configuration

// Initialize connection to DB
// DataConnection::getDBConnection();


// TODO: Router goes here
require_once __DIR__ . '/vendor/autoload.php';

$router = new AltoRouter();



$router->map( 'GET', '/', function() {
	loadView("index.php");
});

$router->map('POST', '/users/register', function() {
	$controller = new UsersController();
	return $controller->register($_POST);
});

// $router->map( 'GET', '/css/[**:trailing]', function($trailing) {
// 	header("Location: ". __DIR__.WEBROOT."css/".$trailing);
// });


$match = $router->match();

if( $match && is_callable( $match['target'] ) ) {
	echo call_user_func_array( $match['target'], $match['params'] );
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
	// TODO: Return 404 page here
}

// var_dump("Test");


