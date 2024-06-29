<?php
require_once("bootstrap.php");

if(!checkLogin($dbh)){
    $result["message"] = "User not logged";
    $result["error"] = 1;
}elseif(!empty($_FILES["img"])){
    $img = uploadImage("img");
    if($img === false){
        $queryResult = $dbh->setProfileImage($_SESSION["username"], $img);
        if($queryResult){
            $result["message"] = $dbh->getUserByUsername($_SESSION["username"])["ProfileImage"];
            $result["error"] = 0;
        }else{
            $result["message"] = "Query failed";
            $result["error"] = 1;
        }
    }else{
        $result["message"] = "Uploading of the image failed";
        $result["error"] = 1;
    }
}else{
    $result["message"] = "bio variable not set";
    $result["error"] = 1;
}

header('Content-Type: application/json');

echo json_encode($result);