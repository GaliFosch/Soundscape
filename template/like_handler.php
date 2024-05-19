<?php

require_once("..\bootstrap.php");

$template["stylesheets"] = ["index.css"];

$postID = $_GET["post"];
$userID = $_SESSION['username'];

if($userID != null) {
    if($dbh->hasUserLiked($postID,$userID)) {
        if($dbh->removeLike($postID,$userID)) {
            echo "removed";
            //non so se ci dovrei mettere qualcosa qua
        } else {
            $dbh->addLike($postID,$userID);
            echo "added";
        }
    }
} else {
    echo "Effettua il login";
}

