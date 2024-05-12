<?php

require_once("bootstrap.php");

if(!empty($_POST["username"]) && !empty($_POST["password"])){
    $user = $dbh->login($_POST["username"], $_POST["password"]);
    if($user != false){
        $_SESSION["user"] = $user;
        header("Location: index.php");
    }
}

$template["title"] = "Soundscape - Login";
$template["style"] = "base.css";
$template["content"] = "template/login_templ.php";

require("template/base.php");