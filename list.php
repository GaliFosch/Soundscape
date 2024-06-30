<?php

require_once("bootstrap.php");

$template["profile"] = $dbh->getUserByUsername($_GET["profile"]);
if ($_GET["t"] == "followers") {
    $template["title"] = "Soundscape - {$template["profile"]["Username"]}'s followers";
    $template["heading"] = "{$template["profile"]["Username"]}'s followers";
} elseif ($_GET["t"] == "following") {
    $template["title"] = "Soundscape - Users followed by {$template["profile"]["Username"]}";
    $template["heading"] = "users followed by {$template["profile"]["Username"]}";
}  else {
    $template["title"] = "Soundscape - {$_GET["t"]} by {$template["profile"]["Username"]}";
    $template["heading"] = "{$_GET["t"]} by {$template["profile"]["Username"]}";
}
$template["stylesheets"] = ["base.css", "list.css", "post.css", "comment.css"];
$template["content"] = "template/items_list.php";
$template["show-user-items"] = true;

require("template/base.php");
