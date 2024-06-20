<?php
require_once("bootstrap.php");
if(!checkLogin($dbh)){
    header("Location: new_track_form.php");
}

if(isset($_POST["title"])){
    $audio = uploadAudio("audio");
    if($audio === false){
        header("Location: new_track_form.php?error=1");
    }
    $img = uploadImage("img");
    if($img === false){
        $img = null;
    }
    if($dbh->addSingleTrack($_POST["title"], $audio, $img, $_SESSION["username"])){
        header("Location: profile.php");
    }else{
        header("Location: new_track_form.php?error=2");
    }
}