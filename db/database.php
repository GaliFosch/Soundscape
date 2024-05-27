<?php

const STMT_ERR = 1;
const USER_NOT_FOUND = 2;
const USER_ACCESS_DISABLED = 3;
const WRONG_PASSWORD = 4;

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
            return STMT_ERR; //Error in the prepare function
        }
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if($stmt->num_rows() != 1){
            return USER_NOT_FOUND; //User do not exists
        }
        $stmt->bind_result($email,$db_password, $salt);
        $stmt->fetch();
        if($this->isUserDisabled($username)){
            // $subject = "Multipli Tentati accessi sull'account Soundscape";
            // $message = "Il tuo account SoundScape è stato sospeso temporaneamente.\nVerrà riattivato in 2 ore.";
            // mail($email, $subject, $message);
            return USER_ACCESS_DISABLED; //User is disabled
        }
        $password = hash('sha512', $password.$salt);
        if($db_password == $password){
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
            return hash('sha512', $password.$user_browser);
        } else {
            $now = time();
            $query = "INSERT INTO LoginAttempt(username, time) VALUES ( ? , ? )";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $username, $now);
            $stmt->execute();
            return WRONG_PASSWORD;
        }

    }

    private function isUserDisabled($username){
        $now = time();
        $valid_attempts = $now - (2 * 60 * 60);
        $query = "SELECT Time FROM LoginAttempt WHERE Username = ? AND time > '$valid_attempts'";
        if($stmt = $this->db->prepare($query)){
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            if($stmt->num_rows > 5){
                return true;
            }else{
                return false;
            }
        }
    }

    public function register($username, $password, $email, $biography, $image){
        if($this->getUserByUsername($username) != false){
            return false;//username already in use
        }
        $salt = hash('sha512', uniqid(mt_rand(1,mt_getrandmax()), true));
        $password = hash('sha512', $password.$salt);
        $query = "INSERT INTO user(username, password, salt, email, biography, profileimage) VALUES(?,?,?,?,?,?)";
        $stmt = $this->db->prepare($query);
        if($stmt == false){
            return false;//Error into prepare function
        }
        $stmt->bind_param("ssssss", $username, $password, $salt, $email, $biography, $image);
        $stmt->execute();
        return true;
    }

    public function getUserByUsername($username){
        $query = "SELECT Username, Biography, ProfileImage, Email, NumFollower, NumFollowing 
                FROM user 
                WHERE Username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows==0){
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

    public function getBestUserPosts($username, $nToShow){
        $query = "SELECT * 
                    FROM post
                    WHERE Username = ?
                    ORDER BY NumLike + NumComments DESC
                    LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $username, $nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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

    public function getMatchingUsers($search_input, $nToShow, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM user 
                  WHERE Username LIKE CONCAT('%', ?, '%')
                  LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $search_input, $nToSkip, $nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMatchingTracks($search_input, $nToShow, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM single_track 
                  WHERE Name LIKE CONCAT('%', ?, '%')
                  LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $search_input, $nToSkip, $nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMatchingAlbums($search_input, $nToShow, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM playlist 
                  WHERE isAlbum = true 
                    AND Name LIKE CONCAT('%', ?, '%')
                  LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $search_input, $nToSkip, $nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMatchingPlaylists($search_input, $nToShow, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM playlist 
                  WHERE isAlbum = false 
                    AND Name LIKE CONCAT('%', ?, '%')
                  LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $search_input, $nToSkip, $nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestTracks($nToShow, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM single_track
                  ORDER BY CreationDate DESC
                  LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ii",  $nToSkip,$nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserLatestTracks($username, $nToShow){
        $query = "SELECT TrackID, Name, CoverImage
                    FROM single_track
                    WHERE Creator = ?
                    ORDER BY CreationDate DESC
                    LIMIT ?";
        $stm = $this->db->prepare($query);
        $stm->bind_param("si", $username, $nToShow);
        $stm->execute();
        return $stm->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestAlbums($nToShow, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM playlist
                  WHERE isAlbum = true
                  ORDER BY CreationDate DESC 
                  LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $nToSkip,$nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserLatestAlbums($username, $nToShow, $nToSkip = 0) {
        $query = "SELECT PlaylistID, Name, CoverImage
                  FROM playlist
                  WHERE Creator = ? AND isAlbum = true
                  ORDER BY CreationDate DESC 
                  LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $username, $nToSkip, $nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestPlaylists($nToShow, $nToSkip = 0) {
        $query = "SELECT *
                  FROM playlist
                  WHERE isAlbum = false
                  ORDER BY CreationDate DESC 
                  LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $nToSkip, $nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function getUserLatestPlaylists($username, $nToShow, $nToSkip = 0) {
        $query = "SELECT PlaylistID, Name, CoverImage
                  FROM playlist
                  WHERE Creator = ? AND isAlbum = false
                  ORDER BY CreationDate DESC 
                  LIMIT ?, ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sii', $username, $nToSkip, $nToShow);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function hasUserLiked($postID, $userID) {
        $query =    "SELECT *
                    FROM postlike
                    WHERE EXISTS (SELECT * 
                                    FROM postlike 
                                    WHERE PostID = ?
                                    AND Username = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is',$postID,$userID);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function removeLike($postID, $userID) {
        $query =    "DELETE 
                    FROM postlike
                    WHERE PostID = ?
                    AND Username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is',$postID,$userID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function addLike($postID, $userID) {
        $query = "INSERT INTO postlike (PostID, Username) 
                    VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('is',$postID,$userID);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getPersonalizedHomeFeed() {

    }

    public function getGeneralHomeFeed() {
        $query = "SELECT post.PostID, post.Caption, post.NumLike, post.NumComments, post.TrackID, post.PlaylistId, post.Username
                    FROM post
                    INNER JOIN user ON post.Username = user.Username
                    ORDER BY user.NumFollower DESC";
        $stmt =  $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

    }

    public function getAllComments($postID) {
        $query = "SELECT CommentText, Username
                    FROM comment
                    WHERE PostID = ?
                    ORDER BY CommentTimestamp";
        $stmt =  $this->db->prepare($query);
        $stmt->bind_param('i',$postID);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllLikes($postID) {
        $query = "SELECT postlike.Username, user.ProfileImage
                        FROM postlike
                        INNER JOIN user ON postlike.Username = user.Username
                        WHERE postlike.PostID = ?";
        $stmt =  $this->db->prepare($query);
        $stmt->bind_param('i',$postID);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            }
}