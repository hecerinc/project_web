<?php

// namespace App\Controller;

// use App\Controller\AppController;
require_once 'AppController.php';
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


}


