<?php
require_once("bootstrap.php");

if(!checkLogin($dbh)){
    $result["message"] = "User not logged";
    $result["error"] = 1;
}elseif(isset($_POST["bio"])){
    $queryResult = $dbh->setBiography($_SESSION["username"], $_POST["bio"]);
    if($queryResult){
        $result["message"] = $dbh->getUserByUsername($_SESSION["username"])["Biography"];
        $result["error"] = 0;
    }else{
        $result["message"] = "Query failed";
        $result["error"] = 1;
    }
}else{
    $result["message"] = "bio variable not set";
    $result["error"] = 1;
}

header('Content-Type: application/json');

echo json_encode($result);