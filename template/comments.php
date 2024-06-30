<?php

require_once("..\bootstrap.php");

$template["stylesheets"] = ["index.css"];

$postID = $_GET["post"];

$comments = $dbh->getAllComments($postID);
$likes = $dbh->getAllLikes($postID);
if(checkLogin($dbh)) {
    $user = $dbh->getUserByUsername($_SESSION["username"]);
} else {
    $user = null;
}

?>


<em class="fa-solid fa-xmark close-comment"></em>
<section class="interaction-changer">
    <section class="comment-changer-section selected">
        <em class="fa-regular fa-message fa-fw comment-changer"></em>
        <p><?php echo sizeof($comments) ?></p>
    </section>
    <div class="separator"></div>
    <section class=" like-changer-section">   
        <em class="fa-regular fa-heart fa-fw like-changer"></em>
        <p><?php echo sizeof($likes) ?></p>
    </section>
    
</section>

<div class="comments">
    <?php if(isset($_SESSION['username'])): ?>
    <!--Inserisci il tuo commento-->
    <section class="user-comment">
        <form class="comment-form" action="process_comment.php?post=<?php echo $postID; ?>" method="POST" id="<?php echo $postID; ?>">
        <?php if ($user["ProfileImage"] != null): ?>
                <img class="profile-picture comment-form" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
            <?php else: ?>
                <img class="profile-picture comment-form" src="images/placeholder-image.jpg" alt="User profile image"/>
        <?php endif; ?>
        <label for="write-comment">Write your comment:</label>
        <textarea class="comment-text" name="comment-text" id="write-comment" placeholder="Write here your comment" rows="3" wrap="hard" required></textarea>
        <button type="submit">
            <em class="fa-regular fa-paper-plane send-comment"></em>
        </button>
        </form>
    </section>
    <?php endif; ?>

    <!--Commenti degli altri-->
    <?php if(sizeof($comments)==0): ?>
        <p class="no-comments"> Looks like no one left a comment yet.
            Be the first!
        </p>
    <?php endif; ?>
    
    <?php foreach ($comments as $comm): ?> 
        <article class="people-comment">
        <a href="profile.php?profile=<?php echo $comm["Username"]; ?>" class="redirect">
            <?php $creator = $dbh->getUserByUsername($comm["Username"])?>
            <?php if ($creator["ProfileImage"] != null): ?>
                    <img class="profile-picture" src="<?php echo $creator["ProfileImage"]; ?>" alt="Comment creator profile image"/>
                <?php else: ?>
                    <img class="profile-picture" src="images/placeholder-image.jpg" alt="Comment creator profile image"/>
            <?php endif; ?>
           
        </a>
        <section class="comment-text"> 
            <a href="profile.php?profile=<?php echo $comm["Username"]; ?>" class="redirect">
                <p><b><?php echo $creator["Username"]?></b></p>
            </a>
                <p><?php echo $comm["CommentText"]?></p>
        </section>
        <p class="timestamp"><?php echo $comm["CommentTimestamp"]; ?></p>
    </article>
    <?php endforeach; ?>
</div>


<div class="likes">
    <?php if(sizeof($likes)==0): ?>
        <p class="no-likes"> Looks like no one left a like yet.
            Be the first!
        </p>
    <?php endif; ?>
    <?php foreach ($likes as $like): ?> 
    <article class="people-like">
        <?php $creator = $dbh->getUserByUsername($like["Username"])?>
        <?php if ($creator["ProfileImage"] != null): ?>
                <img class="profile-picture" src="<?php echo $creator["ProfileImage"]; ?>" alt="Comment creator profile image"/>
            <?php else: ?>
                <img class="profile-picture" src="images/placeholder-image.jpg" alt="Comment creator profile image"/>
        <?php endif; ?>
        <a href="profile.php?profile=<?php echo $creator["Username"]; ?>" class="redirect">
                <p><b><?php echo $creator["Username"]?></b></p>
            </a>
        <?php if($creator["Username"] != $user["Username"]): ?>
             <?php if($dbh->isFollowing($_SESSION["username"], $creator["Username"])):?>
                    <button id="follow - <?php echo $creator['Username']?>" type="button"><em id="follow" class="fa-solid fa-user-check"></em></button>
                <?php else:?>
                    <button id="follow - <?php echo $creator['Username']?>" type="button"><em id="follow" class="fa-solid fa-user-plus"></em></button>
                <?php endif?>
        <?php endif; ?>
    </article>
    <?php endforeach; ?>
</div>
<script src="js/index.js"></script>