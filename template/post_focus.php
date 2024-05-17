<?php

require_once("..\bootstrap.php");

$template["stylesheets"] = ["index.css"];

$postID = $_GET["post"];

$post = $dbh->getPostByID($postID)[0];
$user = $dbh->getPostAuthor($postID);
$track = $dbh->getSponsoredTrack($postID);
$artistID = $track["Creator"];
$artist = $dbh->getUserByUsername($artistID);
?>

<aside class="post-focus">
<em class="fa-solid fa-xmark close-focus"></em>
<h1>
    <?php if ($user["ProfileImage"] != null): ?>
        <img class="picture" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
    <?php else: ?>
        <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
    <?php endif; ?>
    <?php echo $user["Username"]; ?>
</h1>
<p><?php echo $post["Caption"]; ?></p>
<section class="music-box focus">
    <?php if ($track != null): ?>
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
    <?php endif; ?>
</section>

<section class="post-interaction focus">
    <a href="#"><em class="fa-regular fa-message focus"></em></a>
    <em class="fa-regular fa-heart focus"></em>
</section>

<section class="artist-info">
    <h2 class="info">Informazioni sull'artista</h2>
    <?php if ($artist["ProfileImage"] != null): ?>
        <img class="picture" src="<?php echo $artist["ProfileImage"]; ?>" alt="Artist profile image"/>
    <?php else: ?>
        <img class="picture" src="images/placeholder-image.jpg" alt="Artist profile image"/>
    <?php endif; ?>
    <em class="fa-solid fa-user-plus"></em>
    <em class="fa-solid fa-user-check"></em>
    <p><?php echo $artist["Username"]; ?></p>
    <p><?php echo $artist["Biography"]; ?></p>
<!--Outer section of music box-->
<script>
    var postFocus = document.querySelector("aside");
    var closeFocus = document.querySelector(".close-focus");
    closeFocus.addEventListener("click", () => {
    console.log("Grazie");
    postFocus.style.display =  "none";
    });
</script>
</aside>


