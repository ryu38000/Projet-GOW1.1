<?php

class diviner_timeout
{
	private $mode = '';
	
	private $user = '';
	private $diviner = '';
	private $devinName='';
	private $oracle = '';

	private $previousSGO = 0;
	private $previousSO = 0;

	
	private $res = '';
	private $reussie ='non';


	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
            $this->carte_et_scoreOracle();
            $this->updateparties();
            return $this->display();
        }
        return false;
	}

	private function init()
	{
		//récupération des informations de base : userid
		$this->user = user::getInstance();
		$this->diviner = $this->user->id;	
		$this->devinName = $this->user->username;
		$this->userlvl = userlvl::getInstance();
		$this->points= $this->userlvl->get_points();


		return true;
	}

	private function carte_et_scoreOracle()
	{
		include('./sys/load_iso.php');
		require_once('./controllers/update_score_coeff.php');

		if(!isset($_SESSION["timeOutOracle"])){
			// récupération d'enregistrementID pour récupérer l'id de l'Oracle et l'id de la carte
			//connexion à la BD
			$db = db::getInstance();
			
			//Récupération de enregistrementID
			$sql = 'SELECT enregistrementID FROM parties WHERE idDevin="'.$this->diviner.'" ORDER BY tpsDevin DESC LIMIT 1 ';
	        $res1=$db->query($sql); 
	        $this->res2= mysqli_fetch_assoc($res1);
	        
	       // récupération de l'id de l'oracle et de la carte grâce à enregistrementID
			$sql = 'SELECT idOracle,carteID,OracleLang
	                    FROM enregistrement WHERE enregistrementID='.$this->res2['enregistrementID'].'';	
	        $res1=$db->query($sql); 
	        $res3= mysqli_fetch_assoc($res1);

	        $this->oracle = $res3['idOracle']; 
	        
			// récupération du contenu de la carte avec carteID
	    	$sql = 'SELECT carteID,niveau,mot,tabou1,tabou2,tabou3,tabou4,tabou5 FROM carte WHERE carteID="'.$res3['carteID'].'"';
	        $res4=$db->query($sql); 
	        $this->res= mysqli_fetch_assoc($res4);
			
		// Requête de modification des scores de l'Oracle qui a fait une description non trouvée par le devin
		
			updateScoreOracleDevinEchec($this->oracle,$iso[$res3["OracleLang"]],$this->res2['enregistrementID']);
			
//~ 			//récupération du score précédent;
//~ 			$sql = 'SELECT `scoreGlobal`,`scoreOracle` FROM `score` WHERE `userid`="'.$this->oracle.'" AND langue="'.$iso[$res3["OracleLang"]].'"';
//~ 			$result=$db->query($sql);
//~ 			$res5= mysqli_fetch_assoc($result);

//~ 			$this->previousSGO= $res5['scoreGlobal'];
//~ 			$this->previousSO= $res5['scoreOracle'];
//~ 			
//~ 			//maj des variables de scores: le score ne doit jamais être négatif.
//~ 			$points = $this->points*0.5;
//~ 			$_SESSION["pointsCoef"] = $points;
//~ 			
//~ 			if($this->previousSO >= $points)
//~ 			{
//~ 				$this->previousSGO = $this->previousSGO - $points;
//~ 				$this->previousSO = $this->previousSO - $points;
//~ 			}

//~ 			//maj du score dans la BD
//~ 			$sql = 'UPDATE score 
//~ 					SET  scoreGlobal='.$db->escape((string) $this->previousSGO) . ', ' .
//~ 					'scoreOracle='.$db->escape((string) $this->previousSO) . '
//~ 					WHERE userid='.$this->oracle.' AND langue="'.$iso[$res3["OracleLang"]].'"';
//~ 					
//~ 			$db->query($sql);
			$_SESSION["timeOutOracle"]=true;

			return false;
		}
		else{
			header('Location: index.php?page.home.html');    
			return false;  
		}
	}

	private function updateparties()
	{
		// Requête de mise à jour de la table partie
			$db = db::getInstance();
			$sql = 'UPDATE parties 
					SET  reussie='.$db->escape((string) $this->reussie).'
					WHERE idDevin='.$this->diviner.' ORDER BY tpsDevin DESC LIMIT 1 ';
					
			$db->query($sql);
			$_SESSION["notif"]["notification_error"]["Devin"] = 'diviner_timeout';	
		return false;
	}

	private function display()
	{
		include('./views/diviner.timeout.html');
        return true;
	}
}

?>
