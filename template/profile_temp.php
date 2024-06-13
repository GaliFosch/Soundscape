<main>
    <header>
        <?php 
            if (!empty($template["profile"]["ProfileImage"])){
                echo "<img src=\"{$template["profile"]["ProfileImage"]}\" alt=\"\" \>";
            } else {
                echo "<img src=\"images/placeholder-image.jpg\" alt=\"\" \>";
            }
        ?>
        <h2><?php echo $template["profile"]["Username"]?></h2>
    </header>
    <section>
        <header class="section-header">
            <h3 class="section-title">Published Tracks</h3>
            <div class="show-all-btn-container"><a href="list.php?t=tracks">Show All</a></div>
        </header>
        <div>
            <?php
                $tracks = $dbh->getUserLatestTracks($template["profile"]["Username"],5);
            ?>
            <?php foreach ($tracks as $track): ?>
                <article>
                    <a href="player.php?trackid=<?php echo $track["TrackID"]?>">
                        <?php
                            if (isset($track["CoverImage"])) {
                                echo "<img src=\"{$track["CoverImage"]}\" alt=\"\" />";
                            } else {
                                echo "<img src=\"images/song-cover-placeholder.png\" alt=\"\" />";
                            }
                        ?>
                        <h4><?php echo $track["Name"]?></h4>
                    </a>
                </article>
            <?php endforeach;?>
        </div>
    </section>
    <section>
        <header class="section-header">
            <h3 class="section-title">Published Albums</h3>
            <div class="show-all-btn-container"><a href="list.php?t=albums">Show All</a></div>
        </header>
        <?php
        $albums = $dbh->getUserLatestAlbums($template["profile"]["Username"],5);
        ?>
        <div>
            <?php
            foreach ($albums as $album):
                ?>
                <article>
                    <a href="<?php echo 'playlist.php?id=' . $album["PlaylistID"]; ?>">
                        <?php
                            if (!empty($album["CoverImage"])) {
                                echo "<img src=\"{$album["CoverImage"]}\" alt=\"\" \>";
                            } else {
                                echo "<img src=\"images/song-cover-placeholder.png\" alt=\"\" \>";
                            }
                        ?>
                        <h4><?php echo $album["Name"]?></h4>
                    </a>
                </article>
            <?php endforeach; ?>
        </div>
    </section>
    <section>
        <header class="section-header">
            <h3 class="section-title">Playlists</h3>
            <div class="show-all-btn-container"><a href="list.php?t=playlists">Show All</a></div>
        </header>
        <?php
            $playlists = $dbh->getUserLatestPlaylists($template["profile"]["Username"],5);
        ?>
        <div>
            <?php
                foreach ($playlists as $playlist):
            ?>
                <article>
                    <a href="<?php echo 'playlist.php?id=' . $playlist["PlaylistID"]; ?>">
                        <?php
                            if (!empty($playlist["CoverImage"])) {
                                echo "<img src=\"{$playlist["CoverImage"]}\" alt=\"\" />";
                            } else {
                                echo "<img src=\"images/song-cover-placeholder.png\" alt=\"\" />";
                            }
                        ?>
                        <h4><?php echo $playlist["Name"]?></h4>
                    </a>
                </article>
            <?php endforeach; ?>
        </div> 
    </section>
    <section>
        <header class="section-header">
            <h3 class="section-title">Best Posts</h3>
            <div class="show-all-btn-container"><a href="list.php?t=best-posts">Show All</a></div>
        </header>
        <?php 
            $bestPosts = $dbh->getBestUserPosts($template["profile"]["Username"],5);
            foreach ($bestPosts as $post): 
        ?>
        <article class = "post">
            <?php $user = $template["profile"]; ?>
            <!--Utente e foto utente-->
            <h4>
                <?php if ($user["ProfileImage"] != null): ?>
                    <img src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
                <?php else: ?>
                    <img src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php endif; ?>
                <p><?php echo $user["Username"]; ?></p>
            </h4>
            <!--Post caption-->
            <p post-id="<?php echo $post['PostID']; ?>"><?php echo $post["Caption"]; ?></p>
            <!--Outer section of music box-->
            <section class = "music-box">
                <?php $track = $dbh->getSponsoredTrack($post["PostID"]); ?>
                <?php if ($track != null): ?>
                    <?php if ($track["CoverImage"] != null): ?>
                        <img src="<?php echo $track["CoverImage"]; ?>" alt="Song cover image"/>
                    <?php else: ?>
                        <img src="images/placeholder-image.jpg" alt="Song cover image"/>
                    <?php endif; ?>
                    <!--Inner section delle info della music-->
                    <section>
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