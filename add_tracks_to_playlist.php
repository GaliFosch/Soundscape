<?php

require_once("bootstrap.php");

$template["playlist_id"] = $_GET["pid"];
$template["title"] = "Soundscape - Add track to playlist";
$template["stylesheets"] = ["base.css", "new_resource_form.css", "search_suggestions.css", "list.css"];
$template["content"] = "template/add_tracks_to_playlist_form.php";

require("template/base.php");
