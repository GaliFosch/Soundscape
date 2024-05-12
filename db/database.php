<?php

class DatabaseHelper {

    private $db;

    /**
     * {@link DatabaseHelper} constructor
     * @param $server_name: the name of the server on which the DB is hosted
     * @param $username
     * @param $password
     * @param $db_name: name of the DB to connect to
     */
    public function __construct($server_name, $username, $password, $db_name) {
        // Open connection to DB
        $this->db = new mysqli($server_name, $username, $password, $db_name);
        if ($this->db->connect_error) {
            // Could not connect to DB; terminate script execution
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    public function checkLogin($username, $login_string){
        $user_browser = $_SERVER['HTTP_USER_AGENT'];
        $query = "SELECT Password FROM User WHERE username = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        if($stmt==false){
            return false; //Prepare function error
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows != 1){
            return false; //User not found
        }
        $stmt->bind_result($password);
        $stmt->fetch();
        $login_check = hash("sha512", $password.$user_browser);
        if($login_check == $login_string){
            return true;
        }
        return false;
    }

    public function login($username, $password){
        $query = "SELECT Email, Password, Salt FROM User WHERE Username = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        if($stmt == false){
            return false; //Error in the prepare function
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($email,$db_password, $salt);
        $stmt->fetch();
        if($stmt->num_rows != 1){
            return false; //User do not exists
        }
        if($this->isUserDisabled($username)){
            //TODO: invia mail per avvisare l'utente
            return false; //User is disabled
        }
        $password = hash('sha512', $password.$salt);
        if($db_password == $password){
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            return hash('sha512', $password.$user_browser);
        } else {
            $now = time();
            $query = "INSERT INTO LoginAttempts(username, time) VALUES (?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return false;
        }

    }

    private function isUserDisabled($username){
        $now = time();
        $valid_attempts = $now - (2 * 60 * 60);
        $query = "SELECT Time FROM LoginAttempts WHERE Username = ? AND time > '$valid_attempts'";
        if($stmt = $this->db->prepare($query)){
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 5){
                return false;
            }else{
                return true;
            }
        }
    }

    public function getUserByUsername($username){
        $query = "SELECT Username, Biography, ProfileImage, Email, NumFollower, NumFollowing 
                FROM user 
                WHERE Username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows===0){
            return false;
        }
        return $result->fetch_assoc();
    }

    public function getPostByID($postID) {
        $query = "SELECT * FROM post WHERE PostID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPostAuthor($postID) {
        $query = "SELECT u.Username, ProfileImage FROM post p, user u WHERE (p.Username = u.Username) AND (p.PostID = ?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getSponsoredTrack($postID) {
        $query = "SELECT * FROM post p, single_track t WHERE (p.TrackID = t.TrackID) AND (p.PostID = ?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getTrackByID($trackID) {
        $query = "SELECT * FROM single_track WHERE TrackID = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $trackID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getMatchingUsers($search_input) {
        $query = "SELECT * FROM user WHERE Username LIKE CONCAT('%', ?, '%')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $search_input);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

}