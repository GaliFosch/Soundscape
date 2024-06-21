<?php
require_once("bootstrap.php");
if(!checkLogin($dbh)){
    header("Location: create_track.php");
}

if(isset($_POST["title"])){
    $audio = uploadAudio("audio");
    if($audio === false){
        header("Location: create_track.php?error=1");
    }
    $img = uploadImage("img");
    if($img === false){
        $img = null;
    }
    if($dbh->addSingleTrack($_POST["title"], $audio, $img, $_SESSION["username"])){
        header("Location: profile.php");
    }else{
        header("Location: create_track.php?error=2");
    }
}