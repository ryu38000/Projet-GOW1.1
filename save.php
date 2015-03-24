<?php
        $fileName = '';
	// ajout 15/02
	//$userid='';
	//~ session_start();
	$connect=new mysqli("localhost","tab","innovatab$1","tab");

	//foreach(array('audio') as $type) {
		if (isset($_FILES["audio-blob"])) {
			echo 'enregistrements/';
			$fileName = $_POST["audio-filename"];
			$_SESSION['filename']=$fileName;
			$uploadDirectory = 'enregistrements/'.$fileName;
			if (!move_uploaded_file($_FILES["audio-blob"]["tmp_name"], $uploadDirectory)) {
				echo(" problem moving uploaded file");
			}
		}
		
		
		//echo ($fileName);
		$temps= date("d/m/Y H:i");
		//~ $user = user::getInstance();
		//~ $langue = $user->userlang;
		//~ $oracle = $user->id;
		
		
		// récupère dans un tableau de hachage le nom du fichier sans l'extension, l'extension et le chemin
		$file = pathinfo('./enregistrements/'.$fileName.''); 
		
		echo $file['filename'].".mp3";
		
		// convertit en mp3
		exec("avconv -i ./enregistrements/".$file['filename'].".wav -acodec libmp3lame ./enregistrements/".$file['filename'].".mp3"); 
		
		// Supression du fichier.wav du serveur.
		exec("rm ./enregistrements/".$file['filename'].".wav"); 
		
		// ajout 15/02
		//$_SESSION['userid']=$userid;
		
		//enregistrement dans la BD de la partie de l'oracle
		if($fileName!='')
		//$userid = $_POST["filename"];
		//$_SESSION['userid']=$userid;
		{
			//renomme le nom du fichier à rentrer dans la BD
			
			$fileName=$file['filename'].".mp3";
			$sql = 'INSERT INTO enregistrement
                    (cheminEnregistrement,idOracle,OracleLang,tpsEnregistrement,carteID,nivcarte) 
					 VALUES('.
						escape((string) $fileName, $connect) .','.
						$_GET["userid"]. ','.
						$_GET["userlang"]. ','.
						escape((string) $temps, $connect) .','.
						$_GET["cardid"]. ','.
						$_GET["levelcard"].')';

			$connect->query($sql);
		}
	//}
	
	//fonction pour protéger les caractères qui doivent l'être dans la requête sql
	function escape($str, $con)
    {
        return is_string($str) ? '\'' . mysqli_real_escape_string($con, $str) . '\'' : intval($str);
    }
	
	
	?>
