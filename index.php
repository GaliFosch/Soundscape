<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Home";
$template["stylesheets"] = ["base.css", "index.css"];
$template["content"] = "template/home_feed.php";
$template["posts"] = $dbh->getPostByID(1);  // for testing purposes

require("template/base.php");
