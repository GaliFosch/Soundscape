<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Player";
$template["stylesheets"] = ["base.css", "player.css"];
$template["content"] = "template/music_player.php";

if (isset($_GET["refresh"]) && ($_GET["refresh"] == "true")) {
    if (isset($_SESSION["loaded_track_id"])) {
        unset($_SESSION["loaded_track_id"]);
    }
    if (isset($_SESSION["loaded_playlist_id"])) {
        unset($_SESSION["loaded_playlist_id"]);
    }
    if (isset($_SESSION["tracklist"])) {
        unset($_SESSION["tracklist"]);
    }
    if (isset($_SESSION["current_tracklist_index"])) {
        unset($_SESSION["current_tracklist_index"]);
    }
}

if (isset($_GET["trackid"])) {

    // Load the requested track
    $template["track"] = $dbh->getTrackByID($_GET["trackid"]);
    $_SESSION["loaded_track_id"] = $_GET["trackid"];

    // Unset the playlist info previously saved in session if present
    if (isset($_SESSION["loaded_playlist_id"])) {
        unset($_SESSION["loaded_playlist_id"]);
    }
    if (isset($_SESSION["tracklist"])) {
        unset($_SESSION["tracklist"]);
    }
    if (isset($_SESSION["current_tracklist_index"])) {
        unset($_SESSION["current_tracklist_index"]);
    }
    if (isset($_SESSION["shuffle"])) {
        unset($_SESSION["shuffle"]);
    }

} else if (isset($_GET["pid"])) {

    $template["playlist_id"] = $_GET["pid"];

    if (isset($_GET["shuffle"])) {
        $template["shuffle"] = $_GET["shuffle"];
    } else {
        $template["shuffle"] = "false";
    }

    if (isset($_GET["pos"])) {
        $template["pos"] = (int)$_GET["pos"];
    } else {
        $template["pos"] = 0;
    }

    if (!isset($_SESSION["loaded_playlist_id"]) || ($_SESSION["loaded_playlist_id"] != $template["playlist_id"])) {

        // No previous playlist was saved in session or the requested playlist is not the same saved in session

        if ($template["shuffle"] == "true") {
            $template["tracklist"] = $dbh->getShuffledTracklistByPlaylistID($template["playlist_id"]);
        } else {
            $template["tracklist"] = $dbh->getOrderedTracklistByPlaylistID($template["playlist_id"]);
        }

        $_SESSION["loaded_playlist_id"] = $template["playlist_id"];
        $_SESSION["tracklist"] = $template["tracklist"];
        $_SESSION["current_tracklist_index"] = $template["pos"];
        $_SESSION["shuffle"] = $template["shuffle"];

    } else if (!isset($_SESSION["tracklist"])) {

        // The requested playlist was already saved in session, but the tracklist has been modified
        // If the tracklist has been modified after the last play of the playlist, then $_SESSION["tracklist"] is unset

        $template["playlist_id"] = $_SESSION["loaded_playlist_id"];
        $template["tracklist"] = $dbh->getOrderedTracklistByPlaylistID($template["playlist_id"]);
        $template["pos"] = $_SESSION["current_tracklist_index"];
        $template["shuffle"] = $_SESSION["shuffle"];

    } else {

        // The requested playlist was already saved in session and the tracklist has not been modified

        $template["tracklist"] = $_SESSION["tracklist"];

    }

    if ($template["pos"] == count($template["tracklist"])) {
        // This condition is verified when the last track of the tracklist ends
        // In this case, reload the last track played
        header("Location: player.php?pid=" . $template["playlist_id"] . "&shuffle=" . $template["shuffle"] . "&pos=" . ($template["pos"] - 1));
    } else if ($template["pos"] > count($template["tracklist"])) {
        http_response_code(404);
        exit();
    }

    $template["track"] = $template["tracklist"][$template["pos"]];
    $_SESSION["current_tracklist_index"] = $template["pos"];

    // Unset the single track previously saved in session if present
    if (isset($_SESSION["loaded_track_id"])) {
        unset($_SESSION["loaded_track_id"]);
    }

} else if (isset($_SESSION["loaded_track_id"])) {

    // No track was requested, but the last played track is saved in session

    $template["track"] = $dbh->getTrackByID($_SESSION["loaded_track_id"]);

} else if (isset($_SESSION["loaded_playlist_id"])) {

    // No playlist was requested, but the last played playlist is saved in session

    $template["playlist_id"] = $_SESSION["loaded_playlist_id"];
    $template["tracklist"] = $_SESSION["tracklist"];
    $template["pos"] = $_SESSION["current_tracklist_index"];
    $template["shuffle"] = $_SESSION["shuffle"];
    $template["track"] = $template["tracklist"][$template["pos"]];

}

require("template/base.php");