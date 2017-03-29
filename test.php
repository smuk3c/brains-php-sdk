<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once( "vendor/autoload.php");

$apiKey = file_exists("./local.php")
    ? require("./local.php")
    : "";

$users = new \Brains\Users($apiKey);