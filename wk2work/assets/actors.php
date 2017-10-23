<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 10/18/2017
 * Time: 1:54 PM
 */
function getActorAsTable($db)
{
    try {
        $sql = $db->prepare("SELECT * FROM actors");
        $sql->execute();
        $phpclassfall2017 = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ( $sql->rowCount() > 0 ) {
            $table = "<table>" . PHP_EOL;
            foreach ($phpclassfall2017 as $actor) {
                $table .= "<tr><td>" . $actor['firstname'];
                $table .= "</td><td>" . $actor['lastname'];
                $table .= "</td><td>" . $actor['dob'];
                $table .= "</td><td>" . $actor['height'];
                $table .= "</td></tr>";

            }

            $table .= "</table>" . PHP_EOL;

        } else {
            $table = "Life is sad.  There are no actors.";

        }
        return $table;
    }catch (PDOException $e) {
        die("There was a problem retrieving the dogs");
    }


}

function addActor($db, $firstname, $lastname, $dob, $height) {
    try {
        $sql = $db->prepare("INSERT INTO actors VALUES (null, :firstname, :lastname, :dob, :height)");
        $sql->bindParam(':firstname', $firstname);
        $sql->bindParam(':lastname', $lastname);
        $sql->bindParam(':dob', $dob);
        $sql->bindParam(':height', $height);
        $sql->execute();
        return $sql->rowCount();
    }catch (PDOException $e){
        die("There was a problem giving birth to your actor.");

    }

}


function getActor($db, $id){
    $sql = $db->prepare("SELECT * FROM actors WHERE id =:id");
    $sql->bindParam(':id', $id, PDO::PARAM_INT);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_ASSOC);
}
?>