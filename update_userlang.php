<?php
	session_start();
	require_once("models/user.class.php");
	require_once("sys/db.class.php");
	$user = user::getInstance();
	
	$sql = "UPDATE user SET userlang ='"
			. $_GET['userlang'] 
			. "' WHERE userid = '" . intval($user->id)."'";
	$db = db::getInstance();
	echo $sql;
	if ($db->query($sql)){
		echo "update succed";
	} else {
		echo "update fails";
	}
	
//~ 	if ($user->set_lang($_GET['userlang'])) {
//~ 		echo "update succeeded";
//~ 	} else {
//~ 		echo "update failed";
//~ 	};
?>