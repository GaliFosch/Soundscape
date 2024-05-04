<!-- Player -->
<main>
    <div class="song-data">
        <img id="song-cover" src="images/song-cover-placeholder.png" alt=""/>
        <strong id="song-title">Song title</strong>
        <em id="artist-name">Artist name</em>
    </div>
    <div class="progress-bar-wrapper">
        <p id="current-time-label"></p>
        <progress id="audio-progress-bar" value="0" max="1"></progress>
        <p id="missing-time-label"></p>
    </div>
    <audio id="audio-player" preload="metadata">
        <source src="audio/example_audio_file.mp3" type="audio/mpeg"/>
    </audio>
    <div id="audio-controls">
        <button id="rewind-button"><img src="images/rewind-icon.svg" alt="Rewind"/></button>
        <button id="skip-back-button"><img src="images/skip-back-icon.svg" alt="Skip Back"/></button>
        <button id="play-button"><img src="images/play-icon.svg" alt="Play"/></button>
        <button id="skip-forward-button"><img src="images/skip-forward-icon.svg" alt="Skip Forward"/></button>
        <button id="add-to-playlist-button"><img src="images/add-to-playlist-icon.svg" alt="Add song to playlist"/></button>
    </div>
</main>
<script src="js/player.js"></script>