<main>
    <a href="index.php" aria-label="Close post creation" title="Close post creation" class="close-post-creation">
        <em class="fa-solid fa-xmark"></em>
    </a>
    

    <form action="post_creation.php?" method="GET" class="comment" autocomplete="off">
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
        <!--Inner section delle info della music-->
        <section class="music-info">
            <header><strong><?php echo $template["track"]["Name"]; ?></strong></header>
            <p><?php echo $template["track"]["Creator"]; ?></p>
        </section>
        <a href="player.php?trackid=<?php echo $template["track"]["TrackID"]; ?>" aria-label="Play track on player" title="Play track on player">
            <em class="fa-solid fa-play"></em>
        </a>
        
   </section>
   <section class="options">
            <p class="remove">Remove track</p>
    </section>     
    <?php else: ?>
    </section>   
        <p>No song chosen</p>
    <?php endif; ?>
    
    <form action="template/post_creation.php?track=<?php echo $template["track"]; ?>" method="POST" class="caption">
        <label for="write-caption">Write your comment:</label>
        <textarea class="caption" name="caption" id="write-caption" placeholder="Write here your post" rows="23" wrap="hard"></textarea>
        <input type="submit" value="Post"/>
    </form>
</main>

<script src="js/post_creation.js"></script>

