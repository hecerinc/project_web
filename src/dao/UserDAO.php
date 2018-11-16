<?php

/**
 * @author Hector Rincon
 * @matricula A01088760
 */

class UserDAO {

	// DB connection
	private $dbo;

	const _GETONEBYID       = "SELECT * FROM Users WHERE id = ?";
	const _GETONEBYUSERNAME = "SELECT * FROM Users WHERE username = ?";
	const _GETONEBYEMAIL    = "SELECT * FROM Users WHERE email = ?";
	const _GETFOLLOWERSFORUSER = "SELECT id FROM Users WHERE id IN (SELECT from_id FROM Followers WHERE to_id = ?)";
	const _GETFOLLOWEDBYUSER   = "SELECT id FROM Users WHERE id IN (SELECT to_id FROM Followers WHERE from_id = ?)";

	const _INSERT = "INSERT INTO Users(username, password, email, name, profilePicturePath, coverPhotoPath, created, modified) VALUES(?, ?, ?, ?, ?, ?, NOW(), NOW())";

	// Updates
	const _UPDATEBASE = "UPDATE Users SET name = ?, password = ?, profilePicturePath = ?, coverPhotoPath = ?, modified = NOW()";
	const _UPDATEBYID = self::_UPDATEBASE . " WHERE id = ?";
	const _UPDATEBYEMAIL = self::_UPDATEBASE . " WHERE email = ?";
	const _UPDATEBYUSERNAME = self::_UPDATEBASE . " WHERE username = ?";

	// Followers

	const _CREATEFOLLOWING = "INSERT INTO Followers(from_id, to_id) VALUES(?, ?)";

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
	// TODO: Check that all statements are closed
	public function createFollowing($from_id, $to_id) {
		$stmt = $this->dbo->conn->prepare(self::_CREATEFOLLOWING);
		$stmt->bind_param('dd', $from_id, $to_id);
		if($stmt->execute()) {
			$stmt->close();
			return true;
		}
		else {
			// TODO: Do something more interesting than throwing an error
			var_dump($stmt->error);
			throw new Exception("Error inserting into following", 1);
		}
		return false;
	}
	public function getByUsername($username) {
		$stmt = $this->dbo->conn->prepare(self::_GETONEBYUSERNAME);
		$stmt->bind_param('s', $username);

		if($stmt->execute()) {
			$result = $stmt->get_result();
			$row = $result->fetch_assoc();
			$user =  new User($row["username"], $row["email"], $row["password"], $row["name"], $row["created"], $row["modified"], $row["profilePicturePath"], $row["coverPhotoPath"]);
			$user->setDbId($row['id']);
			return $user;

		}
		else {
			// TODO: Do something more interesting than throwing an error
			throw new Exception("Error retrieving user", 1);
		}

	}

	public function getFollowers($User) {

	}

	public function getFollowing($User) {
		$stmt = $this->dbo->conn->prepare(self::_GETFOLLOWEDBYUSER);

		$user_id = $User->getDbId();

		$stmt->bind_param('d', $user_id);
		if($stmt->execute()) {
			$result = $stmt->get_result();
			$following = [];
			while($row = $result->fetch_assoc()){
				$following[] = $row['id'];
			}
			return $following;
		}
		else {
			// TODO: Do something more interesting than throwing an error
			throw new Exception("Error retrieving user", 1);
		}

		return false;

	}

	// TODO: Remove this from here
	public function getTweets($userid) {
		$stmt = $this->dbo->conn->prepare("SELECT * FROM tweets  WHERE user_id = ?");
		$stmt->bind_param('d', $userid);
		if($stmt->execute()) {
			$result = $stmt->get_result();
			$tweets = [];
			while($row = $result->fetch_assoc()) {
				$tweet = new Tweet($row['body'], $row['retweet_id'], $row['created'], $row['modified']);
				$tweet->setDbId($row['id']);
				$tweets[] = $tweet;
			}
			return $tweets;
		}
		else {
			// TODO: Do something more interesting than throwing an error
			throw new Exception("Error retrieving user feed", 1);
		}
		return false;
	}

}
