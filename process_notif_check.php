<?php

require_once("bootstrap.php");

if(!checkLogin($dbh)){
    echo false;
}else{
    echo $dbh->thereAreNotifications($_SESSION["username"]);
}

