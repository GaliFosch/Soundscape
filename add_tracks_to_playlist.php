<?php

require_once("bootstrap.php");

if (!checkLogin($dbh)) {
    header("Location: login.php");
}

$template["playlist_id"] = $_GET["pid"];
$template["title"] = "Soundscape - Add tracks to playlist";
$template["stylesheets"] = ["base.css", "new_resource_form.css", "search_suggestions.css", "list.css"];
$template["content"] = "template/add_tracks_to_playlist_form.php";

require("template/base.php");
