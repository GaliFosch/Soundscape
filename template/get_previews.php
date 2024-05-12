<?php

require_once("..\bootstrap.php");

$preview_type = $_GET["type"];
$query_str = $_SESSION["search-query"];
$previews_to_show = (int) $_GET["show"];
$previews_to_skip = (int) $_GET["skip"];
$previews = array();

switch ($preview_type) {
    case "new-tracks":
        $tracks = $dbh->getLatestTracks($previews_to_show, $previews_to_skip);
        foreach ($tracks as $track) {
            $preview["title"] = $track["Name"];
            $preview["image"] = $track["CoverImage"];
            $preview["link"] = "player.php?trackid=" . $track["TrackID"];
            $previews[] = $preview;
        }
        break;
    case "new-albums":
        $albums = $dbh->getLatestAlbums($previews_to_show, $previews_to_skip);
        foreach ($albums as $album) {
            $preview["title"] = $album["Name"];
            $preview["image"] = $album["CoverImage"];
            $preview["link"] = "#";
            $previews[] = $preview;
        }
        break;
    case "new-playlists":
        $playlists = $dbh->getLatestPlaylists($previews_to_show, $previews_to_skip);
        foreach ($playlists as $playlist) {
            $preview["title"] = $playlist["Name"];
            $preview["image"] = $playlist["CoverImage"];
            $preview["link"] = "#";
            $previews[] = $preview;
        }
        break;
    case "matching-users":
        $users = $dbh->getMatchingUsers($query_str, $previews_to_show, $previews_to_skip);
        foreach ($users as $user) {
            $preview["title"] = $user["Username"];
            $preview["image"] = $user["ProfileImage"];
            $preview["link"] = "#";
            $previews[] = $preview;
        }
        break;
    case "matching-tracks":
        $tracks = $dbh->getMatchingTracks($query_str, $previews_to_show, $previews_to_skip);
        foreach ($tracks as $track) {
            $preview["title"] = $track["Name"];
            $preview["image"] = $track["CoverImage"];
            $preview["link"] = "player.php?trackid=" . $track["TrackID"];
            $previews[] = $preview;
        }
        break;
    case "matching-albums":
        $albums = $dbh->getMatchingAlbums($query_str, $previews_to_show, $previews_to_skip);
        foreach ($albums as $album) {
            $preview["title"] = $album["Name"];
            $preview["image"] = $album["CoverImage"];
            $preview["link"] = "#";
            $previews[] = $preview;
        }
        break;
    case "matching-playlists":
        $playlists = $dbh->getMatchingPlaylists($query_str, $previews_to_show, $previews_to_skip);
        foreach ($playlists as $playlist) {
            $preview["title"] = $playlist["Name"];
            $preview["image"] = $playlist["CoverImage"];
            $preview["link"] = "#";
            $previews[] = $preview;
        }
        break;
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
<?php if (count($previews) == $previews_to_show): ?>
    <form action="#" method="GET">
        <input id="<?php echo $preview_type; ?>" class="show-more" type="button" value="Show more"/>
    </form>
<?php endif; ?>
