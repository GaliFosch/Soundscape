<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Post Creation";
$template["stylesheets"] = ["base.css", "post_creation.css"];
$template["content"] = "template/create_post.php";
$template["track"] = null;

if (isset($_GET["track"]) && isset($_GET["creator"])) {
    $template["track"] = $dbh->getTrackByName($_GET["track"], $_GET["creator"]);
}

require("template/base.php");