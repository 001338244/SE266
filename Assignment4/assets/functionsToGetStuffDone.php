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


        //tr is table row     td is table data
        if ( $sql->rowCount() > 0 ) {
            $table = "<table>" . PHP_EOL;
            foreach ($phpclassfall2017 as $corpz) {
                $table .= "<tr><td>" . $corpz['corp'];
                $table .= "<a href=\"view.php?id=" . $corpz['id'] . "\"> View </a>";
                $table .= "<a href=\"update.php?id=" . $corpz['id'] . "\"> Update </a>";
                $table .= "<a href=\"delete.php?id=" . $corpz['id'] . "\"> Delete </a>";
                $table .= "<td style='display:none'>" . $corpz['id'];
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
                $table .= "<tr><td>" . $corpz['incorp_dt'];
                $table .= "<tr><td>" . $corpz['email'];
                $table .= "<tr><td>" . $corpz['zipcode'];
                $table .= "<tr><td>" . $corpz['owner'];
                $table .= "<tr><td>" . $corpz['phone'];
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

function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

function isGetRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
}

function updateCorp($db, $id, $corp, $incorp_dt, $email, $zipcode, $owner, $phone) {
    try {
        $sql = $db->prepare("UPDATE corps SET (:id, :corp, :incorp_dt, :email, :zipcode, :owner, :phone)");
        $sql->bindParam(':id', $id);
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