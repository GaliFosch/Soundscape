<main>
    <header>
        <h1>Notifications</h1>
    </header>
    <div id="notification_list">
        <?php foreach ($template["notifications"] as $notif): ?>
            <article id="<?php echo $notif["NotificationID"]?>" class="notification">
                <em class="fa-solid fa-xmark close"></em>
                <div>
                    <?php switch($notif["Type"]):
                        case 'Follower': ?>
                            <h2>New Follower</h2>
                            <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>">@<?php echo $notif["TriggeringUser"]?></a> has just started following you!<br/> You're becoming famous.</p>
                        <?php break; ?>
                        <?php case 'Post':?>
                            <h2>New Post</h2>
                            <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>">@<?php echo $notif["TriggeringUser"]?></a> has just published an awesome post!</p>
                            <a href="single_post.php?id=<?php echo $notif["PostID"]?>">Click here to check it out</a>
                        <?php break;?>
                        <?php case 'Like':?>
                            <h2>Like</h2>
                            <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>">@<?php echo $notif["TriggeringUser"]?></a> has liked one of your posts!</p>
                            <a href="single_post.php?id=<?php echo $notif["PostID"]?>">Click here to see the post</a>
                        <?php break;?>
                        <?php case 'Comment':?>
                            <h2>Comment</h2>
                            <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>">@<?php echo $notif["TriggeringUser"]?></a> has commented one of your posts!</p>
                            <a href="single_post.php?id=<?php echo $notif["PostID"]?>">Click here to check it out</a>
                        <?php break;?>
                    <?php endswitch; ?>
                </div>
                <footer>
                    <?php echo $notif["NotificationTimestamp"] ?>
                </footer>
            </article>
        <?php endforeach; ?>
        <script src="js/notification.js"></script>
    </div>
</main>