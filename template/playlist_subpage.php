<main>
    <header id="playlist-header">
        <?php if (isset($template["playlist"]["CoverImage"])): ?>
            <img id="cover-image" src="<?php echo $template["playlist"]["CoverImage"]; ?>" alt="" />
        <?php else: ?>
            <img id="cover-image" src="images/song-cover-placeholder.png" alt="" />
        <?php endif; ?>
        <div class="playlist-details">
            <h1 id="title"><?php echo $template["playlist"]["Name"]; ?></h1>
            <h2 id="author"><?php echo $template["playlist"]["Creator"]; ?></h2>
            <?php $datetime = date_create($template["playlist"]["CreationDate"]); ?>
            <h3 id="date-and-length"><?php echo date_format($datetime,"Y-m-d") . " - " . $template["playlist"]["TimeLength"]; ?></h3>
        </div>
        <div id="controls">
            <a id="play-button" href="player.php?pid=<?php echo $template["playlist"]["PlaylistID"]; ?>&shuffle=false&pos=0&refresh=true" title="Listen to the album/playlist"><img src="images/play-icon.svg" alt="Play"/></a>
            <a href="player.php?pid=<?php echo $template["playlist"]["PlaylistID"]; ?>&shuffle=true&pos=0&refresh=true" title="Listen to the album/playlist in shuffle mode"><em id="shuffle-button" class="fa-solid fa-shuffle fa-2x" aria-hidden="true"></em></a>
            <?php if (isset($_SESSION["username"]) and ($template["playlist"]["Creator"] == $_SESSION["username"])): ?>
                <a href="add_tracks_to_playlist.php?pid=<?php echo $template["playlist"]["PlaylistID"]; ?>" title="Add tracks to the album/playlist"><em id="add-track-to-playlist-button" class="fa-solid fa-plus fa-2x" aria-hidden="true"></em></a>
            <?php endif; ?>
        </div>
    </header>
    <hr>
    <?php if (isset($_GET["error"])): ?>
        <?php if ($_GET["error"] == TRACK_REMOVAL_FAILED): ?>
            <p id="error-msg">Error: the removal of the track failed.</p>
        <?php endif; ?>
    <?php endif; ?>
    <div id="tracklist">
        <?php foreach ($template["tracklist"] as $track): ?>
            <div class="row">
                <a href="player.php?pid=<?php echo $template["playlist"]["PlaylistID"]; ?>&shuffle=false&pos=<?php echo ($track["Position"] - 1); ?>&refresh=true">
                    <div class="tracklist-item">
                        <p class="track-position"><?php echo $track["Position"]; ?></p>
                        <div class="track-details">
                            <strong class="track-title"><?php echo $track["Name"]; ?></strong>
                            <p class="author"><?php echo $track["Creator"]; ?></p>
                        </div>
                        <p class="track-length"><?php echo $track["TimeLength"]; ?></p>
                    </div>
                </a>
                <div class="track-options">
                    <?php if (isset($_SESSION["username"]) and ($template["playlist"]["Creator"] == $_SESSION["username"])): ?>
                        <a href="remove_track_from_playlist.php?trackid=<?php echo $track["TrackID"]; ?>&pid=<?php echo $template["playlist"]["PlaylistID"]; ?>" class="remove-track-button" aria-label="Remove this track from the album/playlist" title="Remove this track from the album/playlist"><em class="fa-solid fa-xmark" aria-hidden="true"></em></a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>
<script src="js/track_options.js"></script>
