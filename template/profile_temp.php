<main>
    <header>
        <?php 
            if (!empty($template["profile"]["ProfileImage"])){
                echo "<img src=\"{$template["profile"]["ProfileImage"]}\" alt=\"\" />";
            } else {
                echo "<img src=\"images/placeholder-image.jpg\" alt=\"\" />";
            }
        ?>
        <h2><?php echo $template["profile"]["Username"]?></h2>
    </header>
    <?php if(!$template["isProfileLogged"]):?>
        <?php if($template["isUserLogged"]):?>
            <div>
                <?php if($dbh->isFollowing($_SESSION["username"], $template["profile"]["Username"])):?>
                    <button id="follow-button" type="button"><em id="follow" class="fa-solid fa-user-check"></em>Following</button>
                <?php else:?>
                    <button id="follow-button" type="button"><em id="follow" class="fa-solid fa-user-plus"></em>Follow</button>
                <?php endif?>
            </div>
            <script src="js/follow.js"></script>
        <?php else:?>
            <div>
                <a href="login.php"><em id="follow" class="fa-solid fa-user-plus"></em></a>
            </div>
        <?php endif?>
    <?php endif;?>
    <section id="Counts">
        <div>
            <a href="list.php?t=followers&profile=<?php echo $template["profile"]["Username"]; ?>">
                <h3>Followers</h3>
                <p id="followerCount"><?php echo $template["profile"]["NumFollower"] ?></p>
            </a>
        </div><div>
            <a href="list.php?t=following&profile=<?php echo $template["profile"]["Username"]; ?>">
                <h3>Following</h3>
                <p  id="followingCount"><?php echo $template["profile"]["NumFollowing"] ?></p>
            </a>
        </div>
    </section>
    <section id="Biography">
        <header>
            <h3>Biography</h3>
            <button id="EditBiograpy">Edit</button>
        </header>
        <p>
            <?php echo $template["profile"]["Biography"]?>
        </p>
        <form action="#" id="BiographyForm">
            <label for="bio" hidden>Biography</label>
            <textarea name="bio" id="bio" placehilder="Write your Biograpy here"></textarea>
            <input type="submit" value="Confirm"/>
            <button id="bioEditUndo">Cancel</button>
        </form>
        <script src="js/editBiography.js"></script>
    </section>
    <section id="tracks-section">
        <?php $tracks = $dbh->getUserLatestTracks($template["profile"]["Username"],5); ?>
        <header class="section-header">
            <h3 class="section-title">Published Tracks</h3>
            <?php if (count($tracks) != 0): ?>
                <div class="show-all-btn-container"><a href="list.php?t=tracks&profile=<?php echo $template["profile"]["Username"]; ?>">Show All</a></div>
            <?php endif; ?>
        </header>
        <div>
            <?php if (count($tracks) != 0): ?>
                <?php foreach ($tracks as $track): ?>
                    <article>
                        <a href="player.php?trackid=<?php echo $track["TrackID"]?>">
                            <?php
                                if (isset($track["CoverImage"])) {
                                    echo "<img src=\"{$track["CoverImage"]}\" alt=\"Click to load the track on the music player\" />";
                                } else {
                                    echo "<img src=\"images/song-cover-placeholder.png\" alt=\"Click to load the track on the music player\" />";
                                }
                            ?>
                            <h4><?php echo $track["Name"]?></h4>
                        </a>
                    </article>
                <?php endforeach;?>
            <?php else: ?>
                <p>No published tracks yet.</p>
            <?php endif; ?>
        </div>
    </section>
    <section id="albums-section">
        <?php $albums = $dbh->getUserLatestAlbums($template["profile"]["Username"],5); ?>
        <header class="section-header">
            <h3 class="section-title">Published Albums</h3>
            <?php if (count($albums) != 0): ?>
                <div class="show-all-btn-container"><a href="list.php?t=albums&profile=<?php echo $template["profile"]["Username"]; ?>">Show All</a></div>
            <?php endif; ?>
        </header>
        <div>
            <?php if (count($albums) != 0): ?>
                <?php foreach ($albums as $album): ?>
                    <article>
                        <a href="<?php echo 'playlist.php?id=' . $album["PlaylistID"]; ?>">
                            <?php
                                if (!empty($album["CoverImage"])) {
                                    echo "<img src=\"{$album["CoverImage"]}\" alt=\"Click to open the album\" />";
                                } else {
                                    echo "<img src=\"images/song-cover-placeholder.png\" alt=\"Click to open the album\" />";
                                }
                            ?>
                            <h4><?php echo $album["Name"]?></h4>
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No published albums yet.</p>
            <?php endif; ?>
        </div>
    </section>
    <section id="playlists-section">
        <?php $playlists = $dbh->getUserLatestPlaylists($template["profile"]["Username"],5); ?>
        <header class="section-header">
            <h3 class="section-title">Playlists</h3>
            <?php if (count($playlists) != 0): ?>
                <div class="show-all-btn-container"><a href="list.php?t=playlists&profile=<?php echo $template["profile"]["Username"]; ?>">Show All</a></div>
            <?php endif; ?>
        </header>
        <div>
            <?php if (count($playlists) != 0): ?>
                <?php foreach ($playlists as $playlist): ?>
                    <article>
                        <a href="<?php echo 'playlist.php?id=' . $playlist["PlaylistID"]; ?>">
                            <?php
                                if (!empty($playlist["CoverImage"])) {
                                    echo "<img src=\"{$playlist["CoverImage"]}\" alt=\"Click to open the playlist\" />";
                                } else {
                                    echo "<img src=\"images/song-cover-placeholder.png\" alt=\"Click to open the playlist\" />";
                                }
                            ?>
                            <h4><?php echo $playlist["Name"]?></h4>
                        </a>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No playlists created yet.</p>
            <?php endif; ?>
        </div>
    </section>
    <section id="posts-section">
        <?php $bestPosts = $dbh->getBestUserPosts($template["profile"]["Username"],5); ?>
        <header class="section-header">
            <h3 class="section-title">Posts</h3>
            <?php if (count($bestPosts) != 0): ?>
                <div class="show-all-btn-container"><a href="list.php?t=posts&profile=<?php echo $template["profile"]["Username"]; ?>">Show All</a></div>
            <?php endif; ?>
        </header>
        <?php if (count($bestPosts) != 0): ?>
            <?php foreach ($bestPosts as $post): ?>
                <article class="post">
                    <?php $user = $template["profile"]; ?>
                    <!--Utente e foto utente-->
                    <header>
                        <?php if ($user["ProfileImage"] != null): ?>
                            <img src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
                        <?php else: ?>
                            <img src="images/placeholder-image.jpg" alt="User profile image"/>
                        <?php endif; ?>
                        <h4><?php echo $user["Username"]; ?></h4>
                    </header>
                    <!--Post caption-->
                    <p post-id="<?php echo $post['PostID']; ?>"><?php echo $post["Caption"]; ?></p>
                    <!--Outer section of music box-->
                    <?php $track = $dbh->getSponsoredTrack($post["PostID"]); ?>
                    <?php if ($track != null): ?>
                        <div class="music-box">
                            <?php if ($track["CoverImage"] != null): ?>
                                <img src="<?php echo $track["CoverImage"]; ?>" alt="Song cover image"/>
                            <?php else: ?>
                                <img src="images/placeholder-image.jpg" alt="Song cover image"/>
                            <?php endif; ?>
                            <!--Inner section delle info della music-->
                            <div class="music-info">
                                <header><strong><?php echo $track["Name"]; ?></strong></header>
                                <p><?php echo $track["Creator"]; ?></p>
                            </div>
                            <a href="player.php?trackid=<?php echo $track["TrackID"]; ?>" aria-label="Play track on player" title="Play track on player">
                                <em class="fa-solid fa-play"></em>
                            </a>
                        </div>
                    <?php endif; ?>
                    <div class="post-interaction">
                        <a href="#" aria-label="Comment post" title="Comment post"><em class="fa-regular fa-message fa-fw"></em></a>
                        <em class="fa-regular fa-heart fa-fw"></em>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No published posts yet.</p>
        <?php endif; ?>
    </section>
</main>