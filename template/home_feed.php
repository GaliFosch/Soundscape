<main>
    <?php foreach ($template["posts"] as $post): ?>
        <article>
            <?php $user = $dbh->getPostAuthor($post["PostID"]); ?>
            <h1>
                <?php if ($user["ProfileImage"] != null): ?>
                    <img class="picture" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
                <?php else: ?>
                    <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php endif; ?>
                <?php echo $user["Username"]; ?>
            </h1>
            <p><?php echo $post["Caption"]; ?></p>
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
                <a href="#" aria-label="Comment post" title="Comment post"><em class="fa-regular fa-message"></em></a>
                <a href="#" aria-label="Like post" title="Like post"><em class="fa-solid fa-heart"></em></a>
            </section>
        </article>
    <?php endforeach; ?>
</main>
