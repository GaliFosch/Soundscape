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
</header>