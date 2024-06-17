<?php

require_once("bootstrap.php");

if(!checkLogin($dbh)){
    header("Location: login.php");
}

$template["title"] = "Soundscape - Create Track";
$template["stylesheets"] = ["base.css", "createTrack.css"];
$template["content"] = "template/create_track.php";

require("template/base.php");