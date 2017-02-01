<?php
/**
 * Twitch BullyBot Class
 * @author DarkStoorM
 * @license MIT License
 */
class BullyBot {
	/**
	 * Username grabbed from the URL
	 * @var string
	 */
	private $user = "";

	/**
	 * Checks if the user passed in the URL parameter is valid according to the Twitch username rules
	 * @return bool User status check
	 */
	private function IsUserValid() {
		// This should not even be set here, it's user's job to set up his command correctly
		if (!isset($_GET["u"]))
			$_GET["u"] = "";

		$user = $_GET["u"];

		// It doesn't need any further validation as long as it matches the pattern
		if (preg_match("/^[a-z0-9_]{1,25}$/i", $user)) {
			$this->user = $user;
			return true;
		} else
			return false;
	}

	/**
	 * Returns a random insult
	 * @return string Random insult chosen from the list
	 */
	private function GetBully() {
		// Set up a username variable instead for easier changes
		$user = $this->user;
		require ("bully.list.php");
		
		// Select a number between 0 and the number of bully list
		$randomNumber = mt_rand(0, (count($bullyList) -1) );

		// Pick the random insult
		$bullyResponse = $bullyList[$randomNumber];
		return $bullyResponse;
	}

	/**
	 * Bullies the selected user. If username is invalid, echo the response
	 */
	public function BullyUser() {
		// Set up the user variable
		if ($this->IsUserValid() === true)
			$user = $this->user;
		// If the username was not valid, return the message instead
		else {
			echo "NO BULLY FOR YOU";
			return;
		}
		
		$insult = $this->GetBully($user);

		// Echo out the insult with given username
		echo $insult;
	}
}