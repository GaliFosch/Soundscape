<?php

require_once("bootstrap.php");

$preview_type = $_GET["t"];
if (isset($_SESSION["search-query"])) {
    $query_str = $_SESSION["search-query"];
}

if (isset($_GET["show"]))  {
    $previews_to_show = (int) $_GET["show"];
} else {
    $previews_to_show = ALL;
}

if (isset($_GET["skip"])) {
    $previews_to_skip = (int) $_GET["skip"];
} else {
    $previews_to_skip = 0;
}

$show_user_items = isset($template["show-user-items"]);

$previews = array();

switch ($preview_type) {
    case "tracks":
        if ($show_user_items) {
            $tracks = $dbh->getUserLatestTracks($template["profile"]["Username"], $previews_to_show);
        } else {
            $tracks = $dbh->getLatestTracks($previews_to_show, $previews_to_skip);
        }
        foreach ($tracks as $track) {
            $preview["title"] = $track["Name"];
            $preview["author"] = $track["Creator"];
            $preview["image"] = $track["CoverImage"];
            $preview["alt"] = "Click to load the track on the music player";
            $preview["year"] = date('Y', strtotime($track["CreationDate"]));
            $preview["length"] = $track["TimeLength"];
            $preview["link"] = "player.php?trackid=" . $track["TrackID"];
            $previews[] = $preview;
        }
        break;
    case "albums":
        if ($show_user_items) {
            $albums = $dbh->getUserLatestAlbums($template["profile"]["Username"], $previews_to_show);
        } else {
            $albums = $dbh->getLatestAlbums($previews_to_show, $previews_to_skip);
        }
        foreach ($albums as $album) {
            $preview["title"] = $album["Name"];
            $preview["author"] = $album["Creator"];
            $preview["image"] = $album["CoverImage"];
            $preview["alt"] = "Click to open the album";
            $preview["year"] = date('Y', strtotime($album["CreationDate"]));
            $preview["length"] = $album["TimeLength"];
            $preview["link"] = "playlist.php?id=" . $album["PlaylistID"];
            $previews[] = $preview;
        }
        break;
    case "playlists":
        if ($show_user_items) {
            $playlists = $dbh->getUserLatestPlaylists($template["profile"]["Username"], $previews_to_show);
        } else {
            $playlists = $dbh->getLatestPlaylists($previews_to_show, $previews_to_skip);
        }
        foreach ($playlists as $playlist) {
            $preview["title"] = $playlist["Name"];
            $preview["author"] = $playlist["Creator"];
            $preview["image"] = $playlist["CoverImage"];
            $preview["alt"] = "Click to open the playlist";
            $preview["year"] = date('Y', strtotime($playlist["CreationDate"]));
            $preview["length"] = $playlist["TimeLength"];
            $preview["link"] = "playlist.php?id=" . $playlist["PlaylistID"];
            $previews[] = $preview;
        }
        break;
    case "matching-users":
        $users = $dbh->getMatchingUsers($query_str, $previews_to_show, $previews_to_skip);
        foreach ($users as $user) {
            $preview["title"] = $user["Username"];
            $preview["image"] = $user["ProfileImage"];
            $preview["alt"] = "Click to open the profile of the user";
            $preview["link"] = "profile.php?profile=" . $user["Username"];
            $previews[] = $preview;
        }
        break;
    case "matching-tracks":
        $tracks = $dbh->getMatchingTracks($query_str, $previews_to_show, $previews_to_skip);
        foreach ($tracks as $track) {
            $preview["title"] = $track["Name"];
            $preview["author"] = $track["Creator"];
            $preview["image"] = $track["CoverImage"];
            $preview["alt"] = "Click to load the track on the music player";
            $preview["year"] = date('Y', strtotime($track["CreationDate"]));
            $preview["length"] = $track["TimeLength"];
            $preview["link"] = "player.php?trackid=" . $track["TrackID"];
            $previews[] = $preview;
        }
        break;
    case "matching-albums":
        $albums = $dbh->getMatchingAlbums($query_str, $previews_to_show, $previews_to_skip);
        foreach ($albums as $album) {
            $preview["title"] = $album["Name"];
            $preview["author"] = $album["Creator"];
            $preview["image"] = $album["CoverImage"];
            $preview["alt"] = "Click to open the album";
            $preview["year"] = date('Y', strtotime($album["CreationDate"]));
            $preview["length"] = $album["TimeLength"];
            $preview["link"] = "playlist.php?id=" . $album["PlaylistID"];
            $previews[] = $preview;
        }
        break;
    case "matching-playlists":
        $playlists = $dbh->getMatchingPlaylists($query_str, $previews_to_show, $previews_to_skip);
        foreach ($playlists as $playlist) {
            $preview["title"] = $playlist["Name"];
            $preview["author"] = $playlist["Creator"];
            $preview["image"] = $playlist["CoverImage"];
            $preview["alt"] = "Click to open the playlist";
            $preview["year"] = date('Y', strtotime($playlist["CreationDate"]));
            $preview["length"] = $playlist["TimeLength"];
            $preview["link"] = "playlist.php?id=" . $playlist["PlaylistID"];
            $previews[] = $preview;
        }
        break;
}

?>

<?php foreach ($previews as $preview): ?>
    <section class="preview">
        <a href="<?php echo $preview["link"]; ?>">
            <?php if (isset($preview["image"])): ?>
                <img class="picture" src="<?php echo $preview["image"]; ?>" alt="<?php echo $preview["alt"]; ?>"/>
            <?php else: ?>
                <img class="picture" src="images/placeholder-image.jpg" alt="<?php echo $preview["alt"]; ?>"/>
            <?php endif; ?>
            <div class="preview-info">
                <h2 class="preview-title"><?php echo $preview["title"]; ?></h2>
                <?php if (isset($preview["author"])): ?>
                    <h3 class="author"><?php echo $preview["author"]; ?></h3>
                <?php endif; ?>
                <?php if (isset($preview["year"]) && isset($preview["length"])): ?>
                    <h3 class="track-length"><?php echo $preview["year"]; ?> - <?php echo $preview["length"]; ?></h3>
                <?php elseif (isset($preview["year"])): ?>
                    <h3 class="track-length"><?php echo $preview["year"]; ?></h3>
                <?php endif; ?>
            </div>
        </a>
    </section>
<?php endforeach; ?>
<?php if (isset($previews_to_show) && (count($previews) == $previews_to_show)): ?>
    <form action="#" method="GET">
        <input id="<?php echo $preview_type; ?>" class="show-more" type="button" value="Show more"/>
    </form>
<?php endif; ?>
