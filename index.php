<?php
/**
 * Twitch BullyBot insult list
 * @author DarkStoorM
 * @license MIT License
 */
	
// BullyBot
require ("bully.class.php");
$bully = new BullyBot();

// Enable emotes (personal preference)
$bully->enableEmotes = true;

// API response
$bully->BullyUser();