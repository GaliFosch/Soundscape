<!--Direi di fare due pagine una per la scelta della canzone e una per la scrittura del post-->
<?php

    $found = true;

    if($template["track"]==null) {
        $found = false; 
    } else{
        $found = true;
    }
?>
<main>
    <em class="fa-solid fa-xmark close-post-creation"></em>

    <form action="post_creation.php?" method="GET" class="comment">
        <label for="search-track">Search for a music you want to post about</label>
        <input id="search-track" type="search-bar" name="track" placeholder="Search for song"/>
        <input type="submit" value="Search"/>
        <em class="fa-solid fa-magnifying-glass"></em>
    </form>

    <section class="track-suggestions"></section>

    <section class="music-box focus"></section>
    <?php if ($template["track"] != null): ?>
        
            <?php if ($template["track"]["CoverImage"] != null): ?>
                <img class="song focus" src="<?php echo $template["track"]["CoverImage"]; ?>" alt="Song cover image"/>
            <?php else: ?>
                <img class="song focus" src="images/placeholder-image.jpg" alt="Song cover image"/>
            <?php endif; ?>
            <a href="player.php?trackid=<?php echo $template["track"]["TrackID"]; ?>" aria-label="Play track on player" title="Play track on player">
                <em class="fa-solid fa-play focus"></em></a>
            <section class="music-info focus">
                <p class="info focus"><strong><?php echo $template["track"]["Name"]; ?></strong></p>
                <p><?php echo $template["track"]["Creator"]; ?></p>
              
        </section>
        <p>Minimal view</p>
        <p>Remove track</p>
    <?php elseif ($found==false): ?>
        <p>No song matches this name</p>
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

