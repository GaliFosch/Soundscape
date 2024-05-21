<main>
    <header>
        <?php 
            if(!empty($template["profile"]["ProfileImage"])){
                echo "<img src=\"{$template["profile"]["ProfileImage"]}\" alt=\"\" \>";
            }else{
                echo "<img src=\"images/placeholder-image.jpg\" alt=\"\" \>";
            }
        ?>
        <h2><?php echo $template["profile"]["Username"]?></h2>
    </header>
    <section>
        <h3>Canzoni Pubblicate</h3>
        <div>
            <?php
                $tracks = $dbh->getUserLatestTracks($template["profile"]["Username"],5);
            ?>
            <?php
                foreach ($tracks as $track){
            ?>
                <article>
                    <a href="player.php?trackid=<?php echo $track["TrackID"]?>">
                        <?php
                            if(!empty($track["CoverImage"])) {
                                echo "<img src=\"{$track["CoverImage"]}\" alt=\"\" \>";
                            }else{
                                echo "<img src=\"images/song-cover-placeholder.png\" alt=\"\" \>";
                            }
                        ?>
                        <h4><?php echo $track["Name"]?></h4>
                    </a>
                </article>
            <?php }?>
        </div>
    </section>
    <section>
        <h3>Playlist Pubblicate</h3>
        <?php
            $playlists = $dbh->getUserLatestPlaylists($template["profile"]["Username"],5);
        ?>
        <ul>
            <?php
                foreach ($playlists as $playlist){
            ?>
            <li>
                <a href="#"><?php echo $playlist["Name"]?></a>
            </li>
            <?php }?>
        </ul>
    </section>
    <section>
        <h3>Album Pubblicati</h3>
        <?php
            $albums = $dbh->getUserLatestAlbums($template["profile"]["Username"],5);
        ?>
        <ul>
            <?php
                foreach ($albums as $album){
            ?>
            <li>
                <a href="#"><?php echo $album["Name"]?></a>
            </li>
            <?php }?>
        </ul>
    </section>
    <section>
        <h3>Migliori Post</h3>
        <?php 
            $bestPosts = $dbh->getBestUserPosts($template["profile"]["Username"],5);
            foreach ($bestPosts as $post): 
        ?>
        <article>
            <?php $user = $template["profile"]; ?>
            <!--Utente e foto utente-->
            <h1>
                <?php if ($user["ProfileImage"] != null): ?>
                    <img class="picture" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
                <?php else: ?>
                    <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php endif; ?>
                <?php echo $user["Username"]; ?>
            </h1>
            <!--Post caption-->
            <p class="open-focus" post-id="<?php echo $post['PostID']; ?>"><?php echo $post["Caption"]; ?></p>
            <!--Outer section of music box-->
            <section class="music-box">
                <?php $track = $dbh->getSponsoredTrack($post["PostID"]); ?>
                <?php if ($track != null): ?>
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
                <?php endif; ?>
            </section>
            <section class="post-interaction">
                <a href="#" aria-label="Comment post" title="Comment post"><em class="fa-regular fa-message fa-fw"></em></a>
                <em class="fa-regular fa-heart fa-fw"></em>
            </section>
        </article>
    <?php endforeach; ?>
    </section>
</main>