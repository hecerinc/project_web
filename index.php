<?php

// Replace this with a DEBUG var
error_reporting(E_ALL);

// Global Definitions
define('DEBUG', true);
define('BASE_URI', 'http://localhost/thunder/');
define('APP_PATH', '/thunder/');
define('WEBROOT', '/public/');

$base  = dirname($_SERVER['PHP_SELF']);

// Update request when we have a subdirectory
if(ltrim($base, '/')){

    $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], strlen($base));
}

// Helper functions
function loadView($viewName, $viewParams = array()) {
	extract($viewParams);
	require __DIR__.WEBROOT.$viewName;
}
function debug($arg) {
	echo "<pre>";
	var_dump($arg);
	echo "</pre>";
}
function redirect($where) {
	header("Location: /thunder".$where);
}

function loadCSS($name) {
	echo "<link rel=\"stylesheet\" href=\"".BASE_URI."/css/".$name."\">";
}
function isLoggedIn() {
	return isset($_SESSION) && isset($_SESSION['User']);
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

$router->map('GET', '/users/logout', function() {
	session_start();
	session_unset();
	session_destroy();
	redirect('/');
	// return "Succesfully deleted session";
});


$router->map('POST', '/users/login', function() {
	$controller = new UsersController();
	$is_loggedin =  $controller->login($_POST);
	debug($is_loggedin);
	if($is_loggedin) {
		redirect("/feed");
	}
	else {
		loadView("index.php", ['error' => 'Wrong username or password']);
	}
});

// logged in user
$router->map('GET', '/feed', function() {
	session_start();
	// $controller = new AppController();
	if(isset($_SESSION["User"])) {
		$user = $_SESSION["User"];
		$user->loadTweets();
		loadView("feed.php", ['feedUser' => $user]);
	}
	else {
		redirect("/");
	}
});
// not logged in user
$router->map('GET', '/feed/[:username]', function($username) {
	session_start();
	$controller = new UsersController();
	$controller->getUserFeed($username);
	// loadView("feed.php", );
});

// User home
$router->map('GET', '/home', function() {
	session_start();
	// debug($_SESSION);
	$controller = new UsersController();
	if(isLoggedIn()) {
		// go ahead
		$controller->getHomeFeed($_SESSION['User']);
	}
	else {
		redirect("/");
	}
});


$router->map('POST', '/follow', function() {
	session_start();
	if(isLoggedIn()) {

		$controller = new UsersController();
		$result = $controller->createFollowing($_SESSION['User']->getDbId(), $_POST['to_id']);
		if($result) {
			echo json_encode(['success' => 'success']);
		}
		else {
			echo json_encode(['error' => 'Failed to follow user']);
		}
	}
	else {
		die('Must be logged in');
	}
});

$router->map('POST', '/tweet', function() {
	session_start();
	if(isLoggedIn()) {
		$user_id = $_POST['user_id'];
		$body = $_POST['body'];
		$controller = new TweetsController();
		$result = $controller->addTweet($user_id, $body);
		if($result) {
			echo json_encode(['success' => 'success']);
		}
		else {
			echo json_encode(['error' => 'Failed to follow user']);
		}

	}
	else {
		die('Must be logged in');
	}

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


