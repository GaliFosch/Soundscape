<?php

require_once("bootstrap.php");

unset($_SESSION["username"]);
unset($_SESSION["loginString"]);
header("Location: index.php");
