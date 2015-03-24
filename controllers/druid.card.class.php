<?php

class druid_card
{
	private $submit = false;
	private $mot = '';
	private $tabou1 = '';
	private $tabou2 = '';
	private $tabou3 = '';
	private $tabou4 = '';
	private $tabou5 = '';
	
	private $nivcarte = '';
	private $userlang = '';
	private $user= '';
	private $createur= '';
	private $et_c_est_le_temps_qui_court = '';
	
	private $errors = array();

	private $res = '';
	private $res2 = '';
	
	private $previousSGDr = 0;
	private $previousSDr = 0;
	private $pointsDr = 10;
	
	private $mode = '';

	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
            $this->check();
            $this->validate();
            return $this->display_et_scores();
        }
        return false;
	}

	private function init()
	{
		// récupération de l'id de l'utilisateur et de sa langue étudiée
		$this->user = user::getInstance();
		$this->userlang = $this->user->userlang;
		$this->createur = $this->user->id;
		
		//récupération de la date au format jour/mois/année/heure
		$this->et_c_est_le_temps_qui_court = date("d/m/Y H:i");
		
		
		// récupération du formulaire de création de carte
		 $this->submit = isset($_POST['submit_form']);
		if ( $this->submit )
		{	
			
		    $this->res['mot'] = isset($_POST['mot']) ? trim($_POST['mot']) : '';
		    $this->res['nivcarte'] = isset($_POST['nivcarte']) ? trim($_POST['nivcarte']) : '';
		    $this->res['tabou1'] = isset($_POST['tabou1']) ? trim($_POST['tabou1']) : '';
		    $this->res['tabou2'] = isset($_POST['tabou2']) ? trim($_POST['tabou2']) : '';
		    $this->res['tabou3'] = isset($_POST['tabou3']) ? trim($_POST['tabou3']) : '';
		    $this->res['tabou4'] = isset($_POST['tabou4']) ? trim($_POST['tabou4']) : '';
		    $this->res['tabou5'] = isset($_POST['tabou5']) ? trim($_POST['tabou5']) : '';
		}
		return true;
	}

	private function check()
	{
        if ( !$this->submit )
		{
			return false;
		}

        // Vérification de l'unicité, le mot à trouver ne doit pas être parmi les mots tabous
		if ( $this->res['mot'] == $this->res['tabou1'] || $this->res['mot'] == $this->res['tabou2'] || $this->res['mot'] == $this->res['tabou3'] || $this->res['mot'] == $this->res['tabou4'] || $this->res['mot'] == $this->res['tabou5'])
		{
				$this->errors[] = 'The cardword must differ from its taboo words';
		}
       return true;
    }
	private function validate()
	{
        if ( $this->submit)
        {
			// connexion à la BD
			$db = db::getInstance();
			// insertion de la carte créée dans la BD
			$sql = 'INSERT INTO carte
                    (idDruide,temps,niveau,langue,mot,tabou1,tabou2,tabou3,tabou4,tabou5)
					VALUES(' .
						$db->escape((string) $this->createur) . ', ' .
						$db->escape((string) $this->et_c_est_le_temps_qui_court) . ', ' .
						$db->escape((string) $this->res['nivcarte']) . ', ' .
						$db->escape((string) $this->userlang) . ', ' .
						$db->escape((string) $this->res['mot']) . ', ' .
						$db->escape((string) $this->res['tabou1']) . ', ' .
						$db->escape((string) $this->res['tabou2']) . ', ' .
						$db->escape((string) $this->res['tabou3']) . ', ' .
						$db->escape((string) $this->res['tabou4']) . ', ' .
						$db->escape((string) $this->res['tabou5']) . ')';
			$db->query($sql);
			return true;
		}else{
			return false;
		}
    }
    
	private function display_et_scores()
	{

		//~ if ($this->errors )
		//~ {
			//~ return false;
        //~ } -> cette condition provoque une erreur
        
        
        //si une carte a été soumise
       if ( $this->submit)
        {
			//récupération de la carte nouvellement créée.
			
			$db = db::getInstance();
			//récupération de l'ID de la carte
			$sql = 'SELECT carteID FROM carte
                    WHERE idDruide='.$this->createur.' AND mot="'.$this->res['mot'].'" AND tabou1="'.$this->res['tabou1'].'" AND tabou2="'.$this->res['tabou2'].'" AND tabou3="'.$this->res['tabou3'].'" AND tabou4="'.$this->res['tabou4'].'" AND tabou5="'.$this->res['tabou5'].'" ORDER BY RAND() LIMIT 1';	  
			$this->result=$db->query($sql);
			$this->res2= mysqli_fetch_assoc($this->result);
			$db->query($sql);
			$this->res['carteID'] = $this->res2['carteID'];
			
			//Requête de modification du score du Druide l'accomplissement de son fastidieux travail de création de carte
		
			//récupération du score précédent;
			$sql = 'SELECT `scoreGlobal`,`scoreDruide` FROM `score` WHERE `userid`="'.$this->createur.'"';
			$result=$db->query($sql);
			$res= mysqli_fetch_assoc($result);

			$this->previousSGDr= $res['scoreGlobal'];
			$this->previousSDr= $res['scoreDruide'];
			
			//maj des variables de scores: le score ne doit jamais être négatif.

			$this->previousSGDr= $this->previousSGDr+$this->pointsDr;
			$this->previousSDr= $this->previousSDr+$this->pointsDr;
			//maj du score dans la BD
			$sql = 'UPDATE score 
					SET  scoreGlobal='.$db->escape((string) $this->previousSGDr) . ', ' .
					'scoreDruide='.$db->escape((string) $this->previousSDr) . '
					WHERE userid='.$this->createur.'';	
			$db->query($sql);
			
			//affichage de l'aperçu de la carte avec son identifiant
			include('./views/druid.card.display.html');
		}else{
			// sinon, pas encore de carte soumise donc affichage du formulaire de création de carte.
			include('./views/druid.card.html');
		}
        return true;
	}
}

?>
