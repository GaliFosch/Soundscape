<?php

require_once("bootstrap.php");

if (!checkLogin($dbh)) {
    header("Location: login.php");
}

$template["title"] = "Soundscape - Upload a new track";
$template["stylesheets"] = ["base.css", "new_resource_form.css"];
$template["content"] = "template/new_track_form.php";

require("template/base.php");