<main>
    <header id="playlist-header">
        <?php if (isset($template["playlist"]["CoverImage"])): ?>
            <img id="cover-image" src="<?php echo $template["playlist"]["CoverImage"]; ?>" alt="" />
        <?php else: ?>
            <img id="cover-image" src="images/placeholder-image.jpg" alt="" />
        <?php endif; ?>
        <div class="playlist-details">
            <h1 id="title"><?php echo $template["playlist"]["Name"]; ?></h1>
            <h2 id="author"><?php echo $template["playlist"]["Creator"]; ?></h2>
            <h3 id="date-and-length"><?php echo "{$template["playlist"]["CreationDate"]} - {$template["playlist"]["TimeLength"]}"; ?></h3>
        </div>
        <div id="controls">
            <a href="player.php?pid=<?php echo $template["playlist"]["PlaylistID"]; ?>&shuffle=false&pos=0&refresh=true"><button id="play-button"><img src="images/play-icon.svg" alt="Play"/></button></a>
            <a href="player.php?pid=<?php echo $template["playlist"]["PlaylistID"]; ?>&shuffle=true&pos=0&refresh=true"><em id="shuffle-button" class="fa-solid fa-shuffle fa-2x"></em></a>
            <a href="add_tracks_to_playlist.php?pid=<?php echo $template["playlist"]["PlaylistID"]; ?>"><em id="add-track-to-playlist-button" class="fa-solid fa-plus fa-2x"></em></a>
        </div>
    </header>
    <hr>
    <section id="tracklist">
        <?php foreach ($template["tracklist"] as $track): ?>
            <section class="row">
                <a href="player.php?pid=<?php echo $template["playlist"]["PlaylistID"]; ?>&shuffle=false&pos=<?php echo ($track["Position"] - 1); ?>">
                    <section class="tracklist-item">
                        <p class="track-position"><?php echo $track["Position"]; ?></p>
                        <div class="track-details">
                            <strong class="track-title"><?php echo $track["Name"]; ?></strong>
                            <p class="author"><?php echo $track["Creator"]; ?></p>
                        </div>
                        <p class="track-length"><?php echo $track["TimeLength"]; ?></p>
                    </section>
                </a>
                <section class="track-options">
                    <a href="remove_track_from_playlist.php?trackid=<?php echo $track["TrackID"]; ?>&pid=<?php echo $template["playlist"]["PlaylistID"]; ?>" class="remove-track-button"><em class="fa-solid fa-xmark"></em></a>
                </section>
            </section>
        <?php endforeach; ?>
    </section>
</main>
<script src="js/track_options.js"></script>
