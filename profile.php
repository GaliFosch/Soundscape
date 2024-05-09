<?php

require_once("bootstrap.php");

if(!isset($_SESSION["user"])){
    header("Location: login.php");
}

$template["profile"] = $dbh->getUserByUsername($_SESSION["user"]["Username"]);
$template["title"] = "Soundscape - {$template["profile"]["Username"]}";
$template["style"] = "base.css";
$template["content"] = "template/profile_temp.php";

require("template/base.php");