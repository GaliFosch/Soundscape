<?php
require_once("bootstrap.php");
if(isset($_POST["username"], $_POST["c_password"], $_POST["email"], $_POST["biography"])){
    $result = $dbh->register($_POST["username"], $_POST["c_password"], $_POST["email"], $_POST["biography"], $_POST["image"]);
    header("Location: login.php");
} else {
    echo "Post variables not set";
}
