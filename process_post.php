<?php

require_once("bootstrap.php");

$track = null;
$playlist = null;

//POST from general form
//checks images
if(isset($_POST["caption"])) {
    $imgArray = null;
    if(isset($_FILES["images"])) {
        $imgArray = uploadMultipleImages("images");
        if($imgArray === false){
            header('Location: post_creation.php?error=2');
            exit;
        } 
    }       
//checks post save
    if (isset(($_POST["track"]))) {
        if ($dbh->addPost($_POST["track"], $_POST["caption"],  $imgArray, $_SESSION['username'], "track")) {
            header('Location: post_creation.php?error=false');
            exit;
        } else {
            header('Location: post_creation.php?error=3');
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
    } else {
        if ($dbh->addPost(null, $_POST["caption"],  $imgArray, $_SESSION['username'], null)) {
            header('Location: post_creation.php?error=false');
            exit;
        } else {
            header('Location: post_creation.php?error=3');
            exit;
        }
    }
}
