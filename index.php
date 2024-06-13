<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Home";
$template["stylesheets"] = ["base.css", "index.css", "comment.css", "postButton.css"];
$template["content"] = "template/home_feed.php";
$template["posts"] = $dbh->getGeneralHomeFeed();

require("template/base.php");
require("template/post_button.php");
