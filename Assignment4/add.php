<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 10/23/2017
 * Time: 12:17 PM
 */
include_once ("assets/header.php");
include_once ("assets/dbconn.php");
require_once ("assets/functionsToGetStuffDone.php");
include_once ("assets/corpForm.php");

$db = dbconn();

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
$incorp_dt = filter_input(INPUT_POST, 'incorp_dt', FILTER_SANITIZE_STRING) ?? "";
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";

switch ( $action ) {
    case "Add":
        echo $corp, $incorp_dt, $email, $zipcode, $owner, $phone;
        addCorp( $db, $corp, $incorp_dt, $email, $zipcode, $owner, $phone);
        break;
}
include_once ("assets/footer2.php");
?>