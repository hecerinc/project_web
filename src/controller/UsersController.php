<?php

// namespace App\Controller;

// use App\Controller\AppController;
require_once 'AppController.php';
require_once 'TweetsController.php';
require_once dirname(__DIR__).'/model/User.php';

/**
 * UsersController
 */
class UsersController extends AppController {

	public function register($params) {
		$user = new User($params['username'], $params['email'], md5($params['password']));
		if($user->save()) {
			$id = $user->getDbId();
			return "Successfully saved user $id!";
		}
		else {
			return 'Failed to save user to DB';
		}
	}

	public function login($params) {
		$username = $params['loginusername'];
		$password = md5($params['loginpassword']);

		$userDAO =  new UserDAO(DataConnection::getDBConnection());
		$user = $userDAO->getByUsername($username);
		if($user) {
			if(strcmp($user->password, $password) == 0) {
				// Log him in
				session_start();
				$_SESSION['User'] = $user;
				return true;
			}
			else {
				// passwords don't match
				return false;
			}
		}

	}

	public function getUserFeed($username) {
		$userDAO =  new UserDAO(DataConnection::getDBConnection());
		$user = $userDAO->getByUsername($username);
		$user->loadTweets();
		loadView("feed.php", ['feedUser' => $user]);
	}

	// TODO: Move this from here
	public function getHomeFeed($User){
		$following = $User->fetchFollowing();
		if(count($following) > 0){
			$feed = TweetsController::getTweetsByUsers($following);
		}
		else {
			$feed = [];
		}
		loadView("/newsfeed.php", ['user' => $User, 'feed' => $feed]);
	}
	public function createFollowing($from_id, $to_id) {
		$userDAO =  new UserDAO(DataConnection::getDBConnection());
		return $userDAO->createFollowing($from_id, $to_id);
	}
}


