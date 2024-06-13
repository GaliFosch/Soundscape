<?php

require_once("..\bootstrap.php");

if (isset($_GET["post"])) {
    $postID = $_GET["post"];
    $userID = $_SESSION['username'];

    if(isset($userID)) {
        if($dbh->hasUserLiked($postID,$userID)) {
            if($dbh->removeLike($postID,$userID)) {
                echo "change";
            } 
        }else {
            $dbh->addLike($postID,$userID);
            echo "change";
        }
    } else {
        echo "Effettua il login";
    }
}
