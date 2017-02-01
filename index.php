<?php
/**
 * Twitch BullyBot insult list
 * @author Bartosz "DarkstoorM" Sieprawski <b.sieprawski@op.pl>
 * @license MIT License
 */

// Disable the error reporting , so it won't get into our output.
error_reporting(0);

// BullyBot
require ("bully.class.php");
$bully = new BullyBot();

// Enable emotes (personal preference)
$bully->enableEmotes = true;

// API response
$bully->BullyUser();