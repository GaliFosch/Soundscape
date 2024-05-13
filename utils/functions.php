<?php

function sec_session_start(){
    $session_name = "sec_session_id";
    $secure = false; //true if using https, false if using http
    $httponly = true; // Block reading from js
    ini_set('session.use_only_cookies', 1);
    $cookieParams = session_get_cookie_params();
    session_set_cookie_params(
        $cookieParams["lifetime"], 
        $cookieParams["path"], 
        $cookieParams["domain"], 
        $secure, 
        $httponly);
    session_name($session_name);
    session_start();
    session_regenerate_id();
}

function checkLogin($dbh){
    if(isset($_SESSION['Username'], $_SESSION['login_string'])){
        return $dbh->checkLogin($_SESSION['Username'], $_SESSION['login_string']);
    }
    return false;
}