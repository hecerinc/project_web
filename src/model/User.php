<?php

/**
 * @author Hector Rincon
 */

class User {

	private var $db_id;
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

	public function __construct($username, $password, $email, $name, $created, $modified, $ppp, $cpp) {
		$this->username = $username;
		$this->password = $password;
		$this->email 	= $email;
		$this->name 	= $name;
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
		// Insert
		// Update
	}

	public function addFollower() {

	}

	public function fetchFollowers() {

	}

	public function fetchFollowing() {

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
