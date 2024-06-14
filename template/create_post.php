<!--Direi di fare due pagine una per la scelta della canzone e una per la scrittura del post-->
<?php
$track = null;

if(isset($_GET["post"])) {
    $track = $_GET["post"];
    $artistID;
    if($trackID!=null) {
        $artistID = $track["Creator"];
        $artist = $dbh->getUserByUsername($artistID);
    }
}
?>

<em class="fa-solid fa-xmark close-focus"></em>

<form action="template/post_creation.php?track=<?php echo $track; ?>" method="POST">
    <label for="search-track">Search for a music you want to post about</label>
    <input id="search-bar" type="search-track" name="query"/>
    <input type="submit" value="Search"/>
</form>

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
    <p>Remove track</p>
<?php endif; ?>

<a href="template/post_creation.php">
    <button>
        <em class="fa-solid fa-forward"></em>
    </button>
</a>

