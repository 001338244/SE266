<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 10/23/2017
 * Time: 12:17 PM
 */include_once ("assets/header.php");
include_once ("assets/dbconn.php");
require_once ("assets/functionsToGetStuffDone.php");

$db = dbconn();

$id = filter_input(INPUT_GET, 'id');

echo getCorp($db, $id);
include_once ("assets/footer.php");
?>