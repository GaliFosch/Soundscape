<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Post Creation";
$template["stylesheets"] = ["base.css", "post_creation.css"];
$template["content"] = "template/create_post.php";
$template["track"] = null;
$template["playlist"] = null;
$template["type"] = null;

if(isset(($_POST["caption"]))) {
    $imgArray = null;
    if(isset(($_POST["images"]))) {
        $imgArray = $_POST["images"];
            foreach($imgArray as $image) {
                $image = uploadImage($image);
                if($image === false){
                    header('Location: post_creation.php?error=1');
                    exit;
                } 
            }        
    }

    if (isset(($_POST["track"]))) {
        if ($dbh->addPost($_POST["track"], $_POST["caption"],  $imgArray, $_SESSION['username'], "track")) {
            header('Location: post_creation.php?error=false');
            exit;
        } else {
            header('Location: post_creation.php?error=2');
            exit;
        }
    } else if (isset(($_POST["playlist"]))) {
        if ($dbh->addPost($_POST["playlist"], $_POST["caption"],  $imgArray, $_SESSION['username'], "playlist")) {
            header('Location: post_creation.php?error=false');
            exit;
        } else {
            header('Location: post_creation.php?error=3');
            exit;
        }
    }
}

if (isset($_GET["track"])) {
    $str = $_GET["track"];
    if ($str != "") {
        $parts = explode(" - ", $str);
        $trackName = $parts[0];
        $trackCreator = $parts[1];
        $type = $parts[2];
        if ($type == "Track") {
            $template["track"] = $dbh->getTrackByName($trackName, $trackCreator);
            $template["type"] = 'track';
        } else {
            $template["playlist"] = $dbh->getPlaylistByName($trackName, $trackCreator);
            $template["type"] = 'playlist';
        }
        
    }    
}

require("template/base.php");