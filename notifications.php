<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Notifications";
$template["stylesheets"] = ["base.css", "notification.css"];
$template["content"] = "template/notification_templ.php";
$template["notifications"] = $dbh->getUserNotifications($_SESSION["username"]);
require("template/base.php");
