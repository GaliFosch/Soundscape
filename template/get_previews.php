<?php

require_once("..\bootstrap.php");

$preview_type = $_GET["type"];
$previewsToShow = (int) $_GET["show"];
$previewsToSkip = (int) $_GET["skip"];
$previews = array();

switch ($preview_type) {
    case "new-tracks":
        $tracks = $dbh->getLatestTracks($previewsToShow, $previewsToSkip);
        foreach ($tracks as $track) {
            $preview["title"] = $track["Name"];
            $preview["image"] = $track["CoverImage"];
            $preview["link"] = "player.php?trackid=" . $track["TrackID"];
            $previews[] = $preview;
        }
}

?>

<?php foreach ($previews as $preview): ?>
    <section class="preview">
        <a href="<?php echo $preview["link"]; ?>">
            <?php if (isset($preview["image"])): ?>
                <img class="picture" src="<?php echo $preview["image"] ?>" alt="Track cover image"/>
            <?php else: ?>
                <img class="picture" src="images/placeholder-image.jpg" alt="Track cover image"/>
            <?php endif; ?>
            <h3><?php echo $preview["title"] ?></h3>
        </a>
    </section>
<?php endforeach; ?>
<?php if (count($previews) == $previewsToShow): ?>
    <form action="#" method="GET">
        <input id="<?php echo $preview_type; ?>" class="show-more" type="button" value="Show more"/>
    </form>
<?php endif; ?>
