<main>
    <?php foreach ($template["posts"] as $post): ?>
        <article class="post-article">
            <?php $user = $dbh->getPostAuthor($post["PostID"]); ?>
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
            <?php $track = $dbh->getSponsoredTrack($post["PostID"]); ?>
            <?php if ($track != null): ?>
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
            <?php endif; ?>
            </section>
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
</main>

<script src="js/index.js"></script>
