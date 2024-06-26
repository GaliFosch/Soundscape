<main>
    <header>
        <a href="profile.php?profile=<?php echo $template["author"]["Username"]; ?>">
            <?php if(empty($template["author"]["ProfileImage"])): ?>
                <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
            <?php else: ?>
                <img class="picture" src="<?php echo $template["author"]["ProfileImage"]; ?>" alt="User profile image"/>
            <?php endif;?>
        </a>
        <h2>
            <a href="profile.php?profile=<?php echo $template["author"]["Username"]; ?>">
                <?php echo $template["author"]["Username"]; ?>
            </a>
        </h2>
    </header>
    <?php
        $imgs = $dbh->getImagesFromPost($template["post"]["PostID"]);
        if(sizeof($imgs)>0):
    ?>
    <section class="imgSection">
        <div class="imgContainer">
            <?php foreach($imgs as $img):?>
                <img src="<?php echo $img["PostImage"]; ?>"/>
            <?php endforeach;?>
        </div>
        <footer>
            <?php foreach($imgs as $img):?>
                <em class="fa-solid fa-circle dot"></em>
            <?php endforeach;?>
        </footer>
    </section>
    <script src="js/imageGallery.js"></script>
    <?php endif;?>
    <section>
        <p><?php echo $template["post"]["Caption"]; ?></p>
    </section>
    <?php if(!empty($template["track"])):?>
        <section class="trackSection">
            <?php if(empty($template["track"]["CoverImage"])): ?>
                <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
            <?php else: ?>
                <img class="picture" src="<?php echo $template["track"]["CoverImage"]; ?>" alt="User profile image"/>
            <?php endif;?>
            <header>
                <h3><?php echo $template["track"]["Name"]; ?></h3>
                <p>
                    <a href="profile.php?profile=<?php echo $template["track"]["Creator"]; ?>">
                        <?php echo $template["track"]["Creator"]; ?>
                    </a>
                </p>
            </header>
            <a href="player.php?trackid=<?php echo $template["track"]["TrackID"]; ?>" aria-label="Play track on player" title="Play track on player">
                <em class="fa-solid fa-play"></em>
            </a>
        </section>
    <?php elseif(!empty($template["playlist"])):?>
        <section class="playlistSection">
            <a href="playlist.php?id=<?php echo $template["playlist"]["PlaylistID"];?>">
            <?php if(empty($template["playlist"]["CoverImage"])): ?>
                <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
            <?php else: ?>
                <img class="picture" src="<?php echo $template["playlist"]["CoverImage"]; ?>" alt="User profile image"/>
            <?php endif;?>
            </a>
            <div>
                <a href="playlist.php?id=<?php echo $template["playlist"]["PlaylistID"];?>">
                    <h3><?php echo $template["playlist"]["Name"]; ?></h3>
                </a>
                <p><a href="profile.php?profile=<?php echo $template["playlist"]["Creator"]; ?>"><?php echo $template["playlist"]["Creator"]; ?></a></p>
                <p>
                    <?php 
                        if($template["playlist"]["IsAlbum"] === "1"){
                            echo "Album";
                        }else{
                            echo "Playlist";
                        }
                    ?>
                </p>
            </div>
        </section>
    <?php endif;?>
    <section>
        <div class="likeContainer">
            <em id="comment" class="fa-regular fa-message fa-fw"></em>
            <em id="like" class="fa-regular fa-heart fa-fw"></em>
            <script src="js/singlePost_like.js"></script>
        </div>
        <div id="commentFormContainer">
            <h3>New Comment</h3>
            <form action="process_singlePost_comment.php" method="POST" id="commentForm">
                <label for="caption">Caption</label>
                <textarea name="caption" rows="5" placeholder="Write here your comment" required></textarea>
                <input type="text" name="postID" value="<?php echo $template["post"]["PostID"]?>" hidden>
                <button type="submit">
                    <em class="fa-regular fa-paper-plane"></em>
                </button>
            </form>
        </div>
        <script src="js/singlePost_comment.js"></script>
        <div>
            <?php
                $comments = $dbh->getAllComments($template["post"]["PostID"]);
                foreach($comments as $comment):
            ?>
                <article id="<?php echo $comment["CommentID"]?>" class = "comment">
                    <header>
                        <a href="profile.php?profile=<?php echo $comment["Username"]?>">
                            <?php
                                $author = $dbh->getUserByUsername($comment["Username"]);
                                if(empty($author["ProfileImage"])): 
                            ?>
                                <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                            <?php else: ?>
                                <img class="picture" src="<?php echo $author["ProfileImage"]; ?>" alt="User profile image"/>
                            <?php endif;?>
                        </a>
                        <a href="profile.php?profile=<?php echo $comment["Username"]?>"></a>
                        <h3><a href="profile.php?profile=<?php echo $comment["Username"]?>"><?php echo $author["Username"]?></a></h3>
                    </header>
                    <p><?php echo $comment["CommentText"]?></p>
                    <footer>
                        <p><?php echo $comment["CommentTimestamp"]?></p>
                    </footer>
                </article>
            <?php endforeach;?>
        </div>
    </section>
</main>