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

$date = date('m/d/y h:i:s', time());

switch ( $action ) {
    case "Add":
        echo $link, $site, $date;
        addSite($db, $site, $sites);
        break;
}

if(isset($_POST['site'])){

    if(empty($_POST['site'])){
        echo "ERROR ERROR NO SITE ENTERED";

    }else {
        if (!preg_match("/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/", $_POST['site'])) {
            echo "Please enter a valid website format.  EXAMPLE: https://www.reddit.com/";

        } else {
            $sitesFound = siteFind($db, $_POST['site']);
            if ($sitesFound == 0) {

                $sites = array();
                $file = file_get_contents($_POST['site']);
                echo "<b>" . preg_match_all("/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/", $file, $matches, PREG_OFFSET_CAPTURE) . " links found for </b>\"<a href=" . $_POST['site'];
                preg_match_all("/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/", $file, $matches, PREG_OFFSET_CAPTURE);
                foreach ($matches as $match) {
                    foreach ($match as $m) {
                        array_push($sites, $m[0]);
                        echo $m[0] . "<br>";

                    }
                }
                addSite($db, $_POST['site'], $sites);

            } else {
                echo $_POST['site'] . " has already been entered <br>";
                echo $sitesFound;
            }
        }


    }
}


echo $date;