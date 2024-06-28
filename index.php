<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Home";
$template["stylesheets"] = ["base.css", "index.css", "comment.css", "post_button.css", "post.css"];
$template["content"] = "template/home_feed.php";

if(checkLogin($dbh)) {
    $template["posts"] = $dbh->getPersonalizedHomeFeed($_SESSION["username"]);
} else {
    $template["posts"] = $dbh->getGeneralHomeFeed(null);
}

require("template/base.php");
