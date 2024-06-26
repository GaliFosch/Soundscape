<?php

require_once("..\bootstrap.php");

$template["stylesheets"] = ["post_focus.css"];

$postID = $_GET["post"];

$post = $dbh->getPostByID($postID);
$user = $dbh->getPostAuthor($postID);
$track = $dbh->getSponsoredTrack($postID);
$artistID;
if($track!=null) {
    $artistID = $track["Creator"];
    $artist = $dbh->getUserByUsername($artistID);
}
?>

<em class="fa-solid fa-xmark close-focus"></em>

<section class="upper-section-focus">
    <h1 class="user-info">
    <?php if ($user["ProfileImage"] != null): ?>
        <img class="profile-picture" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
    <?php else: ?>
        <img class="profile-picture" src="images/placeholder-image.jpg" alt="User profile image"/>
    <?php endif; ?>
    <?php echo $user["Username"]; ?>
    </h1>
    <p class="timestamp"><?php echo $post["PostTimestamp"]; ?></p>
</section>

<p><?php echo $post["Caption"]; ?></p>
<?php if ($track != null): ?>
    <section class="music-box focus">
            <?php if ($track["CoverImage"] != null): ?>
                <img class="song focus" src="<?php echo $track["CoverImage"]; ?>" alt="Song cover image"/>
            <?php else: ?>
                <img class="song focus" src="images/placeholder-image.jpg" alt="Song cover image"/>
            <?php endif; ?>
            <a href="player.php?trackid=<?php echo $track["TrackID"]; ?>" aria-label="Play track on player" title="Play track on player">
                <em class="fa-solid fa-play focus"></em></a>
            <section class="music-info focus">
                <p class="info focus"><strong><?php echo $track["Name"]; ?></strong></p>
                <p><?php echo $track["Creator"]; ?></p>
            </section>   
        
    </section>
<?php endif; ?>

<section class="post-interaction focus">
    <a href="#"><em class="fa-regular fa-message focus"></em></a>
    <?php if(isset($_SESSION['username'])): ?>
        <?php if($dbh->hasUserLiked($post['PostID'], $_SESSION['username'])): ?>
            <em class="fa-solid fa-heart fa-fw focus"></em>
        <?php else: ?>
            <em class="fa-regular fa-heart fa-fw focus"></em>
        <?php endif; ?>
    <?php else: ?>
        <em class="fa-regular fa-heart fa-fw focus"></em>
    <?php endif; ?>
</section>

<?php if ($track != null): ?>
<section class="artist-info">
    <h2 class="info">Informazioni sull'artista</h2>
    <?php if ($artist["ProfileImage"] != null): ?>
        <img class="artist-photo" src="<?php echo $artist["ProfileImage"]; ?>" alt="Artist profile image"/>
    <?php else: ?>
        <img class="artist-photo" src="images/placeholder-image.jpg" alt="Artist profile image"/>
    <?php endif; ?>
    <?php if (!$dbh->isFollowing($artist["Username"], $user["Username"])): ?>
        <em class="fa-solid fa-user-plus follow" id="follows - <?php echo $artist["Username"]; ?>"></em>
    <?php else: ?>
        <em class="fa-solid fa-user-check follow" id="follows - <?php echo $artist["Username"]; ?>"></em>
    <?php endif; ?>    
    <p class="artist-name"><?php echo $artist["Username"]; ?></p>
    <p class="artist-description"><?php echo $artist["Biography"]; ?></p>
    <?php endif; ?>
<!--Outer section of music box-->

