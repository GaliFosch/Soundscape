<main>
    <header>
        <a href="profile.php?profile=<?php echo $template["author"]["Username"]; ?>">
            <?php if(empty($template["author"]["ProfileImage"])): ?>
                <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
            <?php else: ?>
                <img class="picture" src="<?php echo $template["author"]["ProfileImage"]; ?>" alt="User profile image"/>
            <?php endif;?>
        </a>
        <h1>
            <a href="profile.php?profile=<?php echo $template["author"]["Username"]; ?>">
                <?php echo $template["author"]["Username"]; ?>
            </a>
        </h1>
    </header>
    <?php
        $imgs = $dbh->getImagesFromPost($template["post"]["PostID"]);
        if(sizeof($imgs)>0):
    ?>
    <div class="imgSection">
        <div class="imgContainer">
            <em class="fa-solid fa-angle-left previous"></em>
            <?php foreach($imgs as $img):?>
                <img src="<?php echo $img["PostImage"]; ?>" alt=""/>
            <?php endforeach;?>
            <em class="fa-solid fa-angle-right next"></em>
        </div>
        <footer>
            <?php foreach($imgs as $img):?>
                <em class="fa-solid fa-circle dot"></em>
            <?php endforeach;?>
        </footer>
    </div>
    <script src="js/imageGallery.js"></script>
    <?php endif;?>
    <hr>
    <div id="caption">
        <p><?php echo $template["post"]["Caption"]; ?></p>
    </div>
    <?php if(!empty($template["track"])):?>
        <section class="trackSection">
            <?php if(empty($template["track"]["CoverImage"])): ?>
                <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
            <?php else: ?>
                <img class="picture" src="<?php echo $template["track"]["CoverImage"]; ?>" alt="User profile image"/>
            <?php endif;?>
            <header>
                <h2><?php echo $template["track"]["Name"]; ?></h2>
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
                    <h2><?php echo $template["playlist"]["Name"]; ?></h2>
                </a>
                <p class="author"><a href="profile.php?profile=<?php echo $template["playlist"]["Creator"]; ?>"><?php echo $template["playlist"]["Creator"]; ?></a></p>
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
    <?php $isUserLogged = checkLogin($dbh);?>
    <div class="bottom-container">
        <div class="likeContainer">
            <!-- Comment icon -->
            <?php if ($isUserLogged): ?>
                <em id="comment" class="fa-regular fa-message fa-fw"></em>
            <?php else: ?>
                <a href="login.php" title="Log in to comment posts"><em id="comment" class="fa-regular fa-message fa-fw"></em></a>
            <?php endif; ?>
            <!-- Like icon -->
            <?php if ($isUserLogged): ?>
                <?php if ($dbh->hasUserLiked($template["post"]["PostID"], $_SESSION["username"]) != null): ?>
                    <em id="like" class="fa-solid fa-heart fa-fw"></em>
                <?php else: ?>
                    <em id="like" class="fa-regular fa-heart fa-fw"></em>
                <?php endif; ?>
            <?php else: ?>
                <a href="login.php" title="Log in to like posts"><em id="like" class="fa-regular fa-heart fa-fw"></em></a>
            <?php endif; ?>
            <script src="js/singlePost_like.js"></script>
        </div>
        <div id="commentFormContainer">
            <?php if($isUserLogged):?>
                <h3>New Comment</h3>
                <div class="comment-container">
                    <?php
                        $loggetUser = $dbh->getUserByUsername($_SESSION["username"]);
                        if(empty($loggetUser["ProfileImage"])): 
                    ?>
                        <img class="commentPicture" src="images/placeholder-image.jpg" alt="User profile image"/>
                    <?php else: ?>
                        <img class="commentPicture" src="<?php echo $loggetUser["ProfileImage"]; ?>" alt="User profile image"/>
                    <?php endif;?>
                    <form action="process_singlePost_comment.php" method="POST" id="commentForm">
                        <label for="caption-textarea">Caption</label>
                        <textarea id="caption-textarea" name="caption" rows="5" placeholder="Write here your comment" required></textarea>
                        <input type="hidden" name="postID" value="<?php echo $template["post"]["PostID"]?>">
                        <button type="submit">
                            <em class="fa-regular fa-paper-plane"></em>
                        </button>
                    </form>
                </div>
            <?php endif;?>
        </div>
        <script src="js/singlePost_comment.js"></script>
        <div>
            <?php
                $comments = $dbh->getAllComments($template["post"]["PostID"]);
                foreach($comments as $comment):
            ?>
                <article id="<?php echo $comment["CommentID"]; ?>" class="comment">
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
                    <div>
                        <header>
                            <h3><a href="profile.php?profile=<?php echo $comment["Username"]?>"><?php echo $author["Username"]?></a></h3>
                        </header>
                        <p><?php echo $comment["CommentText"]?></p>
                    </div>
                    <footer>
                        <p><?php echo $comment["CommentTimestamp"]?></p>
                    </footer>
                </article>
            <?php endforeach;?>
        </div>
    </div>
</main>