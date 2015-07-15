<?php
	$user = user::getInstance();
	$userlang = $user->get_lang();

	if ( $userlang )
	{	
		$points="";
		if(isset($_SESSION["pointsCoef"])){
			$points =  $_SESSION["pointsCoef"];
		}
		
		include 'languages/lang.' . $userlang . '.php';
	}
	include 'languages/errors.php';
?>
