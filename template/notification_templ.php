<main>
    <section>
        <h2>Notification List</h2>

        <?php foreach ($template["notifications"] as $notif):?>
            <article>
                <h3><?php echo $notif["NotificationID"];?></h3>
                <footer><?php echo $notif["NotificationTimestamp"];?></footer>
            </article>
        <?php endforeach;?>
    </section>
</main>