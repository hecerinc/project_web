-- @author Hector Rincon

CREATE DATABASE IF NOT EXISTS proyectoweb CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE users (
	id int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) UNIQUE NOT NULL,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	name VARCHAR(255),
	created DATETIME,
	profilePicturePath TEXT,
	coverPhotoPath TEXT,
	modified DATETIME
) Engine=InnoDB;


CREATE TABLE tweets (
	id int(11) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
	body TEXT,
	retweet_id int(11) UNSIGNED NOT NULL,
	user_id int(11) UNSIGNED NOT NULL,
	created DATETIME,
	modified DATETIME
) Engine=InnoDB;


CREATE TABLE followers (
	from_id int(11) UNSIGNED NOT NULL,
	to_id int(11) UNSIGNED NOT NULL,
	PRIMARY KEY(from_id, to_id),
	FOREIGN KEY(from_id) REFERENCES users(id),
	FOREIGN KEY(to_id) REFERENCES users(id)
) Engine=InnoDB;

CREATE TABLE likes (
	user_id int(11) UNSIGNED NOT NULL,
	tweet_id int(11) UNSIGNED NOT NULL,
	PRIMARY KEY(user_id, tweet_id),
	FOREIGN KEY(user_id) REFERENCES users(id),
	FOREIGN KEY(tweet_id) REFERENCES tweets(id)
) Engine=InnoDB;

ALTER TABLE tweets ADD CONSTRAINT fk_retweet_id FOREIGN KEY(retweet_id) REFERENCES tweets(id);
ALTER TABLE tweets ADD CONSTRAINT fk_user_id FOREIGN KEY(user_id) REFERENCES users(id);

