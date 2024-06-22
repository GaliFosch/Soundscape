<?php

$_SESSION["selected-tracks-ids"] = array();

?>
<main>
    <h1>Search and add tracks to your album or playlist:</h1>
    <!-- Search bar -->
    <form id="track-search-form" action="process_track_addition.php?pid=<?php echo $template["playlist_id"]; ?>" method="POST" class="comment" autocomplete="off">
        <label for="track-search"></label>
        <input id="track-search" type="search" name="track" placeholder="Search for song"/>
        <input id="add-track-button" type="button" value="Add" />
        <em class="fa-solid fa-plus"></em>
    </form>
    <!-- List of suggested tracks -->
    <section class="track-suggestions-section">
        <ul class="track-suggestions"></ul>
    </section>
    <!-- List of selected tracks -->
    <section id="selected-tracks">
    </section>
    <!-- Submit button -->
    <input type="submit" form="track-search-form" value="Add" />
</main>
<script src="js/search_suggestions.js"></script>
<script src="js/add_track_to_tracklist.js"></script>