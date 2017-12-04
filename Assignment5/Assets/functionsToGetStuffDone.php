<?php
/**
 * Created by PhpStorm.
 * User: 001338244
 * Date: 11/8/2017
 * Time: 1:27 PM
 */

function addSite($db, $site, $sites){
    try{
        $sql = $db->prepare("INSERT INTO sites VALUES (null, :site, now())");
        $sql->bindParam(':site', $site);
        $sql->execute();
        $siteID = $db->lastInsertId();
        foreach($sites as $link){
            $sql = $db->prepare("INSERT INTO sitelinks VALUES (:site_id, :link)");
            $sql->bindParam(':link', $link);
            $sql->bindParam(':site_id', $siteID);
            $sql->execute();
        }
        return $sql->rowCount();
    }catch(PDOException $e){
        echo $e;
        die("there are no websites for you fammo");
    }

}

function siteFind($db, $site){

    try{
        $sql = $db->prepare("SELECT Count(*) FROM sites WHERE site=:site");
        $sql->bindParam(':site', $site);
        $sql->execute();
        $numRows = $sql->fetchColumn();
        return $numRows;

    }catch(PDOException $e){
        echo $e;
        die("Something went wrong please restart application");

    }
}

function DropDown($db){
    try {
        $sql = $db->prepare("SELECT * FROM sites");
        $sql->execute();
        $sites = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($sql->rowCount() > 0) {
            $select = "<select name='option'>" . PHP_EOL;
            foreach ($sites as $site) {
                $select .= "<option>" . $site['site'] . "</option>";
            }
            $select .= "</select>";

        } else {
            $select = "there was no sites to grab";

        }
        //echo $select;
        return $select;
    }catch(PDOException $e){
        die("something went wrong please restart application");
    }

}

function grabSites($db, $option){
    try{
        $sql = $db->prepare("SELECT site_id, date FROM sites WHERE site=:option");
        $sql->bindParam(":option", $option);
        $sql-> execute();

        $sites = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($sites as $site){
            echo $sql-> rowCount() . " Links for " .$option. ", site was stored on " . $site['date'] . "<hr>";
            $siteID = $site['site_id'];
        }
        $sql = $db->prepare("SELECT * FROM sitelinks WHERE site_id=:site_id");
        $sql->bindParam(":site_id", $siteID);
        $sql->execute();
        $sites = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach($sites as $site){
            echo "<a href='". $site['link'] . "' target='_blank'/>" .$site['link'] . "<br>";
        }

    }catch(PDOException $e){
        die("something went wrong please restart application  ");
    }

}
function isPostRequest(){
    return (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST');

}
function isGetRequest(){
    return (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'GET');

}