<?php

/**
 * @author Hector Rincon
 * @matricula A01088760
 */

class UserDAO {

	// DB connection
	private $dbo;

	const _GETONEBYID       = "SELECT * FROM Users WHERE user_id = ?";
	const _GETONEBYUSERNAME = "SELECT * FROM Users WHERE username = ?";
	const _GETONEBYEMAIL    = "SELECT * FROM Users WHERE email = ?";
	const _GETFOLLOWERSFORUSER = "SELECT * FROM Users WHERE id IN (SELECT from_id FROM Followers WHERE to_id = ?)";
	const _GETFOLLOWEDBYUSER   = "SELECT * FROM Users WHERE id IN (SELECT to_id FROM Followers WHERE from_id = ?)";

	const _INSERT = "INSERT INTO Users(username, password, email, name, profilePicturePath, coverPhotoPath, created, modified) VALUES(?, ?, ?, ?, ?, ?, NOW(), NOW())";

	// Updates
	const _UPDATEBASE = "UPDATE Users SET name = ?, password = ?, profilePicturePath = ?, coverPhotoPath = ?, modified = NOW()";
	const _UPDATEBYID = self::_UPDATEBASE . " WHERE id = ?";
	const _UPDATEBYEMAIL = self::_UPDATEBASE . " WHERE email = ?";
	const _UPDATEBYUSERNAME = self::_UPDATEBASE . " WHERE username = ?";

	public function __construct($DBConnection) {
		$this->dbo = $DBConnection;
	}

	public function insert($User) {
		$stmt = $this->dbo->conn->prepare(self::_INSERT);

		$stmt->bind_param('ssssss', $User->username, $User->password, $User->email, $User->name, $User->profilePicture, $User->coverPhoto);

		if($stmt->execute()) {
			// $User->setDbId($stmt->insert_id);
			$stmt_id = $stmt->insert_id;
			$stmt->close();
			return $stmt_id;
		}
		else {
			// TODO: Do something more interesting than throwing an error
			throw new Exception("Error Processing Insert Statement", 1);
		}
		return false;
	}

	public function update($User) {
		$stmt = $this->dbo->conn->prepare(self::_UPDATEBYID);

		$stmt->bind_param('ssssssd', $User->name, $User->password, $User->profilePicture, $User->coverPhoto, $User->getDbId());

		if($stmt->execute()) {
			$stmt->close();
			return $User;
		}
		else {
			// TODO: Do something more interesting than throwing an error
			throw new Exception("Error Processing Insert Statement", 1);
		}
	}

	public function getByEmail($email) {
		
	}
	public function getByUsername($email) {
		
	}
	public function getFollowers($User) {

	}
	public function getFollowed($Users) {

	}


}
