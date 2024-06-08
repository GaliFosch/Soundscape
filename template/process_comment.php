<?php

require_once("..\bootstrap.php");

$postID = $_GET["post"];
$text = $_POST["comment-text"];
$user = $dbh->getUserByUsername($_SESSION["username"]);

$dbh->addComment($text,$user["Username"],$postID);

header('Location: ../index.php?post='.$postID);
