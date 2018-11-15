<?php


// Base controller for shared logic
// namespace App\Controller;


/**
 * AppController
 */
class AppController {

	private $request;
	private $response;

	function __construct($request = null, $response = null) {
		$this->request = $request;
		$this->response = $response;
		$this->initialize();
	}

	public function initialize() {
		// Do auth here?
	}

	public function isAuthorised() {

	}
}

