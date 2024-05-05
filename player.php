<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Player";
$template["style"] = "base.css";
$template["content"] = "template/music_player.php";

$track_id = $_GET["trackid"];
if ($track_id != "") {
    $template["track"] = $dbh->getTrackByID($track_id);
} else {
    $template["track"] = null;
}

require("template/base.php");