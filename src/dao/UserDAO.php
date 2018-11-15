<?php



/**
 * @author Hector Rincon
 * @matricula A01088760
 */
class UserDAO {

	// DB connection
	private var $dbo;

	private const $_GETONEBYID       = "SELECT * FROM Users WHERE user_id = ?";
	private const $_GETONEBYUSERNAME = "SELECT * FROM Users WHERE username = ?";
	private const $_GETONEBYEMAIL    = "SELECT * FROM Users WHERE email = ?";
	private const $_GETFOLLOWERSFORUSER = "SELECT * FROM Users WHERE id IN (SELECT from_id FROM Followers WHERE to_id = ?)";
	private const $_GETFOLLOWEDBYUSER   = "SELECT * FROM Users WHERE id IN (SELECT to_id FROM Followers WHERE from_id = ?)";

	private const $_INSERT = "INSERT INTO Users(username, password, email, name, profilePicturePath, coverPhotoPath, created, modified) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

	// Updates
	private const $_UPDATEBASE = "UPDATE Users SET name = ?, password = ?, profilePicturePath = ?, coverPhotoPath = ?, modified = ?";
	private const $_UPDATEBYID = $_UPDATEBASE . " WHERE id = ?";
	private const $_UPDATEBYEMAIL = $_UPDATEBASE . " WHERE email = ?";
	private const $_UPDATEBYUSERNAME = $_UPDATEBASE . " WHERE username = ?";

	public function __construct($DBConnection) {
		$dbo = $DBConnection;
	}

	public function insert($User) {
		$stmt = $dbo->conn->prepare($_INSERT);

		$stmt->bind_param('ssssssss', $User->username, $User->password, $User->email, $User->name, $User->profilePicture, $User->coverPhoto, 'NOW()', 'NOW()');

		if($stmt->execute()) {
			$User->setDbId($stmt->insert_id);
			$stmt->close();
			return $User;
		}
		else {
			// TODO: Do something more interesting than throwing an error
			throw new Exception("Error Processing Insert Statement", 1);
		}
	}

	public function update($User) {
		$stmt = $dbo->conn->prepare($_UPDATEBYID);

		$stmt->bind_param('sssssssd', $User->name, $User->password, $User->profilePicture, $User->coverPhoto, 'NOW()', $User->getDbId());

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
