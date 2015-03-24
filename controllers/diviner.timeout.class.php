<?php

class diviner_timeout
{
	private $mode = '';
	
	private $user = '';
	private $diviner = '';

	private $previousSGO = 0;
	private $previousSO = 0;
	private $pointsO = 5;
	
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

		return true;
	}

	private function carte_et_scoreOracle()
	{
		// récupération d'enregistrementID pour récupérer l'id de l'Oracle et l'id de la carte
		//connexion à la BD
		$db = db::getInstance();
		
		//Récupération de enregistrementID
		$sql = 'SELECT enregistrementID FROM parties WHERE idDevin="'.$this->diviner.'" ORDER BY tpsDevin DESC LIMIT 1 ';
        $res1=$db->query($sql); 
        $res2= mysqli_fetch_assoc($res1);
        
       // récupération de l'id de l'oracle et de la carte grâce à enregistrementID
		$sql = 'SELECT idOracle,carteID
                    FROM enregistrement WHERE enregistrementID='.$res2['enregistrementID'].'';	
        $res1=$db->query($sql); 
        $res3= mysqli_fetch_assoc($res1);
        
		// récupération du contenu de la carte avec carteID
    	$sql = 'SELECT carteID,niveau,mot,tabou1,tabou2,tabou3,tabou4,tabou5 FROM carte WHERE carteID="'.$res3['carteID'].'"';
        $res4=$db->query($sql); 
        $this->res= mysqli_fetch_assoc($res4);
		
	// Requête de modification des scores de l'Oracle qui a fait une description non trouvée par le devin
	
			//récupération du score précédent;
			$sql = 'SELECT `scoreGlobal`,`scoreOracle` FROM `score` WHERE `userid`="'.$res3['idOracle'].'"';
			$result=$db->query($sql);
			$res5= mysqli_fetch_assoc($result);

			$this->previousSGO= $res5['scoreGlobal'];
			$this->previousSO= $res5['scoreOracle'];
			
			//maj des variables de scores: le score ne doit jamais être négatif.
			if($this->previousSO>=$this->pointsO)
			{
				$this->previousSGO= $this->previousSGO-$this->pointsO;
				$this->previousSO= $this->previousSO-$this->pointsO;
			}
			//maj du score dans la BD
			$sql = 'UPDATE score 
					SET  scoreGlobal='.$db->escape((string) $this->previousSGO) . ', ' .
					'scoreOracle='.$db->escape((string) $this->previousSO) . '
					WHERE userid='.$res3['idOracle'].'';
			$db->query($sql);
		return false;
	}


	private function updateparties()
	{
		// Requête de mise à jour de la table partie
			$db = db::getInstance();
			$sql = 'UPDATE parties 
					SET  reussie='.$db->escape((string) $this->reussie).'
					WHERE idDevin='.$this->diviner.' ORDER BY tpsDevin DESC LIMIT 1 ';
					
			$db->query($sql);
			
		return false;
	}

	private function display()
	{
		include('./views/diviner.timeout.html');
        return true;
	}
}

?>
