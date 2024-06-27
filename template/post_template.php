<?php foreach ($template["posts"] as $post): ?>
    <article class="post-article">
        <?php $user = $dbh->getPostAuthor($post["PostID"]); ?>
        <!--Utente e foto utente-->
        <h1 class="user-info">
            <?php if ($user["ProfileImage"] != null): ?>
                <img class="profile-picture" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
            <?php else: ?>
                <img class="profile-picture" src="images/placeholder-image.jpg" alt="User profile image"/>
            <?php endif; ?>
            <?php echo $user["Username"]; ?>
        </h1>
        <!--Post caption-->
        <p post-id="<?php echo $post['PostID']; ?>"><?php echo $post["Caption"]; ?></p>
        
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
                    <p><?php echo $track["Creator"]; ?></p>
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
                    <!--Inner section delle info della music-->
                    <section class="music-info">
                        <header><strong><?php echo $playlist["Name"]; ?></strong></header>
                        <p><?php echo $playlist["Creator"]; ?></p>
                        <p><?php echo $playlist["isAlbum"]==1 ? "Album" : "Playlist"; ?></p>
                    </section>
                    <section class="tracklist-section">
                        <ol class="tracklist">
                            <?php foreach ($tracklist as $track): ?>
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
        <?php endif; ?>
            


        <section class="post-interaction post-interaction">
            <em class="fa-regular fa-message fa-fw" post-id="<?php echo $post['PostID']; ?>"></em>
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