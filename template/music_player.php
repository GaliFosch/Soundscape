<!-- Player -->
<main>
    <?php
        if (isset($template["track"])) {
            $track = $template["track"];
        } else if (isset($template["tracklist"])) {
            $track = $template["tracklist"][0];
        }
    ?>
    <div class="song-data">
        <?php if (isset($track) && isset($track["CoverImage"])): ?>
            <img id="song-cover" src="<?php echo $track["CoverImage"]; ?>" alt=""/>
        <?php else: ?>
            <img id="song-cover" src="images/song-cover-placeholder.png" alt=""/>
        <?php endif; ?>
        <?php if (isset($track)): ?>
            <strong id="song-title"><?php echo $track["Name"]; ?></strong>
            <em id="artist-name"><?php echo $track["Creator"]; ?></em>
        <?php else: ?>
            <strong id="song-title">Song title</strong>
            <em id="artist-name">Artist name</em>
        <?php endif; ?>
    </div>
    <div class="progress-bar-wrapper">
        <p id="current-time-label"></p>
        <progress id="audio-progress-bar" value="0" max="1"></progress>
        <p id="missing-time-label"></p>
    </div>
    <audio id="audio-player" preload="metadata">
        <?php if (isset($track)): ?>
            <source src="audio/<?php echo $track["AudioFile"]; ?>" type="audio/mpeg"/>
        <?php endif; ?>
    </audio>
    <div id="audio-controls">
        <button id="rewind-button"><img src="images/rewind-icon.svg" alt="Rewind"/></button>
        <?php if (isset($template["pos"]) && ($template["pos"] != 0)): ?>
            <a href="player.php?pid=<?php echo $template["playlist_id"]; ?>&shuffle=<?php echo $template["shuffle"]; ?>&pos=<?php echo (((int) $template["pos"]) - 1); ?>"><button id="skip-back-button"><img src="images/skip-back-icon.svg" alt="Skip Back"/></button></a>
        <?php else: ?>
            <button id="skip-back-button"><img src="images/skip-back-icon.svg" alt="Skip Back"/></button>
        <?php endif; ?>
        <button id="play-button"><img src="images/play-icon.svg" alt="Play"/></button>
        <?php if (isset($template["pos"]) && ($template["pos"] != count($template["tracklist"]) - 1)): ?>
            <a href="player.php?pid=<?php echo $template["playlist_id"]; ?>&shuffle=<?php echo $template["shuffle"]; ?>&pos=<?php echo (((int) $template["pos"]) + 1); ?>"><button id="skip-forward-button"><img src="images/skip-forward-icon.svg" alt="Skip Forward"/></button></a>
        <?php else: ?>
            <button id="skip-forward-button"><img src="images/skip-forward-icon.svg" alt="Skip Forward"/></button>
        <?php endif; ?>
        <button id="add-to-playlist-button"><img src="images/add-to-playlist-icon.svg" alt="Add song to playlist"/></button>
    </div>
</main>
<script src="js/player.js"></script>