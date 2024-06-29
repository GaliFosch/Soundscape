<?php

require_once("bootstrap.php");

// Discard session info related to login
unset($_SESSION["username"]);
unset($_SESSION["loginString"]);

// Discard session info related to the music player
if (isset($_SESSION["loaded_track_id"])) {
    unset($_SESSION["loaded_track_id"]);
}
if (isset($_SESSION["loaded_playlist_id"])) {
    unset($_SESSION["loaded_playlist_id"]);
}
if (isset($_SESSION["shuffle"])) {
    unset($_SESSION["shuffle"]);
}
if (isset($_SESSION["tracklist"])) {
    unset($_SESSION["tracklist"]);
}
if (isset($_SESSION["current_tracklist_index"])) {
    unset($_SESSION["current_tracklist_index"]);
}

if (isset($_SESSION["selected_tracks_ids"])) {
    unset($_SESSION["selected_tracks_ids"]);
}

header("Location: index.php");
