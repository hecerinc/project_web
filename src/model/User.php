<?php

/**
 * @author Hector Rincon
 */

require_once dirname(__DIR__).'/dao/UserDAO.php';


class User {

	private $db_id = null;
	var $username;
	var $password;
	var $email;
	var $name;
	var $created;
	var $modified;
	var $profilePicture;
	var $coverPhoto;

	// Optional:
	var $followers; // Users[]
	var $following; // Users[]

	var $tweets; // Tweets[]

	public function __construct($username, $email, $password, $name = null, $created = null, $modified = null, $ppp = null, $cpp = null) {
		$this->username = $username;
		$this->password = $password;
		$this->email 	= $email;

		if($name == null) {
			$this->name = $username;
		}
		else {
			$this->name = $name;
		}

		$this->created 	= $created;
		$this->modified = $modified;

		if($ppp != null) {
			$this->profilePicture = $ppp;
		}
		if($cpp != null) {
			$this->coverPhoto = $cppp;
		}
	}



	// Save to DB
	public function save() {
		if($this->db_id == null) {
			// Insert
			$dbo = DataConnection::getDbConnection();
			$userDAO = new UserDAO($dbo);
			if($dbid = $userDAO->insert($this)) {
				$this->db_id = $dbid;
				return true;
			}
		}
		else {
			// Update
		}
		return false;
	}

	public function loadTweets() {
		// TODO: Change to tweetsDAO
		$userDAO = new UserDAO(DataConnection::getDbConnection());
		$this->tweets = $userDAO->getTweets($this->db_id);
	}
	public function getTweetCount() {
		$userDAO = new UserDAO(DataConnection::getDbConnection());
		$this->tweetCount = $userDAO->getTweetCount($this);
	}

	public function addFollower() {

	}

	public function fetchFollowers() {

	}

	public function fetchFollowing() {
		$userDAO = new UserDAO(DataConnection::getDbConnection());
		$this->following = $userDAO->getFollowing($this);
		return $this->following;
	}

	public function setDbId($id) {
		if($id == null || $this->db_id != null) {
			throw new Exception("ID cannot be null or ID already set", 1);
		}
		$this->db_id = $id;
	}
	public function getDbId() {
		return $this->db_id;
	}

	// TODO: Getters y Setters

}
