<?php


require_once dirname(__DIR__).'/model/Tweet.php';


/**
 * TweetsController
 */
class TweetsController extends AppController {

	public static function getTweetsByUsers($user_list) {
		return Tweet::getTweetsByUsers($user_list);
	}
	public function addTweet($user_id, $body) {
		$tweet = new Tweet($body, null, null, null, $user_id);
		return $tweet->save();
	}
}

