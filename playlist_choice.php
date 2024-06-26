<?php

require_once("bootstrap.php");

if (!checkLogin($dbh)) {
    header("Location: login.php");
}

$_SESSION["selected-tracks-ids"] = array($_GET["trackid"]);
$template["title"] = "Soundscape - Choose a playlist";
$template["stylesheets"] = ["base.css", "list.css"];
$template["content"] = "template/playlist_list.php";

require("template/base.php");
