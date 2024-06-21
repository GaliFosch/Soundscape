<?php

require_once("bootstrap.php");
require_once("utils/functions.php");

if(!checkLogin($dbh)){
    echo "false";
    exit();
}
if(isset($_GET["id"])){
    $not = $dbh->getNotification($_GET["id"]);
    if($not["Receiver"] != $_SESSION["username"]){
        echo "false";
    }
    elseif($dbh->removeNotification($_GET["id"])){
        echo "true";
    }else{
        echo "false";
    }
    exit();
}

echo "false";
