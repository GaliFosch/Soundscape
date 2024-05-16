<?php

require_once("bootstrap.php");

if(isset($_POST["username"], $_POST["password"])){
    $result = $dbh->login($_POST["username"], $_POST["password"]);
    if (($result == STMT_ERR) || ($result == USER_NOT_FOUND) || ($result == USER_ACCESS_DISABLED) || ($result == WRONG_PASSWORD)) {
        header("Location: login.php?error=${result}");
    } else {
        $_SESSION["username"] = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $_POST["username"]);
        $_SESSION["loginString"] = $result;
        header("Location: index.php");
    }
} else {
    echo "Post variables not set!";
}