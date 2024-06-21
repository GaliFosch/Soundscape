<?php
require_once("bootstrap.php");

if(isset($_POST["username"], $_POST["c_password"], $_POST["email"], $_POST["biography"])){
    $img = uploadImage("image");
    if($img === false){
        $img = null;
    }
    $result = $dbh->register($_POST["username"], $_POST["c_password"], $_POST["email"], $_POST["biography"], $img);
    header("Location: login.php");
} else {
    echo "Post variables not set";
}
