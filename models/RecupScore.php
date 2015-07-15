<?php
	
	function score($role){
		require('./sys/load_iso.php');

		$db = db::getInstance();
		$user = user::getInstance();
		$langue = $user->langGame;

		if(isset($_SESSION["langDevin"]) && $_SESSION["langDevin"]!=""){
			$langue = $_SESSION["langDevin"];
		}
				
		$roleUt = "score".$role;

		$sql = 'SELECT '.$roleUt.' FROM `score` WHERE `userid`="'.$user->id.'" AND langue="'.$iso[$langue].'"';

		$res = $db->query($sql);
		$resultat = mysqli_fetch_assoc($res);

		return $resultat[$roleUt];

	}


?>