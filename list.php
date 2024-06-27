<?php

require_once("bootstrap.php");

$template["profile"] = $dbh->getUserByUsername($_GET["profile"]);
$template["title"] = "Soundscape - {$_GET["t"]} by {$template["profile"]["Username"]}";
$template["stylesheets"] = ["base.css", "list.css", "post.css"];
$template["content"] = "template/items_list.php";
$template["show-user-items"] = true;

require("template/base.php");
