<?php

require_once("bootstrap.php");

if (isset($_GET["pid"])) {
    $playlist_id = $_GET["pid"];
} elseif (isset($_POST["playlist_id"])) {
    $playlist_id = $_POST["playlist_id"];
} else {
    header("Location: create_playlist.php?error=" . MISSING_PLAYLIST_ID);
}

$tracks_ids = $_SESSION["selected-tracks-ids"];

$insert_success = $dbh->addTracksToPlaylist($playlist_id, $tracks_ids);
if ($insert_success) {
    unset($_SESSION["tracklist"]);  // Remove the old tracklist from session info
    header("Location: playlist.php?id=" . $playlist_id);
} else {
    header("Location: create_playlist.php?error=" . TRACK_ADDITION_FAILED);
}
