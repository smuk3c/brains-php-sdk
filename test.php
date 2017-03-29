<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once( "vendor/autoload.php");

$api = file_exists("./local.php")
    ? require("./local.php")
    : "";

try {

    $user = new \Brains\Users($api["api_key"], $api["app_id"]);

    $user->setVal("email", "leo@studioface.si");
    $user->setVal("last_name", "s");
    $user->setVal("birthday", "1990-01-18");
    $user->setVal("gender", "male");
    $user->setVal("country", "SI");


    echo "<pre>";
    print_r($user->add());
    echo "</pre>";

} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
