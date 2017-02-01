<?php
/**
 * Twitch BullyBot Class
 * @author Bartosz "DarkstoorM" Sieprawski <b.sieprawski@op.pl>
 * @license MIT License
 */
class BullyBot {
	/**
	 * Username grabbed from the URL
	 * @var string
	 */
	private $user = "";

	/**
	 * Custom response when the username is invalid. Chat output for the bot
	 * @var string
	 */
	private $invalidUserResponse = "NO BULLY FOR YOU";

	/**
	 * Twitch emote toggle. If the emotes are enabled, they will be appended to the strings.
	 * Disabled by default
	 * @var boolean
	 */
	public $enableEmotes = false;

	/**
	 * Custom RNG
	 * @param int $min Minimum value for RNG
	 * @param int $max Maximum value for RNG
	 * @return int Random value from given range
	 */
	private function RandomNumber($min, $max) {
		return mt_rand($min, $max);
	}

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
		
		// Select a number between 0 and the number of insult list size
		$randomNumber = $this->RandomNumber(0, (count($bullyList) -1) );

		// Pick the random insult
		$bullyResponse = $bullyList[$randomNumber];

		return $bullyResponse;
	}

	/**
	 * Returns an emote string.
	 * You can also use emotes from channels that Nightbot is subbed to.
	 * Use custom emotes with caution, as some channels may lose their partnership
	 * @return string Emote
	 */
	private function AppendEmote() {
		// Twitch / BTTV Emote list
		$emoteList = array(
			' TriHard',
			' LUL',
			' 4Head',
			' EleGiggle',
			' MingLee',
			' drakoPalm',
			' FailFish',
			' OpieOP',
			' FreakinStinkin',
			' OMGScoots',
			' BasedGod',
			' NaM',
			' :tf:',
			' BigBrother',
			' HassaanChop',
			' SoBayed',
			' SuperVinlin',
			' MVGame'
		);

		// Return a random array element
		return $emoteList[$this->RandomNumber(0, (count($emoteList) -1) )];
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
			echo $this->invalidUserResponse;
			return;
		}

		// Pick an insult with passed user
		$insult = $this->GetBully($user);

		// Append emotes if enabled
		$insult .= $this->enableEmotes ? $this->AppendEmote() : "";

		// Echo out the insult with given username
		echo $insult;
	}
}