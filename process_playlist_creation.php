<?php

require_once("bootstrap.php");

$title = $_POST["name"];
$image = COVER_IMAGES_DIR . $_POST["image"];
$collection_type = $_POST["collection-type"];
if ($collection_type === "album") {
    $is_album = true;
} elseif ($collection_type === "playlist") {
    $is_album = false;
} else {
    header("Location: create_playlist.php?error=1");
}
