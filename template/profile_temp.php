<main>
    <header>
        <div class = "profileImageContainer">
            <?php 
                if (!empty($template["profile"]["ProfileImage"])){
                    $img = $template["profile"]["ProfileImage"];
                } else {
                    $img = "images/placeholder-image.jpg";
                }

            ?>
            <img id="ProfileImage" src="<?php echo $img?>" 
                <?php
                    if($template["isProfileLogged"]){
                        echo "class = \"showEditButton\"";
                    }
                ?>
                alt="Profile Image"/>
            <?php if($template["isProfileLogged"]):?>
                <em id="EditProfileImage" class="fa-solid fa-pencil"></em>
                <script src="js/editProfileImage.js"></script>
            <?php endif;?>
        </div>
        <h2><?php echo $template["profile"]["Username"]?></h2>
    </header>
    <?php if($template["isProfileLogged"]):?>
        <div id="ImageEditContainer">
            <form action="#" id="ImageEditForm" enctype="multipart/form-data">
                <label for="NewImg">Insert your new profile image</label>
                <input type="file" name="img" id="NewImg" accept="img/*" required/>
                <div>
                    <input type="submit" value="Confirm">
                    <button id="UndoImgEdit" class="profile-button">Cancel</button>
                </div>
            </form>
        </div>
    <?php endif;?>
    <?php if(!$template["isProfileLogged"]):?>
        <?php if($template["isUserLogged"]):?>
            <div>
                <?php if($dbh->isFollowing($_SESSION["username"], $template["profile"]["Username"])):?>
                    <button id="follow-button" type="button"><em id="follow" class="fa-solid fa-user-check" aria-hidden="true"></em>Following</button>
                <?php else:?>
                    <button id="follow-button" type="button"><em id="follow" class="fa-solid fa-user-plus" aria-hidden="true"></em>Follow</button>
                <?php endif?>
            </div>
            <script src="js/follow.js"></script>
        <?php else:?>
            <div>
                <a href="login.php" title="Log in or register to follow this user"><em id="follow" class="fa-solid fa-user-plus" aria-hidden="true"></em></a>
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
            <?php if($template["isProfileLogged"]):?>
                <button id="EditBiograpy" class="profile-button">Edit</button>
            <?php endif?>
        </header>
        <p>
            <?php echo $template["profile"]["Biography"]?>
        </p>
        <?php if($template["isProfileLogged"]):?>
            <form action="#" id="BiographyForm">
                <label for="bio" hidden>Biography</label>
                <textarea name="bio" id="bio" placeholder="Write your biography here" rows="5" required></textarea>
                <div>
                    <input type="submit" value="Confirm"/>
                    <button id="bioEditUndo" class="profile-button">Cancel</button>
                </div>
            </form>
            <script src="js/editBiography.js"></script>
        <?php endif?>
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
                    <article class="card">
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
                    <article class="card">
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
                    <article class="card">
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
        <header class="section-header">
            <h3 class="section-title">Best Posts</h3>
            <?php if (count($playlists) != 0): ?>
                <div class="show-all-btn-container"><a href="list.php?t=posts&profile=<?php echo $template["profile"]["Username"]; ?>">Show All</a></div>
            <?php endif; ?>
        </header>
        <?php require("post_template.php"); ?>
    </section>
    <script src="js/index.js"></script>
</main>