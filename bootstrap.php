<?php

const COVER_IMAGES_DIR = "cover_images/";

require_once("utils/functions.php");

// Require database helper class and create an instance
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "soundscapedb");

sec_session_start();
