<?php

require_once("..\bootstrap.php");

$template["stylesheets"] = ["index.css"];

$postID = $_GET["post"];

$comments = $dbh->getAllComments($postID);
$likes = $dbh->getAllLikes($postID);
if(isset($_SESSION['username'])) {
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
        <form class="comment-form" action="template/process_comment.php?post=<?php echo $postID; ?>" method="POST" post-id="<?php echo $postID; ?>">
        <?php if ($user["ProfileImage"] != null): ?>
                <img class="picture comment-form" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
            <?php else: ?>
                <img class="picture comment-form" src="images/placeholder-image.jpg" alt="User profile image"/>
        <?php endif; ?>
        <label for="write-comment">Write your comment:</label>
        <textarea class="comment-text" name="comment-text" id="write-comment" placeholder="Write here your comment" rows="3" wrap="hard"></textarea>
        <button type="submit">
            <em class="fa-regular fa-paper-plane"></em>
        </button>
        </form>
    </section>
    <?php endif; ?>

    <!--Commenti degli altri-->
    <?php if(sizeof($comments)==0): ?>
        <p class="no-comments"> Looks like no left a comment yet.
            Be the first!
        </p>
    <?php endif; ?>
    
    <?php foreach ($comments as $comm): ?> 
        <article class="people-comment">
        <?php $creator = $dbh->getUserByUsername($comm["Username"])?>
        <?php if ($creator["ProfileImage"] != null): ?>
                <img class="picture" src="<?php echo $creator["ProfileImage"]; ?>" alt="Comment creator profile image"/>
            <?php else: ?>
                <img class="picture" src="images/placeholder-image.jpg" alt="Comment creator profile image"/>
        <?php endif; ?>
        <section class="comment-text">
            <p><b><?php echo $creator["Username"]?></b></p>
            <p><?php echo $comm["CommentText"]?></p>
        </section>
        
    </article>
    <?php endforeach; ?>
</div>


<div class="likes">
    <?php if(sizeof($likes)==0): ?>
        <p class="no-likes"> Looks like no left a like yet.
            Be the first!
        </p>
    <?php endif; ?>
    <?php foreach ($likes as $like): ?> 
    <article class="people-like">
        <?php $creator = $dbh->getUserByUsername($like["Username"])?>
        <?php if ($creator["ProfileImage"] != null): ?>
                <img class="picture" src="<?php echo $creator["ProfileImage"]; ?>" alt="Comment creator profile image"/>
            <?php else: ?>
                <img class="picture" src="images/placeholder-image.jpg" alt="Comment creator profile image"/>
        <?php endif; ?>
        <p><b><?php echo $creator["Username"]?></b></p>
        <?php if($creator["Username"] != $user["Username"]): ?>
            <em class="fa-solid fa-user-plus"></em>
            <em class="fa-solid fa-user-check"></em>
        <?php endif; ?>
    </article>
    <?php endforeach; ?>
</div>
