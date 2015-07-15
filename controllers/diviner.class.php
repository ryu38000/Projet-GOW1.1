<?php

class diviner_game
{
	private $mode = '';

	private $errors = array();
	private $lang = array();	
	private $motadeviner='';
	private $nivcarte = '';
	
	
	private $userlang = '';
	private $user= '';
	private $diviner= '';
	private $pointsSanction ='';
	
	private $raisin ='';
	private $res2 = '';
	private $res3 = '';
	private $res4 = '';
	private $res5 = '';
	private $result= '';
	private $sanction ='';
	private $score='';
	

	private $carteValide = false;
	
	private $adresse = '';
	private $reussie = 'en cours';
	private $temps='';
	private $mess='';


	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
			$this->sanctionLastPartie();	
			if($this->selectpartie()){
				$this->update();	
			}
			 return $this->display();
        }

        return false;
	}

	private function init()
	{
		//récupération des informations de base : id user et sa langue
		$this->user = user::getInstance();
		$this->diviner = $this->user->id;
		$this->userlvl = userlvl::getInstance();
		$this->time = $this->userlvl->get_time();

		//récupération des points de sanction
		$this->pointsSanction = variable::getloosePointsDevin();


		if(isset($_SESSION["langDevin"])){
			$this->userlang = $_SESSION["langDevin"];
		}
		else{
			$this->userlang = $this->user->langGame;
		}
		$this->temps = date("d/m/Y H:i:s");
		unset($_SESSION["motDeviner"]); //permet de supprimer la sécurité qui empêche le joueur de s'ajouter des points à l'infini
		unset($_SESSION["timeOutOracle"]); //permet de supprimer la sécurité qui empêche le joueur d'enlever des points à l'oracle à l'infini

		return true;
	}

	private function sanctionLastPartie()
	{ // fonction qui permet de vérifier l'état de la dernière partie et de sanctionner le joueur de 5 pts s'il a quitté la partitatut = "en cours")
		include('./sys/load_iso.php');
	    $db =  db::getInstance();
		$sql =  "SELECT *
			FROM parties WHERE idDevin = \"".$this->diviner."\"			
			ORDER BY parties.tpsDevin DESC
			LIMIT 1";
			$res=$db->query($sql);
			$this->sanction = mysqli_fetch_assoc($res);

		if($this->sanction['reussie'] == "en cours"){
				
		   $sql = "SELECT *
            	FROM sanctionCarte
                WHERE idDevin ='".$this->diviner."' AND enregistrementID='".$this->sanction['enregistrementID']."'";
                $res = $db->query($sql);
                $this->existSanction = mysqli_num_rows($res);
				if($this->existSanction == 0){
					//Ajout de la carte sanctionné dans la BDD
					$sql = "INSERT INTO sanctionCarte
					(idDevin,enregistrementID)
					VALUES (".$this->diviner.",".$this->sanction['enregistrementID'].")";
                    	
                   	if( $res = $db->query($sql)){
						$sql = "SELECT scoreDevin, scoreGlobal
						FROM score
						WHERE userid ='".$this->diviner."' AND langue='" . $iso[$this->userlang] . "'";
						$res = $db->query($sql);
						$this->score = mysqli_fetch_assoc($res);  
			
						if ($this->score['scoreDevin'] >= $this->pointsSanction) { #à modifier avec un fichier config
							

							$this->score['scoreDevin']-=$this->pointsSanction;
							$this->score['scoreGlobal']-=$this->pointsSanction;

							$sql='UPDATE score 
							SET scoreDevin="'.$this->score['scoreDevin'].'", scoreGlobal ="'.$this->score['scoreGlobal'].'"
							WHERE userid="'.$this->diviner.'" AND langue="' . $iso[$this->userlang] . '"';
							$res=$db->query($sql);
							array_push($this->lang,"sanction");
						}
						else
						{
					 		array_push($this->lang,"sanction_without_points");

						}
		      	    }
				}
		}
	}

	private function selectpartie()
	{
		// récupération de plusieurs enregistrements dans sa langue et dont il n'est pas l'oracle
		$db = db::getInstance();
		$sql = 'SELECT 
                    enregistrementID,cheminEnregistrement,idOracle,carteID,nivcarte 
                    FROM enregistrement WHERE idOracle!='.$this->diviner.' AND OracleLang="'.$this->userlang.'" AND validation="valid" ORDER BY RAND()';	    
        $this->result=$db->query($sql);
        $nb_result=$this->result->num_rows;

        
        //pour chaque enregistrement:
        if($nb_result>0){
      
			while($this->raisin= mysqli_fetch_assoc($this->result)){
			
				// construction de l'adresse de l'enregistrement à  partir du nom du fichier son
				$this->adresse = "enregistrements/".$this->raisin['cheminEnregistrement'];
			
				//initialisation du booléen qui représentera la condition finale pour que la partie soit acceptée
				// Il deviendra faux si le moindre crità¨re n'est pas rempli durant la procédure
				$partieok=true;
       		
				//récupération du contenu de la carte
				$sql = 'SELECT 
                   idDruide,niveau,mot,tabou1,tabou2,tabou3,tabou4,tabou5 
                    FROM carte WHERE carteID='.$this->raisin['carteID'].'';	    
				$res=$db->query($sql);
				$this->res3= mysqli_fetch_assoc($res);
		
				//récupération de l'éventuelle partie que le devin aurait fait sur cet enregistrement pour ne pas le re-proposer
				$sql = 'SELECT reussie
                    FROM parties WHERE idDevin ="'.$this->diviner.'" AND enregistrementID= "'.$this->raisin['enregistrementID'].'"';  
				$res=$db->query($sql);
				$this->res5= mysqli_fetch_assoc($res);

				// si le créateur de la carte et le devin sont la màªme personne, on passe à  l'enregistrement suivant
				if ($this->res3['idDruide'] == $this->diviner)
				{
					$partieok=false;
				}
				// si le devin a déjà  joué cette carte et a eu un résultat (faux ou juste), on passe à  l'enregistrement suivant.
				//Si cette partie a été quitté précipitemment ou à  cause d'un pb technique (reussie=en cours), il peut la rejouer.

				if(($this->res5['reussie']=="oui")||($this->res5['reussie']=="non")||($this->res5['reussie']=="en cours")) #A modifier!
				{
					$partieok=false;
				}

				//On vérifie ici que l'enregistrement est bien sur le serveur
				if (!file_exists($this->adresse)){
					$partieok=false;
				} 

	
				// si rien de s'oppose à  ce que l'enregistrement soit proprosé
				if ($partieok)
				{
					// récupération du pseudo de l'oracle pour savoir qui on écoute
					$db = db::getInstance();
					$sql = 'SELECT username
							FROM user WHERE userid ="'.$this->raisin['idOracle'].'"';	    
					$res=$db->query($sql);
					$this->res2= mysqli_fetch_assoc($res);
	         
	   
					//récupération du pseudo du créateur de la carte
					$db = db::getInstance();
					$sql = 'SELECT username
							FROM user WHERE userid ="'.$this->res3['idDruide'].'"';	    
					$res=$db->query($sql);
					$this->res4= mysqli_fetch_assoc($res);
					
					$this->setcarteValide($partieok);

					return true;
					break;
				}
			}
			array_push($this->errors,'NoGame');
		}
		else{
			array_push($this->errors,'noEnregistrement');
			return false;
		} 
	}
	
	private function update()
	{
		//Insertion des informations dans la table parties
		//connexion à  la bd  
			$db = db::getInstance();
 	 
			 $sql = 'INSERT INTO parties
				(enregistrementID,idDevin,tpsDevin,reussie)
					VALUES(' .
						$db->escape((string) $this->raisin['enregistrementID']).','.
						$db->escape((string) $this->diviner) . ','.
						$db->escape((string) $this->temps) . ','.
						$db->escape((string) $this->reussie).')';
				$db->query($sql);
			return false;
	}

	private function display()
	{
		include('./views/diviner.game.html');
		
        return true;
	}

        public function setcarteValide ($state){
		$this->carteValide=$state;
	}
}

?>

