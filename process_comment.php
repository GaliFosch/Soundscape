<?php

require_once("bootstrap.php");

$postID = $_GET["post"];
$text = $_POST["comment-text"];
$user = $dbh->getUserByUsername($_SESSION["username"]);

$id = $dbh->addComment($text,$user["Username"],$postID);

$comm = $dbh->getCommentFromId($id);
?>

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