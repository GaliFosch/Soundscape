<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Player";
$template["style"] = "base.css";
$template["content"] = "template/music_player.php";

if (isset($_GET["trackid"])) {
    $template["track"] = $dbh->getTrackByID($_GET["trackid"]);
}

require("template/base.php");