<!-- Player -->
<main>
    <?php
        if (isset($template["track"])) {
            $track = $template["track"];
        } else if (isset($template["tracklist"])) {
            $track = $template["tracklist"][$template["pos"]];
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
            <source src="<?php echo $track["AudioFile"]; ?>" type="audio/mpeg"/>
        <?php endif; ?>
    </audio>
    <div id="audio-controls">
        <?php if (isset($track)): ?>
            <button id="rewind-button"><img src="images/rewind-icon.svg" alt="Rewind"/></button>
        <?php else: ?>
            <button id="rewind-button" class="disabled"><img src="images/rewind-icon.svg" alt="Rewind"/></button>
        <?php endif; ?>
        <?php if (isset($template["pos"]) && ($template["pos"] != 0)): ?>
            <a id="skip-back-button" href="player.php?pid=<?php echo $template["playlist_id"]; ?>&shuffle=<?php echo $template["shuffle"]; ?>&pos=<?php echo (((int) $template["pos"]) - 1); ?>"><img src="images/skip-back-icon.svg" alt="Skip Back"/></a>
        <?php else: ?>
            <a id="skip-back-button" class="disabled" href="#"><img src="images/skip-back-icon.svg" alt="Skip Back"/></a>
        <?php endif; ?>
        <?php if (isset($track)): ?>
            <button id="play-button"><img src="images/play-icon.svg" alt="Play"/></button>
        <?php else: ?>
            <button id="play-button" class="disabled"><img src="images/play-icon.svg" alt="Play"/></button>
        <?php endif; ?>
        <?php if (isset($template["pos"]) && ($template["pos"] != count($template["tracklist"]) - 1)): ?>
            <a id="skip-forward-button" href="player.php?pid=<?php echo $template["playlist_id"]; ?>&shuffle=<?php echo $template["shuffle"]; ?>&pos=<?php echo (((int) $template["pos"]) + 1); ?>"><img src="images/skip-forward-icon.svg" alt="Skip Forward"/></a>
        <?php else: ?>
            <a id="skip-forward-button" class="disabled" href="#"><img src="images/skip-forward-icon.svg" alt="Skip Forward"/></a>
        <?php endif; ?>
        <?php if (!isset($_SESSION["username"])): ?>
            <a id="add-to-playlist-button" href="login.php"><img src="images/add-to-playlist-icon.svg" alt="Log-in to add the track to your playlists"/></a>
        <?php elseif (isset($track) && isset($track["TrackID"])): ?>
            <a id="add-to-playlist-button" href="playlist_choice.php?trackid=<?php echo $track["TrackID"]; ?>"><img src="images/add-to-playlist-icon.svg" alt="Add song to playlist"/></a>
        <?php else: ?>
            <a id="add-to-playlist-button" class="disabled" href="#"><img src="images/add-to-playlist-icon.svg" alt="Log-in to add the track to your playlists"/></a>
        <?php endif; ?>
    </div>
</main>
<script src="js/player.js"></script>