<?php

require_once("bootstrap.php");

$playlist_id = $_GET["pid"];
$tracks_ids = $_SESSION["selected-tracks-ids"];
$insert_success = $dbh->addTracksToPlaylist($playlist_id, $tracks_ids);
if ($insert_success) {
    header("Location: playlist.php?id=" . $playlist_id);
} else {
    header("Location: create_playlist.php?error=3");
}
