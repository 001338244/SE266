<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 11/8/2017
 * Time: 1:19 PM
 */


include_once ("assets/header.html");
include_once ("assets/dbconn.php");
require_once ("assets/functionsToGetStuffDone.php");
include_once ("assets/HtmlInputForm.php");

$db = dbconn();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$link = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$site = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$sites = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";

$date = date('m/d/y h:i:s', time());

switch ( $action ) {
    case "Add":
        echo $link, $site, $date;
        checkDb($db, $link, $date, $site);
        break;
}




