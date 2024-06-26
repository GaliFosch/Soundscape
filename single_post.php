<?php

require_once("bootstrap.php");

if(empty($_GET["id"])){
    header("Location: index.php");
}

$template["title"] = "Soundscape - Post";
$template["stylesheets"] = ["base.css", "singlePost.css"];
$template["content"] = "template/singlePost_templ.php";

$template["post"] = $dbh->getPostByID($_GET["id"]);
if(empty($template["post"])){
    header("Location: index.php");
}
$template["author"] = $dbh->getUserByUsername($template["post"]["Username"]);
if(!empty($template["post"]["TrackID"])){
    $template["track"] = $dbh->getTrackByID($template["post"]["TrackID"]);
}elseif(!empty($template["post"]["PlaylistID"])){
    $template["playlist"] = $dbh->getPlaylistInfoByID($template["post"]["PlaylistID"]);
}

require("template/base.php");