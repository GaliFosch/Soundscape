<?php

require_once("bootstrap.php");

if(checkLogin($dbh)){
    header("Location: login.php");
}

$template["profile"] = $dbh->getUserByUsername($_SESSION["username"]);
$template["title"] = "Soundscape - {$template["profile"]["Username"]}";
$template["stylesheets"] = ["base.css", "index.css"];
$template["content"] = "template/profile_temp.php";

require("template/base.php");