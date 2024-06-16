<main>
    <section id="notification_list">
        <header>
            <h2>Notification List</h2>
        </header>
        <?php foreach ($template["notifications"] as $notif): ?>
            <article id="<?php echo $notif["NotificationID"]?>" class="notification">
                <em class="fa-solid fa-xmark close"></em>
                <div>
                    <?php switch($notif["Type"]):
                            case 'Follower': ?>
                                <h3>New Follower</h3>
                                <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>"><?php echo $notif["TriggeringUser"]?></a> just started following you!<br/> you're becoming famous</p>
                            <?php break; ?>
                            <?php case 'Post':?>
                                <h3>New Post</h3>
                                <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>"><?php echo $notif["TriggeringUser"]?></a> just published an awesome post!</p>
                                <a href="#">click hear to check it out</a>
                            <?php break;?>
                            <?php case 'Post_Interaction':?>
                                <h3>Post interaction</h3>
                                <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>"><?php echo $notif["TriggeringUser"]?></a> interacted with one of your post!</p>
                                <a href="#">click hear to check it out</a>
                            <?php break;?>
                            <?php case 'Reply':?>
                                <h3>New Reply</h3>
                                <p>The user <a href="profile.php?profile=<?php echo $notif["TriggeringUser"]?>"><?php echo $notif["TriggeringUser"]?></a> replied to one of your comments!</p>
                                <a href="#">click hear to check it out</a>
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