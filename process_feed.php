<?php 
require_once("bootstrap.php");

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

$template["posts"] = $dbh->getPersonalizedHomeFeed($_SESSION["username"], $previews_to_show, $previews_to_skip);

require("template/post_template.php");