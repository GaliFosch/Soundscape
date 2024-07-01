<?php

$_SESSION["selected-tracks-ids"] = array();

?>
<main>
    <header>
        <h1>Create a new album or playlist</h1>
    </header>
    <?php if (isset($_GET["error"])): ?>
        <?php if ($_GET["error"] == PLAYLIST_INSERTION_FAILED): ?>
            <p id="error-msg">Error: the album/playlist could not be created because its insertion in the database failed.</p>
        <?php endif; ?>
    <?php endif; ?>
    <form id="new-resource-form" action="process_playlist_creation.php" method="POST" enctype="multipart/form-data">
        <ul>
            <li>
                <!-- Playlist title -->
                <label for="title" hidden>Title: </label>
                <input type="text" name="title" id="title" placeholder="Title" required />
            </li>
            <li>
                <!-- Cover image -->
                <label for="image">Cover image: </label>
                <input type="file" name="image" id="image"/>
            </li>
            <li>
                <?php if (isset($_GET["error"])): ?>
                    <?php if ($_GET["error"] == MISSING_COLLECTION_TYPE): ?>
                        <p id="error-msg">Error: a collection type (Album or Playlist) must be selected.</p>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- Album or playlist -->
                <fieldset>
                    <legend>Collection type: </legend>
                    <div class="collection-option">
                        <input id="album-option" type="radio" name="collection-type" value="album" />
                        <label for="album-option">Album</label>
                    </div>
                    <div class="collection-option">
                        <input id="playlist-option" type="radio" name="collection-type" value="playlist" />
                        <label for="playlist-option">Playlist</label>
                    </div>
                </fieldset>
            </li>
        </ul>
    </form>
    <label for="track-search">Search and add tracks to your album or playlist:</label>
    <!-- Search bar -->
    <form id="track-search-form" action="#" method="GET" class="comment filter-by-selected-collection-type" autocomplete="off">
        <input id="track-search" type="search" name="track" placeholder="Search for song"/>
        <input id="add-track-button" type="button" value="Add" />
        <em class="fa-solid fa-plus" aria-hidden="true" title="Add track to the list of selected tracks"></em>
    </form>
    <!-- List of suggested tracks -->
    <div class="track-suggestions-section">
        <ul class="track-suggestions"></ul>
    </div>
    <!-- List of selected tracks -->
    <div id="selected-tracks">
    </div>
    <!-- Submit button -->
    <input type="submit" form="new-resource-form" value="Create" />
</main>
<script src="js/search_suggestions.js"></script>
<script src="js/add_track_to_tracklist.js"></script>