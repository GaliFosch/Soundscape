<?php

require_once("bootstrap.php");

$template["title"] = "Soundscape - Post Creation";
$template["stylesheets"] = ["base.css", "post_creation.css"];
$template["content"] = "template/create_post.php";
$template["track"] = null;
$template["playlist"] = null;

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
        $type = $parts[2];
        if($type == "Track") {
            $template["track"] = $dbh->getTrackByName($trackName, $trackCreator);
        } else {
            $template["playlist"] = $dbh->getPlaylistByName($trackName, $trackCreator);
        }
        
    }    
}

/* $files = $_FILES['file'];

// Loop through each file
foreach ($files['name'] as $key => $value) {
  $tmp_name = $files['tmp_name'][$key];
  $name = $files['name'][$key];
  $size = $files['size'][$key];
  $type = $files['type'][$key];

  // Check if the file is an image
  if ($type == 'image/jpeg' || $type == 'image/png' || $type == 'image/gif') {
    // Move the file to the upload directory
    move_uploaded_file($tmp_name, 'upload/' . $name);
  }
}
?> */


require("template/base.php");