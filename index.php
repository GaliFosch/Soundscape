<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Home";
$template["stylesheets"] = ["base.css", "index.css", "comment.css"];
$template["content"] = "template/home_feed.php";
$template["posts"] = array();

switch (isset($_SESSION['username'])) {
    case true:
        $template["posts"] = $dbh->getGeneralHomeFeed();
        break;
    case false:
        $template["posts"] = $dbh->getGeneralHomeFeed();
        break;
    default:
    $template["posts"] = $dbh->getGeneralHomeFeed();
        break;
}  // for testing purposes

require("template/base.php");
