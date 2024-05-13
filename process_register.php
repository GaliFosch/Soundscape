<?php
require_once("bootstrap.php");
if(isset($_POST["username"], $_POST["c_password"], $_POST["email"], $_POST["biography"])){
    echo $_POST["c_password"];
    $result = $dbh->register($_POST["username"], $_POST["c_password"], $_POST["email"], $_POST["biography"], $_POST["image"]);
}else{
    echo "error";
}