<?php

class oracle_alea_exist
{
	
	private $errors = array();
	private $nivcarte = '';
	private $userlang = '';
	private $user= '';
	private $oracle= '';
	
	private $res='';
	private $result= '';
	private $mode = '';
	private $time;

	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
            $this->selectcarte();
            return $this->display();
        }
        return false;
	}

	private function init()
	{
		// récupération de userid
		$this->user = user::getInstance();
		$this->oracle = $this->user->id;
		$this->userlang = $this->user->langGame;

		$this->userlvl = userlvl::getInstance();
		$this->time = $this->userlvl->get_time();
		
		// Ici il faudra récupérer le niveau de l'utilisateur pour n'afficher sur tel ou tel nb de mots tabous.
		// récupérer scoreID dans user, puis scoreglobal dans score. si score = tant, $niveau = facile, moyen ou difficile
		// En fonction, ne récupérer que le mot, les deux mots tabous ou les 5 mots tabous. Sinon on peut vider $res de ses mots tabous.
		
		return true;
	}

	private function selectcarte()
	{
		// récupération de plusieurs cartes possibles
		$db = db::getInstance();
		 $sql = 'SELECT 
                    carteID,niveau,mot,tabou1,tabou2,tabou3,tabou4,tabou5 
                    FROM carte WHERE idDruide!='.$this->oracle.' AND langue="'.$this->userlang.'" ORDER BY RAND()';	    
        $this->result=$db->query($sql);
        // comptage du nombre de résultats
        $nb_result=$this->result->num_rows;
        
        //pour chaque enregistrement:
        if ($nb_result > 0)
        { 
			while($this->res= mysqli_fetch_assoc($this->result)){
				// ligne pour permettre la récupération du niveau de la carte dans la table enregistrement
				$this->res['nivcarte'] = $this->res['niveau'];
				
				//initialisation du booléen qui représentera la condition finale pour que la carte soit acceptée
				// Il deviendra faux si le moindre critère n'est pas rempli durant la procédure
				$carteok=true;
			
				//récupération de l'éventuel enregistrement que le devin aurait fait sur cette carte pour ne pas la re-proposer
				$sql = 'SELECT enregistrementID
	                    FROM enregistrement WHERE idOracle ="'.$this->oracle.'" AND carteID= "'.$this->res['carteID'].'"LIMIT 1';
				$res2=$db->query($sql);
				$res3=mysqli_fetch_assoc($res2);
				
				//comptage du nombre de résultat
				 $nb_res3=$res2->num_rows;
				 
				// S'il existe  l'enregistrementID d'une partie que l'oracle aurait déjà faite sur cette carte
				if ($nb_res3 != 0)
				{
					$carteok=false;
				}
				
				// si rien de s'oppose à ce que la carte soit proposée
				if ($carteok)
				{
					return true;	
				} 

			}	

		}
	else{
			array_push($this->errors,'noCardBD');
			$_SESSION["notif"]["notification_error"]["Oracle"] = 'noCardBD';	
			return false;
		}
	}
	private function display()
	{
		include('./views/oracle.card.display.html');
        return true;
	}
}

?>
