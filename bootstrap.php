<?php

// Require database helper class and create an instance
require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "soundscapedb");

session_start();
