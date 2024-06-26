<?php

require_once("bootstrap.php");

if(!checkLogin($dbh)){
    echo "error";
    exit();
}

if(isset($_POST["caption"], $_POST["postID"])){
    $dbh->addComment($_POST["caption"],$_SESSION["username"],$_POST["postID"]);
    echo "ok";
    header("Location: single_post.php?id=".$_POST["postID"]);
}else{
    echo "error";
}
