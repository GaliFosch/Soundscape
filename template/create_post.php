<main>
    <em class="fa-solid fa-xmark close-post-creation"></em>

    <form action="post_creation.php?" method="GET" class="comment">
        <label for="search-track">Search for a music you want to post about</label>
        <input id="search-track" type="search-bar" name="track" placeholder="Search for song"/>
        <input class="searchButton" type="submit" value="Search"/>
        <em class="fa-solid fa-magnifying-glass"></em>
    </form>

    <section class="track-suggestions-section">
        <ul class="track-suggestions"></ul>
    </section>

    <section class="music-box">
    <?php if ($template["track"] != null): ?>

            <?php if ($template["track"]["CoverImage"] != null): ?>
                <img class="song" src="<?php echo $template["track"]["CoverImage"]; ?>" alt="Song cover image"/>
            <?php else: ?>
                <img class="song" src="images/placeholder-image.jpg" alt="Song cover image"/>
            <?php endif; ?>

            <section class="music-info">
                <p class="info focus"><strong><?php echo $template["track"]["Name"]; ?></strong></p>
                <p><?php echo $template["track"]["Creator"]; ?></p>
            </section>
            <section class="options">
                <p class="minimal">Minimal view</p>
                <p class="remove">Remove track</p>
            </section>
            
    <?php else: ?>
        <p>No song chosen yet</p>
    <?php endif; ?>
    </section> 

    <form action="template/post_creation.php?track=<?php echo $template["track"]; ?>" method="POST" class="caption">
        <label for="write-caption">Write your comment:</label>
        <textarea class="caption" name="caption" id="write-caption" placeholder="Write here your post" rows="25" wrap="hard"></textarea>
        <input type="submit" value="Post"/>
    </form>
</main>

<script src="js/post_creation.js"></script>

