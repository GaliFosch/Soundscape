<?php
require_once("bootstrap.php");

if(!checkLogin($dbh)){
    $result["error"] = 1;
    $result["user"] = [];
}else{
    $result["user"] = $dbh->getUserByUsername($_SESSION["username"]);
    $result["error"] = 0;
}

header('Content-Type: application/json');

echo json_encode($result);