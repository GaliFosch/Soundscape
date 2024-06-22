<?php

require_once("bootstrap.php");

if (!checkLogin($dbh)) {
    header("Location: login.php");
}

$template["title"] = "Soundscape - Create Playlist";
$template["stylesheets"] = ["base.css", "new_resource_form.css", "search_suggestions.css", "list.css"];
$template["content"] = "template/new_playlist_form.php";

require("template/base.php");