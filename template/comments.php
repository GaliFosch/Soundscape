<?php

require_once("..\bootstrap.php");

$template["stylesheets"] = ["index.css"];

$postID = $_GET["post"];

$comments = $dbh->getAllComments($postID);
$likes = $dbh->getAllLikes($postID);
$user = $dbh->getUserByUsername($_SESSION["username"]);
?>


    <em class="fa-solid fa-xmark close-focus"></em>
    <section class="interaction-changer">
        <em class="fa-regular fa-message fa-fw comment-changer"></em>
        <em class="fa-regular fa-heart fa-fw like-changer"></em>
    </section>

    <div class="comments">
        <!--Inserisci il tuo commento-->
        <section class="user-comment">
            <form action="process_comment.php">
            <?php if ($user["ProfileImage"] != null): ?>
                    <img class="picture comment-form" src="<?php echo $user["ProfileImage"]; ?>" alt="User profile image"/>
                <?php else: ?>
                    <img class="picture comment-form" src="images/placeholder-image.jpg" alt="User profile image"/>
            <?php endif; ?>
            <textarea name="" id="" placeholder="Write here your comment" rows="3"></textarea>
            <em class="fa-regular fa-paper-plane"></em>
        </section>

        <!--Commenti degli altri-->
       
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
        <?php foreach ($likes as $like): ?> 
        <article class="people-like">
            <?php $creator = $dbh->getUserByUsername($like["Username"])?>
            <?php if ($creator["ProfileImage"] != null): ?>
                    <img class="picture" src="<?php echo $creator["ProfileImage"]; ?>" alt="Comment creator profile image"/>
                <?php else: ?>
                    <img class="picture" src="images/placeholder-image.jpg" alt="Comment creator profile image"/>
            <?php endif; ?>
            <p><b><?php echo $creator["Username"]?></b></p>
            <em class="fa-solid fa-user-plus"></em>
            <em class="fa-solid fa-user-check"></em>
        </article>
        <?php endforeach; ?>
    </div>
    