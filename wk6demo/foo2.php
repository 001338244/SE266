<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 11/6/2017
 * Time: 2:06 PM
 */
//password verificaation
session_start();
$_SESSION['username'] = "Clark";
header('Location: foo.php');