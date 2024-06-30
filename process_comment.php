<?php

require_once("bootstrap.php");

$postID = $_GET["post"];
$text = $_POST["comment-text"];
$user = $dbh->getUserByUsername($_SESSION["username"]);

$id = $dbh->addComment($text,$user["Username"],$postID);

$comment = $dbh->getCommentFromId($id);

