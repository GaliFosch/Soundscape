<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Post Creation";
$template["stylesheets"] = ["base.css", "post_creation.css", "search_suggestions.css"];
$template["content"] = "template/create_post.php";
$template["track"] = null;
$template["playlist"] = null;
$template["type"] = null;

if (isset($_GET["track"])) {
    $str = $_GET["track"];
    if ($str != "") {
        $parts = explode(" - ", $str);
      
        $trackName = $parts[0];
        $trackCreator = $parts[1];
        $type = $parts[2];
        if($trackName==null||$trackCreator==null) {
            header("Location: post_creation.php?error=1");
            exit;
        }
        if ($type == "Track") {
            $template["track"] = $dbh->getTrackByName($trackName, $trackCreator);
            $template["type"] = 'track';
        } else {
            $template["playlist"] = $dbh->getPlaylistByName($trackName, $trackCreator);;
            $template["type"] = 'playlist';
        }
        
    } else {
        header("Location: post_creation.php?error=1");
    }
    if($template["track"]==null && $template["playlist"]==null) {
        header("Location: post_creation.php?error=1");
    }
}

require("template/base.php");