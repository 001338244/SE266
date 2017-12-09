<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 10/23/2017
 * Time: 11:55 AM
 */
function getCorpsAsTable($db, $colNames, $col = null, $sortable = false)
{
    $corps = getCorpsAsSortedTable($db, $col, $sortable);
    setlocale(LC_MONETARY, 'en_US.UTF-8');
    $table = "";
    if ( count($corps) > 0):
        $table .= "<table>" . PHP_EOL;
        if ($col && ($sortable == null || $sortable == "ASC")):
            $table .= "<tr>";
            foreach ($colNames as $col) {
                $sorting = "DESC";
                $table .= "<th><a href='?action=sort&col=$col&sorting=$sorting'>$col</a></th>";
            }
            $table .= "</tr>" . PHP_EOL;
        else:
            $table .= "<tr>";
            foreach ($colNames as $col):
                $sorting = "ASC";
                $table .= "<th><a href='?action=sort&col=$col&sorting=$sorting'>$col</a></th>";
            endforeach;
            $table .= "</tr>" . PHP_EOL;
        endif;
        foreach ($corps as $corpz):
            $table .= "\t<tr>";
            $table .= "<td>" . $corpz['id'] . "</td>";
            $table .= "<td>" . $corpz['corp'] . "</td>";
            $table .= "<td>" . date('m/d/Y', strtotime($corpz['incorp_dt'])) . "</td>";
            $table .= "<td>" . $corpz['email'] . "</td>";
            $table .= "<td>" . $corpz['zipcode'] . "</td>";
            $table .= "<td>" . $corpz['owner'] . "</td>";
            $table .= "<td>" . $corpz['phone'] . "</td>";
            $table .= "<td>" . "<a href='?id=" . $corpz['id'] . "&action=Update'> Update </a> " . "</td>";
            $table .= "<td>" . "<a href='?id=" . $corpz['id'] . "&action=Delete'> Delete </a> " . "</td>";
            $table .= "</tr>" . PHP_EOL;
        endforeach;
        $table .= "</table>" . PHP_EOL;
        return $table;
    else :
        return "<section>We have no coorporations to show you</section>";
    endif;
}
function getCorpsAsSortedTable($db, $colName, $sorting) {
    if($colName == null) {
        try {
            $sql = "SELECT * FROM corps";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die ("There was a problem showing the coorporations");
        }
    }
    else {
        try {
            $sql = "SELECT * FROM corps ORDER BY $colName $sorting";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die ("There was a problem showing thew coorporations");
        }
    }
    return $corps;
}

function getCorpAsUpdate($db, $id) {
    try {
        $sql = $db->prepare("SELECT * FROM corps WHERE id = $id");
        $sql->execute();
        $corps = $sql->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die ("There was a problem showing the coorporations");
    }

    setlocale(LC_MONETARY, 'en_US.UTF-8');
    $table = "<table>";
    foreach ($corps as $corpz):
        $table .= "<tr>";
        $table .= "<td>" . $corpz['id'] . "</td>";
        $table .= "<td>" . $corpz['corp'] . "</td>";
        $table .= "<td>" . date('m/d/Y', strtotime($corpz['incorp_dt'])) . "</td>";
        $table .= "<td>" . $corpz['email'] . "</td>";
        $table .= "<td>" . $corpz['zipcode'] . "</td>";
        $table .= "<td>" . $corpz['owner'] . "</td>";
        $table .= "<td>" . $corpz['phone'] . "</td>";
        $table .= "</tr>" . PHP_EOL;
        $table .= "</table>" . PHP_EOL;
    endforeach;
    $form = "<form method='post' action='#'>";
    $form .= "Corporation: <input type='text' name='corp' value='" . $corpz['corp'] . "' /> <br />" . PHP_EOL;
    $form .= "Date Incorporated: <input type='text' name='incorp_dt' value='" . $corpz['incorp_dt'] . "' /> <br />" . PHP_EOL;
    $form .= "Email: <input type='text' name='email' value='" . $corpz['email'] . "' /> <br />" . PHP_EOL;
    $form .= "ZipCode: <input type='text' name='zipcode' value='" . $corpz['zipcode'] . "' /> <br />" . PHP_EOL;
    $form .= "Owner: <input type='text' name='owner' value='" . $corpz['owner'] . "' /> </br>" . PHP_EOL;
    $form .= "Phone: <input type='text' name='phone' value='" . $corpz['phone'] . "' /> </br>" . PHP_EOL;
    $form .= "<input type='submit' name='action' value='Update' />" . PHP_EOL;
    $form .= "</form>";
    return $form;
}
function getCorpAsDelete($db, $id)
{
    try {
        $sql = $db->prepare("SELECT * FROM corps WHERE id = $id");
        $sql->execute();
        $corps = $sql->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die ("There was a problem showing the cooroperations");
    }

    setlocale(LC_MONETARY, 'en_US.UTF-8');
    $table = "<table>";
    foreach ($corps as $corpz):
        $table .= "<tr><td>Are you sure you want to delete this coorporation? </td>";
        $table .= "<td>" . $corpz['id'] . "</td>";
        $table .= "<td>" . $corpz['corp'] . "</td>";
        $table .= "<td>" . date('m/d/Y', strtotime($corpz['incorp_dt'])) . "</td>";
        $table .= "<td>" . $corpz['email'] . "</td>";
        $table .= "<td>" . $corpz['zipcode'] . "</td>";
        $table .= "<td>" . $corpz['owner'] . "</td>";
        $table .= "<td>" . $corpz['phone'] . "</td></tr>";
        $table .= "<tr><td>" . "<form method='post' action='#'>" . "</td></tr>";
        $table .= "<tr><td>" . "<input type='submit' name='action' value='Delete' />" . "</td></tr>";
    endforeach;
    $table .= "</table>" . PHP_EOL;
    return $table;
}
function getCorpByID($db, $id) {
    try {
        $sql = $db->prepare("SELECT * FROM corps WHERE id = $id");
        $sql->execute();
        $corp = $sql->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die ("There was a problem showing the coorperatoins");
    }
    return $corp;
}
function getCorps($db) {
    try {
        $sql = "SELECT * FROM corps";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $corp = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die ("There was a problem showing the coorporations");
    }
    return $corp;
}
function deleteCorp($db, $id) {
    $sql = "DELETE FROM corps WHERE id = $id";
    $stmt = $db->prepare($sql);
    $stmt->execute();
}

function updateCorp($db, $id, $corp, $incorp_dt, $email, $zipcode, $owner, $phone){
    try {
        $sql = $db->prepare("UPDATE corps SET corp = :corp, incorp_dt = :incorp_dt, email = :email, zipcode = :zipcode, owner = :owner, phone = :phone WHERE id = $id");
        $sql->fetchAll(PDO::FETCH_ASSOC);
        $sql->bindParam(':corp', $corp);
        $sql->bindParam(':incorp_dt', $incorp_dt);
        $sql->bindParam(':email', $email);
        $sql->bindParam(':zipcode', $zipcode);
        $sql->bindParam(':owner', $owner);
        $sql->bindParam(':phone', $phone);
        $sql->execute();
        return $sql->rowCount();
    } catch (PDOException $e) {
        die("There was a problem updating the corporation.");
    }
}

function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST' );
}

function isGetRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET' );
}
