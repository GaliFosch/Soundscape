<?php

require_once("bootstrap.php");

unset($_SESSION["username"]);
header("Location: index.php");
