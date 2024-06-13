<?php

require_once("bootstrap.php");

$template["playlist"] = $dbh->getPlaylistByID($_GET["id"]);
$template["title"] = "Soundscape - {$template["playlist"]["Name"]} by {$template["playlist"]["Creator"]}";
$template["stylesheets"] = ["base.css", "playlist.css"];
$template["content"] = "template/playlist_subpage.php";

require("template/base.php");
