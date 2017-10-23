<?php
/**
 * Created by PhpStorm.
 * User: joshw
 * Date: 10/22/2017
 * Time: 10:20 PM
 */
include_once ("assets/header.php");
require_once ("assets/dbconn.php");
require_once ("assets/actors.php");


$db = dbconn();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING) ?? "";
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING) ?? "";
$dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING) ?? "";
$height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_STRING) ?? "";

switch ( $action ) {
    case "Add":
        echo $firstname, $lastname, $dob, $height;
        addActor( $db, $firstname, $lastname, $dob, $height );
        break;
}

//echo getActorAsTable($db);

include_once ("assets/actorform.php");
include_once ("assets/footer.php");