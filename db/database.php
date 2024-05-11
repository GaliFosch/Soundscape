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

    public function getMatchingTracks($search_input) {
        $query = "SELECT * FROM single_track WHERE Name LIKE CONCAT('%', ?, '%')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $search_input);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMatchingAlbums($search_input) {
        $query = "SELECT * FROM playlist WHERE isAlbum = true AND Name LIKE CONCAT('%', ?, '%')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $search_input);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMatchingPlaylists($search_input) {
        $query = "SELECT * FROM playlist WHERE isAlbum = false AND Name LIKE CONCAT('%', ?, '%')";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $search_input);
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

    public function getLatestAlbums($n) {
        $query = "SELECT * FROM playlist
                  WHERE isAlbum = true
                  ORDER BY CreationDate DESC 
                  LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestPlaylists($n) {
        $query = "SELECT * FROM playlist
                  WHERE isAlbum = false
                  ORDER BY CreationDate DESC 
                  LIMIT ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $n);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

}