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
    if(isset($_SESSION['username'], $_SESSION['loginString'])){
        return $dbh->checkLogin($_SESSION['username'], $_SESSION['loginString']);
    }
    return false;
}

function uploadImage($file){
    if(!isset($_FILES[$file]) || $_FILES[$file]["error"] != UPLOAD_ERR_OK){
        return false;
    }
    $target_dir = "user_img/";
    $imageFileType = strtolower(pathinfo($_FILES[$file]["name"],PATHINFO_EXTENSION));
    $newFilename = hash('sha512', $_FILES[$file]["name"].uniqid(mt_rand(1,mt_getrandmax()))). "." . $imageFileType;
    $target_file = $target_dir . basename($newFilename);
    $uploadOk = 1;
    
    //check if image file is a actual image
    $check = getimagesize($_FILES[$file]["tmp_name"]);
    if($check !== false){
        $uploadOk = 1;
    }else{
        $uploadOk = 0;
    }
    //check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    //Check file size
    if ($_FILES[$file]["size"] > 50000000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    }
}

function uploadMultipleImages($files){
    if(!isset($_FILES[$files])){
        return false;
    }
    $target_dir = "user_img/";
    $results = [];
    $n = count($_FILES[$files]["name"]);
    for($i = 0; $i<=$n; $i++){
        if($_FILES[$files]["error"][$i] != UPLOAD_ERR_OK){
            $results[$i] = false;
            continue;
        }
        $imageFileType = strtolower(pathinfo($_FILES[$files]["name"][$i],PATHINFO_EXTENSION));
        $newFilename = hash('sha512', $_FILES[$files]["name"][$i].uniqid(mt_rand(1,mt_getrandmax()))). "." . $imageFileType;
        $target_file = $target_dir . basename($newFilename);
        $uploadOk = 1;
        //check if image file is a actual image
        $check = getimagesize($_FILES[$files]["tmp_name"][$i]);
        if($check !== false){
            $uploadOk = 1;
        }else{
            $uploadOk = 0;
        }
        //check if file already exists
        if (file_exists($target_file)) {
            $uploadOk = 0;
        }
        //Check file size
        if ($_FILES[$files]["size"][$i] > 50000000) {
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $results[$i] = false;
        } else {
            if (move_uploaded_file($_FILES[$files]["tmp_name"][$i], $target_file)) {
                $results[$i] = $target_file;
            } else {
                $results[$i] = false;
            }
        }
    }
    return $results;
}

function uploadAudio($file){
    if(!isset($_FILES[$file]) || $_FILES[$file]["error"] != UPLOAD_ERR_OK){
        return false;
    }
    $target_dir = "user_audio/";
    $audioFileType = strtolower(pathinfo($_FILES[$file]["name"],PATHINFO_EXTENSION));
    $newFilename = hash('sha512', $_FILES[$file]["name"].uniqid(mt_rand(1,mt_getrandmax()))). "." . $audioFileType;
    $target_file = $target_dir . basename($newFilename);
    $uploadOk = 1;

    //check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
    //Check file size
    if ($_FILES[$file]["size"] > 50000000) {
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($audioFileType != "mp3") {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return false;
    } else {
        if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
            return $target_file;
        } else {
            return false;
        }
    }
}

function convert_seconds_into_hhmmss_format($seconds) {
    /*
     * Code taken from: https://stackoverflow.com/a/3534705
     */
    $t = round($seconds);
    return sprintf('%02d:%02d:%02d', $t/3600, floor($t/60)%60, $t%60);
}
