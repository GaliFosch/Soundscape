<header>
    <?php if (isset($template["playlist"]["CoverImage"])): ?>
        <img src="<?php echo $template["playlist"]["CoverImage"]; ?>" alt="" />
    <?php else: ?>
        <img src="images/placeholder-image.jpg" alt="" />
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
    <hr>
    <section id="tracklist">
        <?php foreach ($template["tracklist"] as $track): ?>
            <a href="player.php?pid=<?php echo $template["playlist"]["PlaylistID"]; ?>&shuffle=false&pos=<?php echo ($track["position"] - 1); ?>">
                <section class="tracklist-item">
                    <p class="track-position"><?php echo $track["position"]; ?></p>
                    <div class="track-details">
                        <strong class="track-title"><?php echo $track["Name"]; ?></strong>
                        <p class="author"><?php echo $track["Creator"]; ?></p>
                    </div>
                    <p class="track-length"><?php echo $track["TimeLength"]; ?></p>
                    <section class="track-options">
                        <button class="remove-track-button"><em class="fa-solid fa-xmark"></em></button>
                    </section>
                </section>
            </a>
        <?php endforeach; ?>
    </section>
</header>
<script src="js/track_options.js"></script>
