<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 11/6/2017
 * Time: 11:36 AM
 */

session_start(); // every page that needs access to session variables needs this line of code
if($_SESSION['username'] == NULL || !isset($_SESSION['username'])){
    header('Location: foo2.php');
}


$file = file_get_contents("https://www.cnn.com");

echo preg_match_all('/Http:/', $file, $matches, PREG_OFFSET_CAPTURE);
print_r($matches);

//$greps = preg_grep('/Trump/', $file);

/* Grabbing a primary key for a foreign key reference
  $db = get my database function
  $sql = "INSERT INTO foo VALUES (null, 'Clark', 'Alexander');
  $stmt = db->prepare($sql);
  bind param as neccessary
  $stmt->execute();
  $pk = $db->lastInsertId() //will get me the primary key of the last row that was inserted



 */

$pwd = "foo";
$hash = password_hash($pwd, PASSWORD_DEFAULT);
echo "<p>" . $hash . "</p>";
echo strlen($hash);
//Pretend $hash came from db
echo password_verify("foo", $hash);

//$pwd = "foo";
//echo "<p>" .password_hash($pwd, PASSWORD_DEFAULT) . "</p>";
//$pwd = "foo16513151616545613516548nvcgtrcutyt";
//echo "<p>" .password_hash($pwd, PASSWORD_DEFAULT) . "</p>";

