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
    <h1 id="discover-title">Discover</h1>
    <?php if (isset($_GET["query"]) && ($_GET["query"] != "")): ?>
        <section class="content-container">
            <h2>Users</h2>
            <?php $users = $dbh->getMatchingUsers($_GET["query"]); ?>
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
            <h2>Tracks</h2>
            <!-- TODO -->
            <h2>Albums</h2>
            <!-- TODO -->
        </section>
    <?php else: ?>
        <section class="content-container">
            <h2>New tracks</h2>
            <?php $tracks = $dbh->getLatestTracks(10); ?>
            <?php foreach ($tracks as $track): ?>
                <section class="preview">
                    <a href="player.php?trackid=<?php echo $track["TrackID"]; ?>">
                        <?php if (isset($track["CoverImage"])): ?>
                            <img class="picture" src="<?php echo $track["CoverImage"]; ?>" alt="Track cover image"/>
                        <?php else: ?>
                            <img class="picture" src="images/placeholder-image.jpg" alt="Track cover image"/>
                        <?php endif; ?>
                        <h3><?php echo $track["Name"]; ?></h3>
                    </a>
                </section>
            <?php endforeach; ?>
            <h2>New albums</h2>
            <?php $albums = $dbh->getLatestAlbums(10); ?>
            <?php foreach ($albums as $album): ?>
                <section class="preview">
                    <a href="#">
                        <?php if (isset($album["CoverImage"])): ?>
                            <img class="picture" src="<?php echo $album["CoverImage"]; ?>" alt="Album cover image"/>
                        <?php else: ?>
                            <img class="picture" src="images/placeholder-image.jpg" alt="Album cover image"/>
                        <?php endif; ?>
                        <h3><?php echo $album["Name"]; ?></h3>
                    </a>
                </section>
            <?php endforeach; ?>
        </section>
    <?php endif; ?>
</main>