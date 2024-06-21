<?php
require_once("bootstrap.php");
if(!checkLogin($dbh)){
    header("Location: create_track.php");
}

if(isset($_POST["title"],$_POST["duration"])){
    $audio = uploadAudio("audio");
    if($audio === false){
        header("Location: create_track.php?error=1");
    }
    $img = uploadImage("img");
    if($img === false){
        $img = null;
    }

    $genres = null;
    if(isset($_POST["genres"])){
        $genres = $_POST["genres"];
    }

    if($dbh->addSingleTrack($_POST["title"], $audio, $_POST["duration"], $img, $_SESSION["username"], $genres)){
        header("Location: profile.php");
    }else{
        header("Location: create_track.php?error=2");
    }
}