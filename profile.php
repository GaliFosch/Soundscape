<?php

require_once("bootstrap.php");

if(!isset($_GET["profile"])){
    if(!checkLogin($dbh)){
        $template["profile"] = $dbh->getUserByUsername($_SESSION["username"]);
        $template["isLogged"] = true;
    }else{
        header("Location: login.php");
    }
}else{
    $template["profile"] = $dbh->getUserByUsername($_GET["profile"]);
    if($template["profile"] == false){
        //TODO: ERRORE
    }
    $template["isLogged"] = false;
}

$template["title"] = "Soundscape - {$template["profile"]["Username"]}";
$template["stylesheets"] = ["base.css", "profile.css"];
$template["content"] = "template/profile_temp.php";

require("template/base.php");