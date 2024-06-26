<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Home";
$template["stylesheets"] = ["base.css", "index.css", "comment.css", "post_button.css", "post.css", "post_focus.css"];
$template["content"] = "template/home_feed.php";

if(isset($_SESSION['username'])) {
    //$template["posts"] = $dbh->getPersonalizedHomeFeed();
    $template["posts"] = $dbh->getGeneralHomeFeed();
} else {
    $template["posts"] = $dbh->getGeneralHomeFeed();
}

require("template/base.php");
