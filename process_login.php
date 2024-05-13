<?php

require_once("bootstrap.php");

if(isset($_POST["username"], $_POST["c_password"])){
    $result = $dbh->login($_POST["username"], $_POST["c_password"]);
    if($result != false){
        $_SESSION["username"] = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $_POST["username"]);
        $_SESSION["loginString"] = $result;
        header("Location: index.php");
    } else {
        header("Location: login.php?error=1");
    }
} 
echo "Post variables not set!";