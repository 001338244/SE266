<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 10/23/2017
 * Time: 11:53 AM
 */
function dbconn()
{
    $dsn = "mysql:host=localhost;dbname=phpclassfall2017";
    $username = "PHPclassfall2017";
    $password = "se266";

    try {
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        //echo $e->getMessage();
        die("There was a problem connecting to the database.");

    }
}
?>