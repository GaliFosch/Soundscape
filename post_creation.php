<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Post Creation";
$template["stylesheets"] = ["base.css", "post_creation.css"];
$template["content"] = "template/create_post.php";
$template["track"] = null;

if(isset(($_POST["caption"]))) {
    $dbh->addPost($_POST["track"], $_POST["caption"], $_SESSION['username']);
    header('Location: index.php');
    exit;
}

if (isset($_GET["track"])) {
    $str = $_GET["track"];
    if($str != "") {
        $parts = explode(" - ", $str);
        $trackName = $parts[0];
        $trackCreator = $parts[1];
        $template["track"] = $dbh->getTrackByName($trackName, $trackCreator);
    }    
}



require("template/base.php");