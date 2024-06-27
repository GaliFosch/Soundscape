<?php

require_once("bootstrap.php");

$track = null;
$playlist = null;

//POST from general form
//checks images
if (isset($_POST["caption"])) {

    $imgArray = null;
    if ($_FILES['images']['error'] != 4) {
        $imgArray = uploadMultipleImages("images");
        if ($imgArray === false) {
            header('Location: post_creation.php?error=2');
            exit;
        } elseif ($imgArray == array(false)) {
            $imgArray = null;
        }
    }

    //checks post save
    if (isset(($_POST["track"]))) {
        $result = $dbh->addPost($_POST["track"], $_POST["caption"],  $imgArray, $_SESSION['username'], "track");
        if ($result!=null) {
            header('Location: single_post.php?id='.$result);
            exit;
        } else {
            header('Location: post_creation.php?error=4&post='.$result);
            exit;
        }
    } else if (isset(($_POST["playlist"]))) {
        $result = $dbh->addPost($_POST["playlist"], $_POST["caption"],  $imgArray, $_SESSION['username'], "playlist");
        print_r($result);
        if ($result!=null) {
            header('Location: single_post.php?id='.$result);
            exit;
        } else {
            header('Location: post_creation.php?error=3&post='.$result);
            exit;
        }
    } else {
        $result =$dbh->addPost(null, $_POST["caption"],  $imgArray, $_SESSION['username'], null);
        print_r($result);
        if ($result!=null) {
            header('Location: single_post.php?id='.$result);
            exit;
        } else {
            header('Location: post_creation.php?error=5');
            exit;
        }
    }

}
