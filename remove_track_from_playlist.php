<?php

require_once("bootstrap.php");

$removal_success = $dbh->removeTrackFromPlaylist($_GET["trackid"], $_GET["pid"]);
if ($removal_success) {
    header("Location: playlist.php?id=" . $_GET["pid"]);
} else {
    header("Location: playlist.php?id=" . $_GET["pid"] . "&error=1");
}
