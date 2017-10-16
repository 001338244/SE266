<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 10/11/2017
 * Time: 1:21 PM
 */
//this is a very bad example of code.  Just to get basic ideas across
$dsn = "mysql:host=localhost;dbname=dogs";
$username = "dogs";
$password= "se266";
try {
    $db = new PDO($dsn, $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e){
    //echo $e->getMessage();
    die("There was a problem connecting to the database.");

}
/*if ( isset($_POST['submit']) ){

    $submit = $_POST['submit']
} else {
    $submit = "";

}*/
//$submit = isset($_POST['submit']) ? $_POST['submit'] : ""; //terranary statement
$submit = $_POST['submit'] ?? "";  //null colesence oppeator
if ($submit == "do it"){
    $name = $_POST['name'] ?? "";
    $gender = $_POST['gender']?? "F";
    $fixed = $_POST['fixed'] ?? false;
    try {
        $sql = $db->prepare("INSERT INTO animals VALUES(null, :name, :gender, :fixed)");
        $sql->bindParam(':name', $name);
        $sql->bindParam(':gender', $gender);
        $sql->bindParam(':fixed', $fixed);
        $sql->execute();
        echo $sql->rowCount() . " rows inserted";
    }catch(PDOException $e){
        $e->getMessage();

    }
}
?>
<form method="post" action="#">
    Name: <input type="text" name="name" /><br />
    Gender: M <input type="radio" name="gender" value="M" />
    F <input type="radio" name="gender" value="M" /><br />
    Fixed: <input type="checkbox" name="fixed" value="true" /><br />
    <input type="submit" name="submit" value="do it" />
</form>

<?php

$sql = $db->prepare("SELECT * FROM animals");
$sql->execute();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);
if ( count($results) ) {
    foreach ($results as $dog) {

        print_r($dog);

    }

}
?>