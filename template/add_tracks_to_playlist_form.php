<?php

$_SESSION["selected-tracks-ids"] = array();

$is_album = $dbh->isCollectionAnAlbum($template["playlist_id"]);
if ($is_album) {
    $result_filtering_class = "user-tracks-only";
} else {
    $result_filtering_class = "tracks-only";
}

?>
<main>
    <label id="page-title" for="track-search">Search and add tracks to your album or playlist:</label>
    <!-- Search bar -->
    <?php if (isset($_GET["error"])): ?>
        <?php if ($_GET["error"] == MISSING_PLAYLIST_ID): ?>
            <p id="error-msg">Error: the track could not be added because the playlist could not be identified.</p>
        <?php elseif ($_GET["error"] == TRACK_ADDITION_FAILED): ?>+
            <p id="error-msg">Error: the addition of the track to the playlist failed.</p>
        <?php endif; ?>
    <?php endif; ?>
    <form id="track-search-form" action="process_track_addition.php?pid=<?php echo $template["playlist_id"]; ?>" method="POST" class="comment <?php echo $result_filtering_class; ?>" autocomplete="off">
        <input id="track-search" type="search" name="track" placeholder="Search for song"/>
        <input id="add-track-button" type="button" value="Add" />
        <em class="fa-solid fa-plus"></em>
    </form>
    <!-- List of suggested tracks -->
    <div class="track-suggestions-section">
        <ul class="track-suggestions"></ul>
    </div>
    <!-- List of selected tracks -->
    <div id="selected-tracks">
    </div>
    <!-- Submit button -->
    <input type="submit" form="track-search-form" value="Add" />
</main>
<script src="js/search_suggestions.js"></script>
<script src="js/add_track_to_tracklist.js"></script>