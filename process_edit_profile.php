<?php
require_once("bootstrap.php");

if(!checkLogin($dbh)){
    echo "error: User not Logged";
    exit();
}

if(isset($_POST["bio"])){
    $result = $dbh->setBiography($_SESSION["username"], $_POST["bio"]);
    echo $result;
}else{
    echo "error: bio variable not set";
}