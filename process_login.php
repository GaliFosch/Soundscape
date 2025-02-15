<?php

require_once("bootstrap.php");

if(isset($_POST["username"], $_POST["c_password"])){
    $result = $dbh->login($_POST["username"], $_POST["c_password"]);
    if (($result == STMT_ERR) || ($result == USER_NOT_FOUND) || ($result == USER_ACCESS_DISABLED) || ($result == WRONG_PASSWORD)) {
        header("Location: login.php?error={$result}");
    } else {
        $_SESSION["username"] = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $_POST["username"]);
        setcookie("logged_user", $_POST["username"], 0);
        $_SESSION["loginString"] = $result;
        header("Location: index.php");
    }
} else {
    echo "Post variables not set!";
}