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

    $user->setFbId("100008000");
    $user->setFbId("100008000");
    $user->setPuschrewId("10000000");
    $user->setPuschrewId("10000000");
    $user->setPhoneNumber("040527265");
    $user->setPhoneNumber("386040527265");
    $user->setPhoneNumber("38640527265");
    $user->setPhoneNumber("386405272651");

    $user->setSubscription(false, "192.168.1.1", NULL, date("Y-m-d H:i:s"));
    $user->setSubscription(true, "192.168.1.1", NULL, date("Y-m-d H:i:s"));

    echo "<pre>";
//    print_r($user->add());
    print_r($user->getByPushcrewId("10000000"));
    echo "</pre>";



} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
