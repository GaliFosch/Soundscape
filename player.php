<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Player";
$template["style"] = "base.css";
$template["content"] = "template/music_player.php";

if (isset($_GET["trackid"])) {
    $template["track"] = $dbh->getTrackByID($_GET["trackid"]);
    $_SESSION["loaded_track_id"] = $_GET["trackid"];
} elseif (isset($_SESSION["loaded_track_id"])) {
    $template["track"] = $dbh->getTrackByID($_SESSION["loaded_track_id"]);
}

require("template/base.php");