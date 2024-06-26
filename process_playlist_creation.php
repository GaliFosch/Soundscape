<?php

require_once("bootstrap.php");

$title = $_POST["title"];

if (isset($_FILES["image"])) {
    $image = uploadImage("image");
    if ($image === false) {
        $image = null;
    }
} else {
    $image = null;
}

$collection_type = $_POST["collection-type"];
if ($collection_type === "album") {
    $is_album = true;
} elseif ($collection_type === "playlist") {
    $is_album = false;
} else {
    header("Location: create_playlist.php?error=" . MISSING_COLLECTION_TYPE);
}

$creator = $_SESSION["username"];

$tracks_ids = $_SESSION["selected-tracks-ids"];

$playlist_id = $dbh->addPlaylist($title, $image, $is_album, $creator, $tracks_ids);
if ($playlist_id != null) {
    // Insertion executed successfully
    header("Location: playlist.php?id=" . $playlist_id);
} else {
    // Insertion failed
    header("Location: create_playlist.php?error=" . PLAYLIST_INSERTION_FAILED);
}
