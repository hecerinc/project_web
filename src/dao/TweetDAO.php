<?php



/**
 * @author Hector Rincon
 * @matricula A01088760
 */

class TweetDAO {

	// DB connection
	private $dbo;

	const _GETONEBYID       = "SELECT * FROM Tweets WHERE id = ?";
	const _GETTWEETSBYIDS = "SELECT * FROM Tweets WHERE user_id IN (?)";
	const _INSERT = "INSERT INTO Tweets(body, retweet_id, user_id, created, modified) VALUES(?, ?, ?, NOW(), NOW())";
	const _INSERT2 = "INSERT INTO Tweets(body, user_id, created, modified) VALUES(?, ?, NOW(), NOW())";
	// // Updates
	// const _UPDATEBASE = "UPDATE Users SET name = ?, password = ?, profilePicturePath = ?, coverPhotoPath = ?, modified = NOW()";
	// const _UPDATEBYID = self::_UPDATEBASE . " WHERE id = ?";
	// const _UPDATEBYEMAIL = self::_UPDATEBASE . " WHERE email = ?";
	// const _UPDATEBYUSERNAME = self::_UPDATEBASE . " WHERE username = ?";

	public function __construct($DBConnection) {
		$this->dbo = $DBConnection;
	}

	public function insert($Tweet) {
		$stmt = $this->dbo->conn->prepare(self::_INSERT2);

		$stmt->bind_param('sd', $Tweet->body, ($Tweet->User));

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
	public function getTweetsByUsers($user_list) {
		$qMarks = str_repeat('?,', count($user_list) - 1) . '?';
		$ds = str_repeat('d,', count($user_list) - 1) . 'd';
		// $stmt = $this->dbo->conn->prepare("SELECT * FROM Tweets WHERE user_id IN ($qMarks) ORDER BY created");
		// $stmt->bind_param($ds, $user_list);
		$ids = implode(",", $user_list);
		$q = "SELECT * FROM Tweets AS T JOIN Users AS U ON T.user_id = U.id WHERE T.user_id IN ($ids) ORDER BY T.created";
		$result = $this->dbo->conn->query($q);
		if(!$result) {
			var_dump($this->dbo->conn->error);
			throw new Exception("Error fetching tweets", 1);
		}
		$tweets = [];
		while($row = $result->fetch_assoc()) {
			$user =  new User($row["username"], $row["email"], $row["password"], $row["name"], null, null, $row["profilePicturePath"], $row["coverPhotoPath"]);

			$tweet = new Tweet($row["body"], $row["retweet_id"], $row["created"], $row["modified"], $row["user_id"]);
			$tweet->User = $user;
			$tweet->setDbId($row['id']);
			$tweets[] = $tweet;
		}
		return $tweets;

	}

}
