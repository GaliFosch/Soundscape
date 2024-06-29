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
    <?php $nPreviewsToShow = 4; ?>
    <h1 id="discover-title">Discover</h1>
    <?php if (isset($_GET["query"]) && ($_GET["query"] != "")): ?>
        <?php $_SESSION["search-query"] = $_GET["query"]; ?>
        <section class="discover-section">
            <h2>Users</h2>
            <?php $users = $dbh->getMatchingUsers($_GET["query"], $nPreviewsToShow); ?>
            <?php if (count($users) != 0): ?>
                <?php foreach ($users as $user): ?>
                    <section class="preview">
                        <a href="profile.php?profile=<?php echo $user["Username"]; ?>">
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
            <?php else: ?>
                <p>No matching users found.</p>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <h2>Tracks</h2>
            <?php $tracks = $dbh->getMatchingTracks($_GET["query"], $nPreviewsToShow); ?>
            <?php if (count($tracks) != 0): ?>
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
                                <?php $track["year"] = date('Y', strtotime($track["CreationDate"])); ?>
                                <h3 class="track-length"><?php echo $track["year"]; ?> - <?php echo $track["TimeLength"]; ?></h3>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($tracks) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="matching-tracks" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p>No matching tracks found.</p>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <h2>Albums</h2>
            <?php $albums = $dbh->getMatchingAlbums($_GET["query"], $nPreviewsToShow); ?>
            <?php if (count($albums) != 0): ?>
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
                                <?php $album["year"] = date('Y', strtotime($album["CreationDate"])); ?>
                                <h3 class="track-length"><?php echo $album["year"]; ?> - <?php echo $album["TimeLength"]; ?></h3>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($albums) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="matching-albums" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p>No matching albums found.</p>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <h2>Playlists</h2>
            <?php $playlists = $dbh->getMatchingPlaylists($_GET["query"], $nPreviewsToShow); ?>
            <?php if (count($playlists) != 0): ?>
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
                                <?php $playlist["year"] = date('Y', strtotime($playlist["CreationDate"])); ?>
                                <h3 class="track-length"><?php echo $playlist["year"]; ?> - <?php echo $playlist["TimeLength"]; ?></h3>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($playlists) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="matching-playlists" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p>No matching playlists found.</p>
            <?php endif; ?>
        </section>
    <?php else: ?>
        <section class="discover-section">
            <h2>New tracks</h2>
            <?php
                if (isset($_SESSION["username"])) {
                    $tracks = $dbh->getLatestTracks($nPreviewsToShow, 0, $_SESSION["username"]);
                } else {
                    $tracks = $dbh->getLatestTracks($nPreviewsToShow);
                }
            ?>
            <?php if (count($tracks) != 0): ?>
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
                                <?php $track["year"] = date('Y', strtotime($track["CreationDate"])); ?>
                                <h3 class="track-length"><?php echo $track["year"]; ?> - <?php echo $track["TimeLength"]; ?></h3>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($tracks) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="tracks" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p>There are no tracks here.</p>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <h2>New albums</h2>
            <?php
                if (isset($_SESSION["username"])) {
                    $albums = $dbh->getLatestAlbums($nPreviewsToShow, 0, $_SESSION["username"]);
                } else {
                    $albums = $dbh->getLatestAlbums($nPreviewsToShow);
                }
            ?>
            <?php if (count($albums) != 0): ?>
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
                                <?php $album["year"] = date('Y', strtotime($album["CreationDate"])); ?>
                                <h3 class="track-length"><?php echo $album["year"]; ?> - <?php echo $album["TimeLength"]; ?></h3>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($albums) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="albums" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p>There are no albums here.</p>
            <?php endif; ?>
        </section>
        <section class="discover-section">
            <h2>New playlists</h2>
            <?php
                if (isset($_SESSION["username"])) {
                    $playlists = $dbh->getLatestPlaylists($nPreviewsToShow, 0, $_SESSION["username"]);
                } else {
                    $playlists = $dbh->getLatestPlaylists($nPreviewsToShow);
                }
            ?>
            <?php if (count($playlists) != 0): ?>
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
                                <?php $playlist["year"] = date('Y', strtotime($playlist["CreationDate"])); ?>
                                <h3 class="track-length"><?php echo $playlist["year"]; ?> - <?php echo $playlist["TimeLength"]; ?></h3>
                            </div>
                        </a>
                    </section>
                <?php endforeach; ?>
                <?php if (count($playlists) == $nPreviewsToShow): ?>
                    <form action="#" method="GET">
                        <input id="playlists" class="show-more" type="button" value="Show more"/>
                    </form>
                <?php endif; ?>
            <?php else: ?>
                <p>There are no playlists here.</p>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</main>
<script src="js/discover.js"></script>