<main>
    <?php if(isset($_GET["error"])): ?>
        <section class="msg-section">
            <?php if ($_GET["error"] == "1"): ?>
                <p id="post-msg">Error: unknown track, please try search again</p>
            <?php elseif($_GET["error"] != "false"): ?>
                <p id="post-msg">Error: the post couldn't be added. Please retry</p>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <a href="index.php" aria-label="Close post creation" title="Close post creation" class="close-post-creation">
        <em class="fa-solid fa-xmark"></em>
    </a>

    <form id="track-search-form" action="post_creation.php?" method="GET" class="comment" autocomplete="off">
        <label for="track-search"></label>
        <input id="track-search" type="search" name="track" placeholder="Search for song"/>
        <input type="submit" class="searchButton" value="Search" />
        <em class="fa-solid fa-magnifying-glass"></em>
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
        <!--<a href="player.php?trackid=<?php echo $template["track"]["TrackID"]; ?>" aria-label="Play track on player" title="Play track on player">
            <em class="fa-solid fa-play"></em>
        </a>   --> 
   </section>

    <section class="options">
    <p class="remove">Remove track</p>
    </section>
    <?php elseif (isset($template["playlist"])): ?>
        <section class="playlistSection">
            <a href="playlist.php?id=<?php echo $template["playlist"]["PlaylistID"];?>">
                <?php if(empty($template["playlist"]["CoverImage"])): ?>
                    <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php else: ?>
                    <img class="picture" src="<?php echo $template["playlist"]["CoverImage"]; ?>" alt="User profile image"/>
                <?php endif;?>
            </a>
            <div class="playlist-info">
                <a href="playlist.php?id=<?php echo $template["playlist"]["PlaylistID"];?>">
                    <h2 class="playlist-name"><?php echo $template["playlist"]["Name"]; ?></h2>
                </a>
                <p class="author"><a href="profile.php?profile=<?php echo $template["playlist"]["Creator"]; ?>"><?php echo $template["playlist"]["Creator"]; ?></a></p>
                <p>
                    <?php
                    if($template["playlist"]["isAlbum"] === "1"){
                        echo "Album";
                    }else{
                        echo "Playlist";
                    }
                    ?>
                </p>
            </div>
        </section>
        <section class="options">
            <p class="remove">Remove track</p>
        </section>
        <?php else: ?>
            <p>No song chosen</p>
        <?php endif; ?>

    <form action="process_post.php" method="POST" class="caption" enctype="multipart/form-data">
        <label for="write-caption">Write your post caption:</label>
        <textarea class="caption" name="caption" id="write-caption" placeholder="Write here your post" rows="23" wrap="hard" required></textarea>
        <input type="hidden" 
            name="<?php echo $template['type']; ?>"
            value="<?php if ($template["type"] == 'track'): ?><?php echo $template['track']['TrackID']; ?><?php elseif ($template["type"] == 'playlist'): ?><?php echo $template['playlist']['PlaylistID']; ?><?php endif; ?>"></input>
        <label for="images">Add some images:</label>
        <input type="file" id="images" name="images[]" accept="image/jpg, image/jpeg, image/png" multiple>
        <input type="submit" value="Post"/>
    </form>

</main>

<script src="js/post_creation.js"></script>
<script src="js/search_suggestions.js"></script>

