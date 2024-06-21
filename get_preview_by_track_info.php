<?php

require_once("bootstrap.php");

$track = $dbh->getTrackByTitleAndAuthor($_GET["title"], $_GET["author"]);

?>

<section class="preview">
    <a href="#">
        <?php if (isset($track["CoverImage"])): ?>
            <img class="picture" src="<?php echo $track["CoverImage"]; ?>" alt=""/>
        <?php else: ?>
            <img class="picture" src="images/placeholder-image.jpg" alt=""/>
        <?php endif; ?>
        <div class="preview-info">
            <h3 class="preview-title"><?php echo $track["Name"]; ?></h3>
            <h3 class="author"><?php echo $track["Creator"]; ?></h3>
        </div>
    </a>
</section>
