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
    print_r($_FILES[$file]);
    if(!isset($_FILES[$file])){
        echo "fille";
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
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    }else{
        $uploadOk = 0;
        echo "File is not an image.";
    }
    //check if file already exists
    if (file_exists($target_file)) {       
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    //Check file size
    if ($_FILES[$file]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Sorry, only JPG, JPEG, PNG files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        return false;
    } else {
        if (move_uploaded_file($_FILES[$file]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES[$file]["name"])). " has been uploaded.";
            return $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.";
            return false;
        }
    }
}