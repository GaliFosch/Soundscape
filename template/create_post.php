<main>
    <a href="index.php" aria-label="Close post creation" title="Close post creation" class="close-post-creation">
        <em class="fa-solid fa-xmark"></em>
    </a>
    

    <form action="post_creation.php?" method="GET" class="comment" autocomplete="off">
        <label for="track">Search for a music you want to post about</label>
        <input type="search-bar" id="search-track"  name="track" placeholder="Search for song"/>
        <input type="submit" class="searchButton" value="Search" onclick="console.log('Scemo')"/>
        <em class="fa-solid fa-magnifying-glass" onclick="console.log('buffone')"></em>
    </form>

    <section class="track-suggestions-section">
        <ul class="track-suggestions"></ul>
    </section>

    
    <!-- Template if a single track has been chosen -->
    <?php if ($template["track"] != null): ?>
    <section class="music-box">
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
    <?php elseif ($template["playlist"]!= null): ?>
        <section class="playlist-box">
            <section class="inner-playlist-box">
                <?php if ($template["playlist"]['playlist']["CoverImage"] != null): ?>
                    <img class="playlist" src="<?php echo $template["playlist"]['playlist']["CoverImage"]; ?>" alt="Song cover image"/>
                <?php else: ?>
                    <img class="playlist" src="images/placeholder-image.jpg" alt="Song cover image"/>
                <?php endif; ?>
                <!--Inner section delle info della music-->
                <section class="music-info">
                    <header><strong><?php echo $template["playlist"]['playlist']["Name"]; ?></strong></header>
                    <p><?php echo $template["playlist"]['playlist']["Creator"]; ?></p>
                    <p><?php echo $template["playlist"]['playlist']["isAlbum"]==1 ? "Album" : "Playlist"; ?></p>
                </section>
                <section class="tracklist-section">
                    <ol class="tracklist">
                        <?php foreach ($template["playlist"]["songs"] as $track): ?>
                            <li class="single-track">
                                <?php if ($track["CoverImage"] != null): ?>
                                    <img class="song" src="<?php echo $track["CoverImage"]; ?>" alt="Song cover image"/>
                                <?php else: ?>
                                    <img class="song" src="images/placeholder-image.jpg" alt="Song cover image"/>
                                <?php endif; ?>
                                <!--Inner section delle info della music-->
                                <section class="music-info">
                                    <header><strong><?php echo $track["Name"]; ?></strong></header>
                                    <p><?php echo $track["Creator"]; ?></p>
                                </section>
                            </li>
                        <?php endforeach; ?>
                    </ol>
                </section> 
            </section>
        
    </section>   
    <?php else: ?>
        <p>No song chosen</p>
    <?php endif; ?>
    
    <form action="post_creation.php" method="POST" class="caption">
        <label for="write-caption">Write your post caption:</label>
        <textarea class="caption" name="caption" id="write-caption" placeholder="Write here your post" rows="23" wrap="hard" required></textarea>
        <input type="hidden" 
            name="<?php if ($template["track"] != null):?>track<?php elseif ($template["playlist"]!= null):?>playlist<?php endif; ?>" 
            value="<?php if ($template["track"] != null): ?><?php echo $template['track']['TrackID']; ?><?php elseif ($template["playlist"]!= null): ?><?php echo $template['playlist']['playlist']['PlaylistID']; ?><?php endif; ?>"></input>
        <label for="images">Add some images:</label>
        <input type="file" id="images" name="images" accept="image/jpeg, image/png" multiple max="10">
        <input type="submit" value="Post"/>
    </form>

</main>

<script src="js/post_creation.js"></script>
