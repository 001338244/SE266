<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 11/8/2017
 * Time: 1:20 PM
 */


//Lets make a way to get the URL input
include_once ("assets/header.html");
include_once ("assets/dbconn.php");
require_once ("assets/functionsToGetStuffDone.php");



$option = filter_input(INPUT_POST, 'option', FILTER_SANITIZE_STRING) ?? NULL;



$db = dbconn();




$selector = "<form method ='post' action='#'>";
$selector .= DropDown($db);
$selector .= "<input type='submit' name='action' value = 'Submit'>";

echo $selector;

if(isPostRequest()){
    echo grabSites ($db, $option);
}






