<header>
    <?php if (isset($template["playlist"]["CoverImage"])): ?>
        <img src="<?php echo $template["playlist"]["CoverImage"]; ?>" alt="" />
    <?php else: ?>
        <img src="images/placeholder-image.jpg" alt="" />
    <?php endif; ?>
    <div class="playlist-details">
        <h1 id="title"><?php echo $template["playlist"]["Name"]; ?></h1>
        <h2 id="author"><?php echo $template["playlist"]["Creator"]; ?></h2>
        <h3 id="date-and-length"><?php echo "{$template["playlist"]["CreationDate"]} - {$template["playlist"]["TimeLength"]}"; ?></h3>
    </div>
    <div id="audio-controls">
        <button id="play-button"><img src="images/play-icon.svg" alt="Play"/></button>
        <em class="fa-solid fa-shuffle fa-2x"></em>
    </div>
    <hr>
    <section id="tracklist">
        <?php foreach ($template["tracklist"] as $track): ?>
            <section class="tracklist-item">
                <p class="track-position"><?php echo $track["position"]; ?></p>
                <div class="track-details">
                    <strong class="track-title"><?php echo $track["Name"]; ?></strong>
                    <p class="author"><?php echo $track["Creator"]; ?></p>
                </div>
                <p class="track-length"><?php echo $track["TimeLength"]; ?></p>
            </section>
        <?php endforeach; ?>
    </section>
</header>
