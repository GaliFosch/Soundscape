<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Player";
$template["stylesheets"] = ["base.css", "player.css"];
$template["content"] = "template/music_player.php";

if (isset($_GET["refresh"]) && ($_GET["refresh"] == "true")) {
    if (isset($_SESSION["loaded_track_id"])) unset($_SESSION["loaded_track_id"]);
    if (isset($_SESSION["loaded_playlist_id"])) unset($_SESSION["loaded_playlist_id"]);
    if (isset($_SESSION["tracklist"])) unset($_SESSION["tracklist"]);
}

if (isset($_GET["trackid"])) {

    $template["track"] = $dbh->getTrackByID($_GET["trackid"]);
    $_SESSION["loaded_track_id"] = $_GET["trackid"];

} else if (isset($_GET["pid"])) {

    $template["playlist_id"] = $_GET["pid"];

    if (isset($_GET["shuffle"])) {
        $template["shuffle"] = $_GET["shuffle"];
    } else {
        $template["shuffle"] = "false";
    }

    if (isset($_GET["pos"])) {
        $template["pos"] = (int) $_GET["pos"];
    } else {
        $template["pos"] = 0;
    }

    if (!isset($_SESSION["loaded_playlist_id"]) || ($_SESSION["loaded_playlist_id"] != $template["playlist_id"])) {
        if ($template["shuffle"] == "true") {
            $template["tracklist"] = $dbh->getShuffledTracklistByPlaylistID($template["playlist_id"]);
        } else {
            $template["tracklist"] = $dbh->getOrderedTracklistByPlaylistID($template["playlist_id"]);
        }
        $_SESSION["loaded_playlist_id"] = $template["playlist_id"];
        $_SESSION["tracklist"] = $template["tracklist"];
    } else {
        $template["tracklist"] = $_SESSION["tracklist"];
    }

    $template["track"] = $template["tracklist"][$template["pos"]];

} else if (isset($_SESSION["loaded_track_id"])) {

    $template["track"] = $dbh->getTrackByID($_SESSION["loaded_track_id"]);

}

require("template/base.php");