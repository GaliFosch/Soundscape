<?php foreach ($template["posts"] as $post): ?>
    <article class="post-article" id="<?php echo $post['PostID']; ?>">
        <?php $user = $dbh->getPostAuthor($post["PostID"]); ?>
        <!--Utente e foto utente-->
        <a href="profile.php?profile=<?php echo $user["Username"]; ?>" class="redirect">
            <h1 class="user-info">
                <?php if ($user["ProfileImage"] != null): ?>
                    <img class="profile-picture" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
                <?php else: ?>
                    <img class="profile-picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php endif; ?>
                <?php echo $user["Username"]; ?>
            </h1>     
        </a>
        <!--Post caption-->
        <p class="open-focus"><?php echo $post["Caption"]; ?></p>
        
        <!--Outer section of music box-->
        <!--POST WITH MUSIC-->
        <?php if($post["TrackID"]!=null): ?>
            <?php $track = $dbh->getSponsoredTrack($post["PostID"]); ?>
            <section class="music-box">
                <?php if ($track["CoverImage"] != null): ?>
                    <img class="song" src="<?php echo $track["CoverImage"]; ?>" alt="Song cover image"/>
                <?php else: ?>
                    <img class="song" src="images/placeholder-image.jpg" alt="Song cover image"/>
                <?php endif; ?>
                <!--Inner section delle info della music-->
                <section class="music-info">
                <header><strong><?php echo $track["Name"]; ?></strong></header>
                <a href="profile.php?profile=<?php echo $track["Creator"]; ?>" class="redirect">
                    <p><?php echo $track["Creator"]; ?></p>
                </a>
                </section>
                <a href="player.php?trackid=<?php echo $track["TrackID"]; ?>" aria-label="Play track on player" title="Play track on player">
                    <em class="fa-solid fa-play"></em>
                </a>
            </section>
        <!--POST WITH PLAYLIST-->
        <?php elseif($post["PlaylistID"]!=null): ?>
            <?php 
            $playlist = $dbh->getSponsoredPlaylist($post["PostID"]); 
            $tracklist = $dbh->getOrderedTracklistByPlaylistID($playlist["PlaylistID"]); 
            ?>
            <section class="playlist-box">
                <section class="inner-playlist-box">
                    <?php if (isset($playlist["CoverImage"])): ?>
                        <img class="playlist" src="<?php echo $playlist["CoverImage"]; ?>" alt="Song cover image"/>
                    <?php else: ?>
                        <img class="playlist" src="images/placeholder-image.jpg" alt="Song cover image"/>
                    <?php endif; ?>
                    <a href="playlist.php?id=<?php echo $playlist["PlaylistID"]; ?>" aria-label="Discover more about playlist" title="Discover more about playlist">
                        <em class="fa-solid fa-play focus"></em>
                    </a>
                    <!--Inner section delle info della music-->
                    <section class="music-info">
                        <header><strong><?php echo $playlist["Name"]; ?></strong></header>
                        <a href="profile.php?profile=<?php echo $playlist["Creator"]; ?>" class="redirect">
                            <p><?php echo $playlist["Creator"]; ?></p>
                        </a>
                        <p><?php echo $playlist["IsAlbum"]==1 ? "Album" : "Playlist"; ?></p>
                    </section>
                </section>
            </section>
        <?php endif; ?>
            


        <section class="post-interaction">
            <em class="fa-regular fa-message fa-fw"></em>
            <?php if(isset($_SESSION['username'])): ?>
                <?php if($dbh->hasUserLiked($post['PostID'], $_SESSION['username'])): ?>
                    <em class="fa-solid fa-heart fa-fw article"></em>
                <?php else: ?>
                    <em class="fa-regular fa-heart fa-fw article"></em>
                <?php endif; ?>
            <?php else: ?>
                <em class="fa-regular fa-heart fa-fw article"></em>
            <?php endif; ?>
        </section>
    </article>
<?php endforeach; ?>