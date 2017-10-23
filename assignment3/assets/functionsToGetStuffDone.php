<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 10/23/2017
 * Time: 11:55 AM
 */
function getCorpAsTable($db)
{
    try {
        $sql = $db->prepare("SELECT * FROM corps");
        $sql->execute();
        $phpclassfall2017 = $sql->fetchAll(PDO::FETCH_ASSOC);
        //$aff_id = $db ->prepare("SELECT id FROM corps");

        if ( $sql->rowCount() > 0 ) {
            $table = "<table>" . PHP_EOL;
            foreach ($phpclassfall2017 as $corpz) {
                $table .= "<tr><td>" . $corpz['corp'];
                $table .= "<a href=\"view.php\"> View </a>";
                $table .= "<a href=\"update.php\"> Update </a>";
                $table .= "<a href=\"delete.php\"> Delete </a>";
                $table .= "</td></tr>";

            }

            $table .= "</table>" . PHP_EOL;

        } else {
            $table = "Life is sad.  There are no corps.";

        }
        return $table;
    }catch (PDOException $e) {
        die("There was a problem retrieving the corps");
    }


}

function addCorp($db, $corp, $incorp_dt, $email, $zipcode, $owner, $phone) {
    try {
        $sql = $db->prepare("INSERT INTO corps VALUES (null, :corp, :incorp_dt, :email, :zipcode, :owner, :phone)");
        $sql->bindParam(':corp', $corp);
        $sql->bindParam(':incorp_dt', $incorp_dt);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zipcode);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        return $sql->rowCount();
    }catch (PDOException $e){
        die("There was a problem giving birth to your puppy.");

    }

}

function getCorp($db, $id)
{
    try {
        $sql = $db->prepare("SELECT * FROM corps WHERE id =:id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $plz = $sql->fetchAll(PDO::FETCH_ASSOC);

        if ($sql->rowCount() > 0) {
            $table = "<table>" . PHP_EOL;
            foreach ($plz as $corpz) {
                $table .= "<tr><td>" . $corpz['corp'];

                $table .= "</td></tr>";

            }

            $table .= "</table>" . PHP_EOL;

        } else {
            $table = "Life is sad.  There are no corps.";

        }
        return $table;
    } catch (PDOException $e) {
        die("There was a problem retrieving the corps");
    }
}


function corpId($db, $corp){
    $sql = $db->prepare("SELECT id FROM corps WHERE corp =:corp");
    $sql->bindParam(':corp', $corp, PDO::PARAM_INT);


}