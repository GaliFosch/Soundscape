<?php

require_once("bootstrap.php");
require_once("utils/functions.php");

if(checkLogin($dbh)){
    if(isset($_GET["target"])){
        $res = $dbh->unfollow($_SESSION["username"], $_GET["target"]);
        if(!$res){
            echo "false";
        }else{
            echo "true";
        }
    }else{
        echo "false";
    }
}else{
    echo "false";
}