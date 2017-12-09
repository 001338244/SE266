<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 10/23/2017
 * Time: 11:49 AM
 */

require_once ("assets/dbconn.php");
require_once("assets/functionsToGetStuffDone.php");
$db = dbconn();

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$col = filter_input(INPUT_GET, 'col', FILTER_SANITIZE_STRING) ?? NULL;
$sorting = filter_input(INPUT_GET, 'dir', FILTER_SANITIZE_STRING) ?? null;
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);
$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? NULL;
$incorp_dt = filter_input(INPUT_POST, 'incorp_dt', FILTER_SANITIZE_STRING) ?? NULL;
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? NULL;
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? NULL;
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? NULL;
switch ($action) {
    case 'sort':
        $title = "Sort";
        include_once ('assets/header.html');
        $colNames = getColumnNames($db, 'corps');
        echo getCorpsAsTable($db, $colNames, $col, $sorting);
        break;

    case 'Read':
        include_once ('assets/header.html');
        break;

    case 'Update':
        $title = "Update Corp";
        include_once ('assets/header.html');
        echo getCorpAsUpdate($db, $id);
        if(isPostRequest()) {
            $form = updateCorp($db, $id, $corp, $incorp_dt, $email, $zipcode, $owner, $phone);
            echo "Record Updated";
        }
        break;

    case 'Delete':
        include_once ('assets/header.html');
        echo getCorpAsDelete($db, $id);
        if(isPostRequest()) {
            $table = deleteCorp($db, $id);
            echo "Record Deleted";
        }
        break;

    default:
        $title = "default";
        include_once ('assets/header.html');
        $colNames = getColumnNames($db, 'corps');
        echo getCorpsAsTable($db, $colNames, $col, $sorting);
        break;
}