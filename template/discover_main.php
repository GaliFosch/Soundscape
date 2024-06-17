<!-- Search bar -->
<header>
    <form action="#" method="GET">
        <em class="fa-solid fa-magnifying-glass" aria-hidden="true"></em>
        <label for="search-bar">Search</label>
        <input id="search-bar" type="search" name="query"/>
        <input type="submit" value="Go"/>
    </form>
</header>
<!-- Search results and suggestions -->
<main>
    <?php $nPreviewsToShow = 2; ?>
    <h1 id="discover-title">Discover</h1>
    <?php if (isset($_GET["query"]) && ($_GET["query"] != "")): ?>
        <?php $_SESSION["search-query"] = $_GET["query"]; ?>
        <section class="discover-section">
            <?php $users = $dbh->getMatchingUsers($_GET["query"], $nPreviewsToShow); ?>
            <?php if (count($users) != 0): ?>
                <h2>Users</h2>
                <?php foreach ($users as $user): ?>
                    <section class="preview">
                        <a href="#">
                            <?php if (isset($user["ProfileImage"])): ?>
                                <img class="picture" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
                            <?php else: ?>
                                <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                            <?php endif; ?>
                            <h3><?php echo $user["Username"]; ?></h3>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($users) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="matching-users" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <?php $tracks = $dbh->getMatchingTracks($_GET["query"], $nPreviewsToShow); ?>
            <?php if (count($tracks) != 0): ?>
                <h2>Tracks</h2>
                <?php foreach ($tracks as $track): ?>
                    <section class="preview">
                        <a href="player.php?trackid=<?php echo $track["TrackID"]; ?>">
                            <?php if (isset($track["CoverImage"])): ?>
                                <img class="picture" src="<?php echo $track["CoverImage"]; ?>" alt="Track cover image"/>
                            <?php else: ?>
                                <img class="picture" src="images/placeholder-image.jpg" alt="Track cover image"/>
                            <?php endif; ?>
                            <div class="preview-info">
                                <h3 class="preview-title"><?php echo $track["Name"]; ?></h3>
                                <h3 class="author"><?php echo $track["Creator"]; ?></h3>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($tracks) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="matching-tracks" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <?php $albums = $dbh->getMatchingAlbums($_GET["query"], $nPreviewsToShow); ?>
            <?php if (count($albums) != 0): ?>
                <h2>Albums</h2>
                <?php foreach ($albums as $album): ?>
                    <section class="preview">
                        <a href="<?php echo 'playlist.php?id=' . $album["PlaylistID"]; ?>">
                            <?php if (isset($album["CoverImage"])): ?>
                                <img class="picture" src="<?php echo $album["CoverImage"]; ?>" alt="Album cover image"/>
                            <?php else: ?>
                                <img class="picture" src="images/placeholder-image.jpg" alt="Album cover image"/>
                            <?php endif; ?>
                            <div class="preview-info">
                                <h3 class="preview-title"><?php echo $album["Name"]; ?></h3>
                                <h3 class="author"><?php echo $album["Creator"]; ?></h3>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($albums) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="matching-albums" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <?php $playlists = $dbh->getMatchingPlaylists($_GET["query"], $nPreviewsToShow); ?>
            <?php if (count($playlists) != 0): ?>
                <h2>Playlists</h2>
                <?php foreach ($playlists as $playlist): ?>
                    <section class="preview">
                        <a href="<?php echo 'playlist.php?id=' . $playlist["PlaylistID"]; ?>">
                            <?php if (isset($playlist["CoverImage"])): ?>
                                <img class="picture" src="<?php echo $playlist["CoverImage"]; ?>" alt="Playlist cover image"/>
                            <?php else: ?>
                                <img class="picture" src="images/placeholder-image.jpg" alt="Playlist cover image"/>
                            <?php endif; ?>
                            <div class="preview-info">
                                <h3 class="preview-title"><?php echo $playlist["Name"]; ?></h3>
                                <h3 class="author"><?php echo $playlist["Creator"]; ?></h3>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($playlists) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="matching-playlists" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    <?php else: ?>
        <section class="discover-section">
            <h2>New tracks</h2>
            <?php $tracks = $dbh->getLatestTracks($nPreviewsToShow); ?>
            <?php foreach ($tracks as $track): ?>
                <section class="preview">
                    <a href="player.php?trackid=<?php echo $track["TrackID"]; ?>">
                        <?php if (isset($track["CoverImage"])): ?>
                            <img class="picture" src="<?php echo $track["CoverImage"]; ?>" alt="Track cover image"/>
                        <?php else: ?>
                            <img class="picture" src="images/placeholder-image.jpg" alt="Track cover image"/>
                        <?php endif; ?>
                        <div class="preview-info">
                            <h3 class="preview-title"><?php echo $track["Name"]; ?></h3>
                            <h3 class="author"><?php echo $track["Creator"]; ?></h3>
                        </div>
                    </a>
                </section>
            <?php endforeach; ?>
            <?php if (count($tracks) == $nPreviewsToShow): ?>
                <form action="#" method="GET">
                    <input id="tracks" class="show-more" type="button" value="Show more"/>
                </form>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <h2>New albums</h2>
            <?php $albums = $dbh->getLatestAlbums($nPreviewsToShow); ?>
            <?php foreach ($albums as $album): ?>
                <section class="preview">
                    <a href="<?php echo 'playlist.php?id=' . $album["PlaylistID"]; ?>">
                        <?php if (isset($album["CoverImage"])): ?>
                            <img class="picture" src="<?php echo $album["CoverImage"]; ?>" alt="Album cover image"/>
                        <?php else: ?>
                            <img class="picture" src="images/placeholder-image.jpg" alt="Album cover image"/>
                        <?php endif; ?>
                        <div class="preview-info">
                            <h3 class="preview-title"><?php echo $album["Name"]; ?></h3>
                            <h3 class="author"><?php echo $album["Creator"]; ?></h3>
                        </div>
                    </a>
                </section>
            <?php endforeach; ?>
            <?php if (count($albums) == $nPreviewsToShow): ?>
                <form action="#" method="GET">
                    <input id="albums" class="show-more" type="button" value="Show more"/>
                </form>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <h2>New playlists</h2>
            <?php $playlists = $dbh->getLatestPlaylists($nPreviewsToShow); ?>
            <?php foreach ($playlists as $playlist): ?>
                <section class="preview">
                    <a href="<?php echo 'playlist.php?id=' . $playlist["PlaylistID"]; ?>">
                        <?php if (isset($playlist["CoverImage"])): ?>
                            <img class="picture" src="<?php echo $playlist["CoverImage"]; ?>" alt="Playlist cover image"/>
                        <?php else: ?>
                            <img class="picture" src="images/placeholder-image.jpg" alt="Playlist cover image"/>
                        <?php endif; ?>
                        <div class="preview-info">
                            <h3 class="preview-title"><?php echo $playlist["Name"]; ?></h3>
                            <h3 class="author"><?php echo $playlist["Creator"]; ?></h3>
                        </div>
                    </a>
                </section>
            <?php endforeach; ?>
            <?php if (count($playlists) == $nPreviewsToShow): ?>
                <form action="#" method="GET">
                    <input id="playlists" class="show-more" type="button" value="Show more"/>
                </form>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</main>
<script src="js/discover.js"></script>