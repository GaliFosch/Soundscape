<?php

require_once("bootstrap.php");

$template["isUserLogged"] = checkLogin($dbh);

if(!isset($_GET["profile"])){
    if($template["isUserLogged"]){
        $template["profile"] = $dbh->getUserByUsername($_SESSION["username"]);
        $template["isProfileLogged"] = true;
    }else{
        header("Location: login.php");
    }
}else{
    $template["profile"] = $dbh->getUserByUsername($_GET["profile"]);
    if($template["profile"] == false){
        //TODO: ERRORE
    }
    $template["isProfileLogged"] = false;
    if($template["isUserLogged"]){
        if($_SESSION["username"] == $_GET["profile"]){
            $template["isProfileLogged"] = true;
        }
    }
}

$template["title"] = "Soundscape - {$template["profile"]["Username"]}";
$template["stylesheets"] = ["base.css", "profile.css"];
$template["content"] = "template/profile_temp.php";

require("template/base.php");