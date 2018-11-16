<?php

require_once dirname(__DIR__).'/dao/TweetDAO.php';

class Tweet {

	private $db_id;
	var $body;
	var $created;
	var $modified;
	var $User;

	var $retweetSrc; // Tweet

	// Constructor
	public function __construct($body, $rt_src = null, $created = null, $modified = null, $user = null) {

		$this->body = $body;

		if($rt_src !== null) {
			$this->retweetSrc = $rt_src;
		}
		if($created !== null) {
			$this->created = $created;
		}
		if($modified !== null) {
			$this->modified = $modified;
		}
		$this->User = $user;
	}
	public function save() {
		if($this->db_id == null) {
			// Insert
			$dbo = DataConnection::getDbConnection();
			$tweetDAO = new TweetDAO($dbo);
			if($dbid = $tweetDAO->insert($this)) {
				$this->db_id = $dbid;
				return true;
			}
		}
		else {
			// Update
		}
		return false;

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

	public static function getTweetsByUsers($user_list) {
		$tweetDAO = new TweetDAO(DataConnection::getDbConnection());
		return $tweetDAO->getTweetsByUsers($user_list);
	}

	// TODO: Getters y Setters
}

