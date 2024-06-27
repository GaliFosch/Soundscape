<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Home";
$template["stylesheets"] = ["base.css", "index.css", "comment.css", "post_button.css", "post.css", "post_focus.css"];
$template["content"] = "template/home_feed.php";

if(checkLogin($dbh)) {
    $template["posts"] = $dbh->getPersonalizedHomeFeed($_SESSION["username"], 10 , 0);
} else {
    $template["posts"] = $dbh->getGeneralHomeFeed(null, 10, 0);
}

require("template/base.php");
