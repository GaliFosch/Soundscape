<?php

require_once("..\bootstrap.php");

$query = $_GET["query"];

$results = $dbh->getSuggestedTracks($query);

header('Content-Type: application/json; charset=utf-8');
echo json_encode($results);