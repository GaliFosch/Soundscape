<main>
    <header>
        <?php if(empty($template["author"]["ProfileImage"])): ?>
            <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
        <?php else: ?>
            <img class="picture" src="<?php echo $template["author"]["ProfileImage"]; ?>" alt="User profile image"/>
        <?php endif;?>
        <h2><?php echo $template["author"]["Username"]; ?></h2>
    </header>
    <section>
        <p><?php echo $template["post"]["Caption"]; ?></p>
        <?php if(!empty($template["track"])):?>
            <div class="trackSection">
                <?php if(empty($template["track"]["CoverImage"])): ?>
                    <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php else: ?>
                    <img class="picture" src="<?php echo $template["track"]["CoverImage"]; ?>" alt="User profile image"/>
                <?php endif;?>
                <header>
                    <h3><?php echo $template["track"]["Name"]; ?></h3>
                    <p><?php echo $template["track"]["Creator"]; ?></p>
                </header>
            </div>
        <?php elseif(!empty($template["plailist"])):?>
            <div class="playlistSection">
                <?php if(empty($template["playlist"]["CoverImage"])): ?>
                    <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                <?php else: ?>
                    <img class="picture" src="<?php echo $template["playlist"]["CoverImage"]; ?>" alt="User profile image"/>
                <?php endif;?>
            </div>
        <?php endif;?>
    </section>
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
                        <?php
                            $author = $dbh->getUserByUsername($comment["Username"]);
                            if(empty($author["ProfileImage"])): 
                        ?>
                            <img class="picture" src="images/placeholder-image.jpg" alt="User profile image"/>
                        <?php else: ?>
                            <img class="picture" src="<?php echo $author["ProfileImage"]; ?>" alt="User profile image"/>
                        <?php endif;?>
                        <h3><?php echo $author["Username"]?></h3>
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