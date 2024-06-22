<?php

const STMT_ERR = 1;
const USER_NOT_FOUND = 2;
const USER_ACCESS_DISABLED = 3;
const WRONG_PASSWORD = 4;

const ALL = -1;

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

    public function isFollowing($follower, $followed){
        $query = "SELECT * FROM follow WHERE Follower = ? AND Following = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss",$follower, $followed);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows() != 0;
    }

    public function follow($follower, $followed){
        $usrFollowed = $this->getUserByUsername($followed);
        if($usrFollowed == false){
            return false;
        }
        $this->db->begin_transaction();
        try{
            $query = "INSERT INTO follow(Following, Follower) VALUES (?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $followed, $follower);
            $stmt->execute();

            $newValue = $usrFollowed["NumFollower"] + 1;
            $query = "UPDATE user
                        SET NumFollower = ?
                        WHERE Username = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $newValue, $followed);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (mysqli_sql_exception $exception) {
            $this->db->rollback();
            return false;
        }
    }

    public function unfollow($follower, $followed){
        $usrFollowed = $this->getUserByUsername($followed);
        if($usrFollowed == false || !$this->isFollowing($follower, $followed)){
            return false;
        }
        $this->db->begin_transaction();
        try{
            $query = "DELETE FROM follow WHERE Follower = ? AND Following = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $follower, $followed);
            $stmt->execute();

            $newValue = $usrFollowed["NumFollower"] - 1;
            $query = "UPDATE user
                        SET NumFollower = ?
                        WHERE Username = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $newValue, $followed);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (mysqli_sql_exception $exception) {
            $this->db->rollback();
            return false;
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

    public function getTrackByTitleAndAuthor($title, $author) {
        $query = "SELECT * FROM single_track WHERE Name = ? AND Creator = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ss', $title, $author);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getMatchingUsers($search_input, $nToShow, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM user 
                  WHERE Username LIKE CONCAT('%', ?, '%')";
        if ($nToShow != ALL) {
            $query .= " LIMIT ?, ?";
        }
        $stmt = $this->db->prepare($query);
        if ($nToShow != ALL) {
            $stmt->bind_param('sii', $search_input, $nToSkip, $nToShow);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMatchingTracks($search_input, $nToShow, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM single_track 
                  WHERE Name LIKE CONCAT('%', ?, '%')";
        if ($nToShow != ALL) {
            $query .= " LIMIT ?, ?";
        }
        $stmt = $this->db->prepare($query);
        if ($nToShow != ALL) {
            $stmt->bind_param('sii', $search_input, $nToSkip, $nToShow);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMatchingAlbums($search_input, $nToShow = ALL, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM playlist 
                  WHERE isAlbum = true 
                    AND Name LIKE CONCAT('%', ?, '%')";
        if ($nToShow != ALL) {
            $query .= " LIMIT ?, ?";
        }
        $stmt = $this->db->prepare($query);
        if ($nToShow != ALL) {
            $stmt->bind_param('sii', $search_input, $nToSkip, $nToShow);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getMatchingPlaylists($search_input, $nToShow = ALL, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM playlist 
                  WHERE isAlbum = false 
                    AND Name LIKE CONCAT('%', ?, '%')";
        if ($nToShow != ALL) {
            $query .= " LIMIT ?, ?";
        }
        $stmt = $this->db->prepare($query);
        if ($nToShow != ALL) {
            $stmt->bind_param('sii', $search_input, $nToSkip, $nToShow);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getLatestTracks($nToShow = ALL, $nToSkip = 0) {
        $query = "SELECT * 
                  FROM single_track
                  ORDER BY CreationDate DESC";
        if ($nToShow != ALL) {
            $query .= " LIMIT ?, ?";
        }
        $stmt = $this->db->prepare($query);
        if ($nToShow != ALL) {
            $stmt->bind_param("ii",  $nToSkip,$nToShow);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserLatestTracks($username, $nToShow = ALL){
        $query = "SELECT *
                    FROM single_track
                    WHERE Creator = ?
                    ORDER BY CreationDate DESC";
        if ($nToShow != ALL) {
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if ($nToShow != ALL) {
            $stmt->bind_param("si", $username, $nToShow);
        } else {
            $stmt->bind_param("s", $username);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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

    public function getUserLatestAlbums($username, $nToShow) {
        $query = "SELECT *
                  FROM playlist
                  WHERE Creator = ? AND isAlbum = true
                  ORDER BY CreationDate DESC";
        if ($nToShow != ALL) {
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if ($nToShow != ALL) {
            $stmt->bind_param("si", $username, $nToShow);
        } else {
            $stmt->bind_param("s", $username);
        }
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

    public function getUserLatestPlaylists($username, $nToShow) {
        $query = "SELECT *
                  FROM playlist
                  WHERE Creator = ? AND isAlbum = false
                  ORDER BY CreationDate DESC";
        if ($nToShow != ALL) {
            $query .= " LIMIT ?";
        }
        $stmt = $this->db->prepare($query);
        if ($nToShow != ALL) {
            $stmt->bind_param("si", $username, $nToShow);
        } else {
            $stmt->bind_param("s", $username);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPlaylistInfoByID($id) {
        $query = "SELECT *
                  FROM playlist
                  WHERE PlaylistID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getOrderedTracklistByPlaylistID($id) {
        $query = "SELECT *
                  FROM tracklist l, single_track t
                  WHERE l.TrackID = t.TrackID
                    AND l.PlaylistID = ?
                  ORDER BY l.position;";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getShuffledTracklistByPlaylistID($id) {
        $query = "SELECT *
                  FROM tracklist l, single_track t
                  WHERE l.TrackID = t.TrackID
                    AND l.PlaylistID = ?
                  ORDER BY RAND()";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserNotifications($username){
        $query = "SELECT * 
                FROM notification
                WHERE Receiver = ?
                ORDER BY NotificationTimestamp DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotification($id){
        $query = "SELECT * 
                FROM notification
                WHERE NotificationId = ?
                LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getAllGenres(){
        $query = "SELECT * 
                FROM genre
                ORDER BY GenreTag ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    
    public function removeNotification($id){
        $query = "DELETE FROM Notification
                    WHERE NotificationId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
    
    public function addSingleTrack($title, $audio, $duration, $img, $creator, $genres){
        $this->db->begin_transaction();
        try{
            $creation_date = date('Y-m-d H:i:s');
            $query = "INSERT INTO Single_Track(Name, AudioFile, TimeLength, CoverImage, CreationDate, Creator) VALUES (?,?,?,?,?,?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssssss', $title, $audio, $duration, $img, $creation_date, $creator);
            $stmt->execute();
            $id = $stmt->insert_id;
            foreach($genres as $genre){
                $query = "INSERT INTO belonging(GenreTag, TrackID) VALUES (?,?)";
                $stmt->prepare($query);
                $stmt->bind_param("si", $genre, $id);
                $stmt->execute();
            }
            $this->db->commit();
        }catch (mysqli_sql_exception $exception){
            $this->db->rollback();
            return false;
        }
        return true;
    }

    public function addPlaylist($title, $image, $is_album, $creator, $tracks_ids) {
        $this->db->begin_transaction();
        try {
            // Playlist instance insertion
            $date = date("Y-m-d");   // The current date
            $query = "INSERT INTO playlist(PlaylistID, Name, CoverImage, isAlbum, CreationDate, Creator, NumTracks, TimeLength)
                  VALUES (null, ?, ?, ?, ?, ?, 0, '00:00:00');";   // PlaylistID is auto-generated
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('ssiss', $title, $image, $is_album, $date, $creator);
            $stmt->execute();
            $playlist_id = mysqli_insert_id($this->db);   // The auto-generated ID of the tuple just inserted

            // Tracklist insertion
            $count = 1;
            foreach ($tracks_ids as $track_id) {
                $query = "INSERT INTO tracklist(PlaylistID, TrackID, position) VALUES (?, ?, ?);";
                $stmt = $this->db->prepare($query);
                $stmt->bind_param('iii', $playlist_id, $track_id, $count);
                $stmt->execute();
                $count++;
            }

            // Insert the number of tracks of the playlist
            $count--;
            $this->setTracksNumber($playlist_id, $count);

            // Compute and insert the total length of the playlist
            $this->setPlaylistTotalLength($playlist_id);

            $this->db->commit();
            return $playlist_id;  // The playlist has been inserted successfully and its ID is returned

        } catch (mysqli_sql_exception $exception){
            $this->db->rollback();
            return false;
        }
    }

    private function setTracksNumber($playlist_id, $tracks_num) {
        $query = "UPDATE playlist SET NumTracks = ? WHERE PlaylistID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ii', $tracks_num, $playlist_id);
        $stmt->execute();
    }

    private function setPlaylistTotalLength($playlist_id) {
        $query = "SELECT SUM(TimeLength)
                  FROM tracklist l, single_track t
                  WHERE (l.TrackID = t.TrackID) AND (l.PlaylistID = ?);";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $playlist_id);
        $stmt->execute();
        $length_in_seconds = $stmt->get_result()->fetch_row()[0];
        $formatted_length = convert_seconds_into_hhmmss_format($length_in_seconds);
        $query = "UPDATE playlist SET TimeLength = ? WHERE PlaylistID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('si', $formatted_length, $playlist_id);
        $stmt->execute();
    }

    private function getPlaylistNumTracks($playlist_id) {
        $query = "SELECT NumTracks FROM playlist WHERE PlaylistID = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('i', $playlist_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_row()[0];
    }

    public function addTracksToPlaylist($playlist_id, $tracks_ids) {
        $tracks_count = $this->getPlaylistNumTracks($playlist_id);
        foreach ($tracks_ids as $track_id) {
            $tracks_count++;
            $query = "INSERT INTO tracklist(PlaylistID, TrackID, position) VALUES (?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param('iii', $playlist_id, $track_id, $tracks_count);
            $insert_success = $stmt->execute();
            if (!$insert_success) {
                return false;
            }
        }
        // Update tracks count
        $this->setTracksNumber($playlist_id, $tracks_count);
        return true;
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

    public function getPersonalizedHomeFeed($userID, $nToShow, $nToSkip = 0) {
        //This query return the posts of the followed artists, posted in the last 7 days.
        $artistQuery = "SELECT post.PostID, post.Caption, post.NumLike, post.NumComments, post.TrackID, post.PlaylistId, post.Username
                    FROM post
                    INNER JOIN user ON post.Username = user.Username
                    WHERE post.Timestamp >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 7 DAY)
                    AND user.Username IN (
                        SELECT Following
                        FROM follow
                        WHERE Follower = ?
                    )
                    ORDER BY post.PostID DESC
                    LIMIT ?, ?";

        //This query returns the most liked posts of the last seven days
        $likedQuery = "SELECT post.PostID, post.Caption, post.NumLike, post.NumComments, post.TrackID, post.PlaylistId, post.Username
                    FROM post
                    INNER JOIN user ON post.Username = user.Username
                    WHERE user.Username IS NOT ?
                    AND post.Timestamp >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 7 DAY)
                    ORDER BY post.NumLike DESC
                    LIMIT ?, ?";
        
        $likedGenre = $this->getFavouriteGenres($userID);

        //This query returns random posts in which the song is of a genre generally listened by the user
        $genreQuery = "SELECT post.PostID, post.Caption, post.NumLike, post.NumComments, post.TrackID, post.PlaylistId, post.Username
                    FROM post
                    INNER JOIN user ON post.Username = user.Username
                    INNER JOIN belonging ON post.TrackID = belonging.TrackId
                    INNER JOIN $likedGenre ON belonging.GenreTag = likedGenre.GenreTag
                    WHERE user.Username IS NOT ?
                    AND post.Timestamp >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 7 DAY)
                    ORDER BY likedGenre.TrackCount DESC
                    LIMIT ?, ?";
        
        $finalQuery = "SELECT * FROM (
                            SELECT * FROM $artistQuery
                            UNION 
                            SELECT * FROM $likedQuery
                            UNION 
                            SELECT * FROM $genreQuery
                        ) ORDER BY RAND()";

        $stmt = $this->db->prepare($finalQuery);
        $stmt->bind_param("siisiisii", $userID, $nToShow, $nToSkip, $userID, $nToShow, $nToSkip, $userID, $nToShow, $nToSkip);
        if($stmt->execute()) {
            return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        } else {
            $this->getGeneralHomeFeed();
        }
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

    public function getFavouriteGenres($userID) {
        $query = "SELECT genre.GenreTag, COUNT(belonging.TrackID) AS TrackCount
                FROM belonging
                INNER JOIN genre ON belonging.GenreTag = genre.GenreTag
                WHERE belonging.TrackID IN (
                    SELECT post.TrackID
                    FROM post
                    WHERE Post.Usernanme = ?)
                GROUP BY genre.GenreTag
                ORDER BY TrackCount DESC";
        $stmt =  $this->db->prepare($query);
        $stmt->bind_param("s", $userID);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function addComment($text, $userID, $postID) {
        $timestamp = date('Y-m-d H:i:s');
        $query = "INSERT INTO comment (CommentText, CommentTimestamp, Username, PostID)
                    VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('sssi', $text, $timestamp,$userID, $postID);
        $stmt->execute();
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

    public function getTrackByName($trackName, $trackCreator) {
        $query = "SELECT AudioFile, Name, CoverImage, Creator
                FROM single_track
                WHERE Name = ? AND Creator = ?";
        $stmt =  $this->db->prepare($query);
        $stmt->bind_param('ss',$trackName, $trackCreator);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getPlaylistByName($trackName, $trackCreator) {
        $playlistQuery = "SELECT PlaylistID, Name, CoverImage, Creator, isAlbum
                FROM playlist 
                WHERE Name = ? AND Creator = ?";
        $tracklistQuery = "SELECT S.Name, S.CoverImage, S.Creator
                            FROM single_track as S
                            INNER JOIN tracklist as T ON S.TrackID = T.TrackID
                            INNER JOIN playlist as P ON P.PlaylistID = T.PlaylistID
                            WHERE P.Name = ? AND P.Creator = ?";
        $stmt =  $this->db->prepare($playlistQuery);
        $stmt->bind_param('ss',$trackName, $trackCreator);
        $stmt->execute();
        $playlist = $stmt->get_result()->fetch_assoc();
        $stmt =  $this->db->prepare($tracklistQuery);
        $stmt->bind_param('ss',$trackName, $trackCreator);
        $stmt->execute();
        $tracklist = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        
        return array('playlist'=> $playlist, 'songs' => $tracklist);
    }

    /*This code deals with the search suggestion */
    public function getSuggestedTracks($trackName) {
        $bind = '%'.$trackName.'%';
        $singleTrackQuery = "SELECT  Name, CoverImage, Creator
                            FROM single_track
                            WHERE Name LIKE ?";
        $playlistQuery = "SELECT  Name, CoverImage, Creator, IsAlbum, PlaylistID
                            FROM playlist
                            WHERE Name LIKE ?";
    
        $stmt =  $this->db->prepare($singleTrackQuery);
        $stmt->bind_param('s', $bind);
        $stmt->execute();
        $singleTrackResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
        $stmt =  $this->db->prepare($playlistQuery);
        $stmt->bind_param('s', $bind);
        $stmt->execute();
        $playlistResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    
        $result = array_merge($singleTrackResult, $playlistResult);
    
        return $result;
    }

    public function addPost($track, $text, $userID) {
        $timestamp = date('Y-m-d H:i:s');
        $query = "INSERT INTO post (Caption, TrackID, Username, Timestamp)
                    VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('ssss', $text, $track ,$userID, $timestamp);
        $stmt->execute();
    }

}