<?php

require_once("bootstrap.php");

$template["profile"] = $dbh->getUserByUsername($_SESSION["username"]);
$template["title"] = "Soundscape - {$_GET["t"]} by {$template["profile"]["Username"]}";
$template["stylesheets"] = ["base.css", "list.css"];
$template["content"] = "template/items_list.php";

require("template/base.php");
