<header class="list-title">
    <h1>Add the track to playlist:</h1>
</header>
<main>
    <?php $playlists = $dbh->getUserLatestPlaylists($_SESSION["username"], ALL); ?>
    <form action="process_track_addition.php" method="POST" enctype="multipart/form-data">
        <?php $count = 0; ?>
        <?php foreach ($playlists as $playlist): ?>
            <section class="preview">
                <div class="radio-button-container">
                    <label for="playlist-<?php echo $count; ?>" hidden></label>
                    <input id="playlist-<?php echo $count; ?>" type="radio" name="playlist_id" value="<?php echo $playlist["PlaylistID"]; ?>" />
                </div>
                <section class="preview-info-box">
                    <?php if (isset($playlist["CoverImage"])): ?>
                        <img class="picture" src="<?php echo $playlist["CoverImage"]; ?>" alt=""/>
                    <?php else: ?>
                        <img class="picture" src="images/placeholder-image.jpg" alt=""/>
                    <?php endif; ?>
                    <div class="preview-info">
                        <h3 class="preview-title"><?php echo $playlist["Name"]; ?></h3>
                        <h3 class="author"><?php echo $playlist["Creator"]; ?></h3>
                    </div>
                </section>
            </section>
            <?php $count++; ?>
        <?php endforeach; ?>
        <input type="submit" value="Add" />
    </form>
</main>
