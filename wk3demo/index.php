<?php
require_once ("assets/dbcon.php");
require_once ("assets/dogs.php");
include_once ("assets/header.php");
$db = dbconn();
$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? "";
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING) ?? "";
$gender = filter_input(INPUT_POST, 'gender', FILTER_VALIDATE_REGEXP,
        array(
            "options"=>array("regexp"=>'/^[MF]$/')
            )
        ) ?? "";
$fixed = filter_input(INPUT_POST, 'fixed', FILTER_VALIDATE_BOOLEAN) ?? "";
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$button = "Add";
switch ($action) {
    case "Add";
    addDog($db, $name, $gender, $fixed);
    break;
    case "Delete":
        break;
    case "Edit":
        $button = "Update";
        $dog = getDog($db, $id);
        break;
    case "Update":
        break;
}

echo getDogsAsTable($db);
include_once ("assets/dogform.php");
include_once ("assets/footer.php");
?>