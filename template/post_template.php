<?php foreach ($template["posts"] as $post): ?>
    <article class="post-article" id="<?php echo $post['PostID']; ?>">
        <?php $user = $dbh->getPostAuthor($post["PostID"]); ?>
        <!--Utente e foto utente-->
        <a href="profile.php?profile=<?php echo $user["Username"]; ?>" class="redirect">
            <h2 class="user-info">
                <?php if ($user["ProfileImage"] != null): ?>
                    <img class="profile-picture" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
                <?php else: ?>
                    <img class="profile-picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php endif; ?>
                <?php echo $user["Username"]; ?>
            </h2>
        </a>

        <?php
            $imgs = $dbh->getImagesFromPost($post["PostID"]);
            if(sizeof($imgs)>0):
        ?>
        <div class="imgSection">
            <div class="imgContainer">
                <em class="fa-solid fa-angle-left previous" aria-hidden="true"></em>
                <?php foreach($imgs as $img):?>
                    <img src="<?php echo $img["PostImage"]; ?>" alt=""/>
                <?php endforeach;?>
                <em class="fa-solid fa-angle-right next" aria-hidden="true"></em>
            </div>
            <footer>
                <?php foreach($imgs as $img):?>
                    <em class="fa-solid fa-circle dot" aria-hidden="true"></em>
                <?php endforeach;?>
            </footer>
        </div>
        <?php endif;?>
                    
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
                    <img class="song" src="images/song-cover-placeholder.png" alt="Song cover image"/>
                <?php endif; ?>
                <!--Inner section delle info della music-->
                <section class="music-info">
                <header><strong><?php echo $track["Name"]; ?></strong></header>
                <a href="profile.php?profile=<?php echo $track["Creator"]; ?>" class="redirect">
                    <p><?php echo $track["Creator"]; ?></p>
                </a>
                </section>
                <a href="player.php?trackid=<?php echo $track["TrackID"]; ?>" aria-label="Play track on player" title="Play track on player">
                    <em class="fa-solid fa-play" aria-hidden="true"></em>
                </a>
            </section>
        <!--POST WITH PLAYLIST-->
        <?php elseif($post["PlaylistID"]!=null): ?>
            <?php $playlist = $dbh->getSponsoredPlaylist($post["PostID"]); ?>
            <section class="playlistSection">
                <a href="playlist.php?id=<?php echo $playlist["PlaylistID"];?>">
                    <?php if(empty($playlist["CoverImage"])): ?>
                        <img class="cover-image" src="images/song-cover-placeholder.png" alt="User profile image"/>
                    <?php else: ?>
                        <img class="cover-image" src="<?php echo $playlist["CoverImage"]; ?>" alt="User profile image"/>
                    <?php endif;?>
                </a>
                <div class="playlist-info">
                    <a href="playlist.php?id=<?php echo $playlist["PlaylistID"];?>">
                        <h2 class="playlist-name"><?php echo $playlist["Name"]; ?></h2>
                    </a>
                    <p class="author"><a href="profile.php?profile=<?php echo $playlist["Creator"]; ?>"><?php echo $playlist["Creator"]; ?></a></p>
                    <p>
                        <?php
                        if($playlist["IsAlbum"] === "1"){
                            echo "Album";
                        }else{
                            echo "Playlist";
                        }
                        ?>
                    </p>
                </div>
            </section>
        <?php endif; ?>

        <div class="post-interaction">
            <em class="fa-regular fa-message fa-fw" aria-hidden="true" title="Open comments"></em>
            <?php if(checkLogin($dbh)): ?>
                <?php if($dbh->hasUserLiked($post['PostID'], $_SESSION['username'])): ?>
                    <em class="fa-solid fa-heart fa-fw article" aria-hidden="true" title="You have liked this post"></em>
                <?php else: ?>
                    <em class="fa-regular fa-heart fa-fw article" aria-hidden="true" title="Like this post"></em>
                <?php endif; ?>
            <?php else: ?>
                <em class="fa-regular fa-heart fa-fw article" aria-hidden="true"></em>
            <?php endif; ?>
        </div>

    </article>
<?php endforeach; ?>

<script src="js/imageGallery.js"></script>