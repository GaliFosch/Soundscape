<main>
    <header>
        <h1>Notifications</h1>
    </header>
    <section id="notification_list">
        <?php foreach ($template["notifications"] as $notif): ?>
            <article id="<?php echo $notif["NotificationID"]?>" class="notification">
                <em class="fa-solid fa-xmark close"></em>
                <div>
                    <?php switch($notif["Type"]):
                            case 'Follower': ?>
                                <h3>New Follower</h3>
                                <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>">@<?php echo $notif["TriggeringUser"]?></a> has just started following you!<br/> You're becoming famous.</p>
                            <?php break; ?>
                            <?php case 'Post':?>
                                <h3>New Post</h3>
                                <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>">@<?php echo $notif["TriggeringUser"]?></a> has just published an awesome post!</p>
                                <a href="single_post.php?id=<?php echo $notif["PostID"]?>">Click here to check it out</a>
                            <?php break;?>
                            <?php case 'Like':?>
                                <h3>Like</h3>
                                <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>">@<?php echo $notif["TriggeringUser"]?></a> has liked one of your posts!</p>
                                <a href="single_post.php?id=<?php echo $notif["PostID"]?>">Click here to see the post</a>
                            <?php break;?>
                        <?php case 'Comment':?>
                            <h3>Comment</h3>
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
    </section>
</main>