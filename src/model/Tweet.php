<?php


class Tweet {

	private var $db_id;
	var $body;
	var $created;
	var $modified;

	var $retweetSrc; // Tweet

	// Constructor
	public function __construct($body, $rt_src = null, $created = null, $modified = null) {

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

