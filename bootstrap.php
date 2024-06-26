<?php

const AUDIO_UPLOAD_FAILED = 1;
const TRACK_INSERTION_FAILED = 2;
const MISSING_COLLECTION_TYPE = 3;
const PLAYLIST_INSERTION_FAILED = 4;
const MISSING_PLAYLIST_ID = 5;
const TRACK_ADDITION_FAILED = 6;
const TRACK_REMOVAL_FAILED = 7;

require_once("utils/functions.php");

// Require database helper class and create an instance
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "soundscapedb");

sec_session_start();
