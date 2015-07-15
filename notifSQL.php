<?php
	require_once("sys/db.class.php");

header("Content-Type: text/plain"); 
	
$db = db::getInstance();


$request = (isset($_GET["request"])) ? $_GET["request"] : NULL;

$variable = (isset($_GET["id"])) ? $_GET["id"] : NULL;



switch ($request) {
    case "send":
        break;
    case "update":
        $sql = 'UPDATE `notif` SET `state`= 1 WHERE `id`='.$variable;
		$db->query($sql);
        break;
    case "delete" :
        $sql = 'DELETE FROM `notif` WHERE `id`='.$variable;
		$db->query($sql);
    default:
       echo "Problème dans la requête...";
}



?>