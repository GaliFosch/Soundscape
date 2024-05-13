<main>
    <?php foreach ($template["posts"] as $post): ?>
        <article class="open-focus">
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
                <a href="#" aria-label="Comment post" title="Comment post"><em class="fa-regular fa-message fa-fw"></em></a>
                <em class="fa-regular fa-heart fa-fw"></em>
            </section>
        </article>
    <?php endforeach; ?>
</main>

<aside>
    <em class="fa-solid fa-xmark close-focus"></em>
    <h1>
        <img class="profile-picture" src="images/placeholder-image.jpg" alt="User profile image"/>
        Utente
        <span>gg/mm/aaaa</span>
    </h1>

    <p>Ho appena ascoltato questa canzone, TOP TIER! 
        Ascoltatela tutti!
    </p>
    <section class="music-box focus">
        <img class="song focus" src="images/placeholder-image.jpg" alt="Song cover image"/>
        <a href="#" class="music-player focus"><em class="fa-solid fa-play focus"></em></a>
        <!--Inner section delle info della music-->
        <section class="music-info focus">
            <p class="info focus"><b>The Cat</b></p>
            <p class="info focus">Cat Lover</p>
        </section>
    </section>

    <section class="post-interaction focus">
        <a href="#"><em class="fa-regular fa-message focus"></em></a>
        <em class="fa-regular fa-heart focus"></em>
    </section>

    <section class="artist-info">
        <h2 class="info">Informazioni sull'artista</h2>
        <img class="artist-photo" src="images/placeholder-image.jpg" alt="User profile image"/>
        <em class="fa-solid fa-user-plus"></em>
        <em class="fa-solid fa-user-check"></em>
        <p class="artist-name"><b>Cat Girl</b></p>
        <p class="artist-description">Lorem ipsum dolor sit amet, consectetur adipisci elit, sed do eiusmod tempor incidunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrum exercitationem ullamco laboriosam, nisi ut aliquid ex ea commodi consequatur.</p>
    <!--Outer section of music box-->
</aside>

<script src="js/index.js"></script>
