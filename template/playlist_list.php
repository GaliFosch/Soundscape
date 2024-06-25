<header class="list-title">
    <h1>Add the track to playlist:</h1>
</header>
<main>
    <?php $playlists = $dbh->getUserLatestPlaylists($_SESSION["username"], ALL); ?>
    <form action="process_track_addition.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Choose a playlist: </legend>
            <?php $count = 0; ?>
            <?php foreach ($playlists as $playlist): ?>
                <div class="preview">
                    <label for="playlist-<?php echo $count; ?>" hidden><?php echo $playlist["Name"]; ?></label>
                    <input id="playlist-<?php echo $count; ?>" type="radio" name="playlist_id" value="<?php echo $playlist["PlaylistID"]; ?>" />
                    <section class="preview-info-box">
                        <?php if (isset($playlist["CoverImage"])): ?>
                            <img class="picture" src="<?php echo $playlist["CoverImage"]; ?>" alt=""/>
                        <?php else: ?>
                            <img class="picture" src="images/placeholder-image.jpg" alt=""/>
                        <?php endif; ?>
                        <div class="preview-info">
                            <h2 class="preview-title"><?php echo $playlist["Name"]; ?></h2>
                            <h3 class="author"><?php echo $playlist["Creator"]; ?></h3>
                        </div>
                    </section>
                </div>
                <?php $count++; ?>
            <?php endforeach; ?>
        </fieldset>
        <input type="submit" value="Add" />
    </form>
</main>
