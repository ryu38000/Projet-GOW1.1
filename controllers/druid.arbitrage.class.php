<?php

class druid_arbitrage
{	
	private $errors = array();
	private $enregist = array();
	private $nivcarte = '';
	private $userlang = '';
	private $user= '';
	private $druid= '';
	public $partie = false;
	
	private $raisin ='';
	private $res2 = '';
	private $res3 = '';
	private $result= '';
	private $result1= '';
	private $mode = '';
	private $adresse = '';
	private $oracle = '';
	private $enregistrement='';
	
	private $previousSGO = 0;
	private $previousSO = 0;
	
	private $previousSGDr = 0;
	private $previousSDr = 0;
	private $pointsDr = 10;
	
	private $et_c_est_le_temps_qui_court ='d/m/Y H:i';
	
	private $valid = 'valid';
	private $invalid = 'invalid';

	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
            $this->selectpartie();
            return $this->display_et_scores();
        }
        return false;
	}

	private function init()
	{
		//récupération des informations de bases : userid, langue et la date
		$this->user = user::getInstance();
		$this->druid = $this->user->id;
		$this->userlang = $this->user->langGame;

		//récupération des points en fonction du niveau de jeu
		$this->userlvl = userlvl::getInstance();
		$this->points= $this->userlvl->get_points();		
		
		$this->et_c_est_le_temps_qui_court = date("d/m/Y H:i");
		
		return true;
	}
//Revoir dans le cas où toutes les cartes ont été supprimés du serveur.
	private function selectpartie()
	{
		//connexion à la BD
		$db = db::getInstance();
	
	//Dans le cas où le joueur souhaite arbitrer la carte après une partie en tant que devin
		if(isset($_SESSION["idCard"]) && isset($_SESSION["idEnregistrement"])){

			$idCarte = $_SESSION["idCard"];
			$idEnregistrement = $_SESSION["idEnregistrement"];

			$sql = "SELECT * FROM `enregistrement` WHERE `enregistrementID` = $idEnregistrement";
			$resultat2 = $db->query($sql);
			$this->raisin = mysqli_fetch_assoc($resultat2);

			$this->enregistrement = "enregistrements/".$this->raisin['cheminEnregistrement'];


		// récupération du pseudo du joueur arbitré
		 $sql = 'SELECT 
                    username
                    FROM user WHERE userid ="'.$this->raisin['idOracle'].'"';	    
         $this->result=$db->query($sql);
         $this->res2= mysqli_fetch_assoc($this->result);

			$sql ="SELECT *
			FROM `carte`
			WHERE `carteID` = $idCarte";
			$resultat = $db->query($sql);
			$this->res3 = mysqli_fetch_assoc($resultat);

			//construction de l'adresse de l'enregistrement à partir du nom du fichier
		    $this->adresse = "enregistrements/".$this->raisin['cheminEnregistrement'];
			$this->partie=true;

			unset($_SESSION["idCard"]);	
			unset($_SESSION["idEnregistrement"]);	

			return true;
		}
		
		else{

			$this->partie=false;
			// récupération d'une carte pour vérifier que la bdd n'est pas vide

			$sql = 'SELECT 
				*
				FROM carte WHERE langue="'.$this->userlang.'"';	    

    		$this->result1=$db->query($sql);
    		$num_rows1 = $this->result1->num_rows;
    		$i=0;

    		if($num_rows1 >0){
				while(!$this->partie && $i < $num_rows1){
					$sql = 'SELECT 
						enregistrementID,cheminEnregistrement,idOracle,carteID,nivcarte 
						FROM enregistrement WHERE idOracle!='.$this->druid.' AND OracleLang="'.$this->userlang.'" ORDER BY RAND() LIMIT 1';	    
	        		$this->result=$db->query($sql);
	        		$this->raisin = mysqli_fetch_assoc($this->result);
	        		 
	        		$this->enregistrement = "enregistrements/".$this->raisin['cheminEnregistrement'];
				
					//On vérifie ici que l'enregistrement est bien sur le serveur
					if (file_exists($this->enregistrement)){
						$this->partie=true;
					}
					$i++;
       			}
				if(!$this->partie){
					array_push($this->errors, 'noEnregistrement');
        			return false;
				}
    			
				$sql = 'SELECT 
					enregistrementID,cheminEnregistrement,idOracle,carteID,nivcarte 
					FROM enregistrement WHERE cheminEnregistrement="'.$this->raisin['cheminEnregistrement'].'"';	    
		        	$this->result=$db->query($sql);
		        	$this->raisin = mysqli_fetch_assoc($this->result);

	
			
				// récupération du pseudo du joueur arbitré
				 $sql = 'SELECT 
		                    username
		                    FROM user WHERE userid ="'.$this->raisin['idOracle'].'"';	    
		         $this->result=$db->query($sql);
		         $this->res2= mysqli_fetch_assoc($this->result);
		        
		        //récupération de la carte jouée
				 $sql = 'SELECT 
		                    niveau,mot,tabou1,tabou2,tabou3,tabou4,tabou5 
		                    FROM carte WHERE carteID='.$this->raisin['carteID'].'';	    
		        $this->result=$db->query($sql);
		        $this->res3= mysqli_fetch_assoc($this->result);
		        
				//construction de l'adresse de l'enregistrement à partir du nom du fichier
		        $this->adresse = "enregistrements/".$this->raisin['cheminEnregistrement'];
		        
				$this->enregistrement = $this->raisin['enregistrementID'];
						
				return true;
			}
			else{
				    array_push($this->errors, 'noCardBD');
        			return false;
			}
		}
	}
	public function getParty(){
		return $this->partie;
	}

	private function display_et_scores()
	{
		require('./sys/load_iso.php');
		require_once('./controllers/update_score_coeff.php');
		
		if(isset($_POST["enregistrement1"])  &&  isset($_POST["oracle"])){
			$this->enregistrement = $_POST["enregistrement1"];
			$this->oracle = $_POST['oracle'];
		}
		// après avoir cliqué sur "au bûcher" = description vide ou fautive
		if(isset($_POST['invalidate']))
		{

			//connexion à la BD
			$db = db::getInstance(); 

			// Requête d'insertion des info dans la table 'arbitrage'
			$sql = 'INSERT INTO arbitrage
			(enregistrementID,idDruide,tpsArbitrage,validation)
				VALUES(' .
					$db->escape((string) $this->enregistrement ) . ', ' .
					$db->escape((string) $this->druid) . ', ' .
					$db->escape((string) $this->et_c_est_le_temps_qui_court) . ', ' .
					$db->escape((string) $this->invalid ) . ')' ;
					
				$db->query($sql);

			
		// Requête de modification du score de l'Oracle dont la description est jetée en pâture aux flammes du bûcher purificateur
			
			updateScoreOracleDruideRefuse($this->oracle,$iso[$this->userlang],$this->enregistrement);
			
//~ 			//récupération du score précédent;
//~ 			$sql = 'SELECT `scoreGlobal`,`scoreOracle` FROM `score` WHERE `userid`="'.$this->oracle.'" AND langue="'.$iso[$this->userlang].'"';
//~ 			

//~ 			$result=$db->query($sql);
//~ 			$res= mysqli_fetch_assoc($result);

//~ 			$this->previousSGO= $res['scoreGlobal'];
//~ 			$this->previousSO= $res['scoreOracle'];

//~ 			// ici peut-être prévoir une requête qui vérifie si cette partie a déjà été arbitrée pour éviter d'enlever trop de points sur une même description
//~ 			
//~ 			$points = $this->points * 0.5;
//~ 			//maj des variables de scores: le score ne doit jamais être négatif mais il peut être nul.
//~ 			if($this->previousSO>=$this->pointsO)
//~ 			{
//~ 				$this->previousSGO= $this->previousSGO - $points;
//~ 				$this->previousSO= $this->previousSO - $points;
//~ 			}
//~ 			
//~ 			//maj du score dans la BD
//~ 			$sql = 'UPDATE score 
//~ 					SET  scoreGlobal='.$db->escape((string) $this->previousSGO) . ', ' .
//~ 					'scoreOracle='.$db->escape((string) $this->previousSO) . '
//~ 					WHERE userid='.$this->oracle.' AND langue="'.$iso[$this->userlang].'"';
//~ 					
//~ 			$db->query($sql);
			
		//Requête de modification du score du Druide après l'accomplissement de son fastidieux travail d'inquisition
			//récupération du score précédent;

			updateScoreDruideArbitrage($this->druid,$iso[$this->userlang],$this->pointsDr);
			
//~ 			$sql = 'SELECT `scoreGlobal`,`scoreDruide` FROM `score` WHERE `userid`="'.$this->druid.'" AND langue="'.$iso[$this->userlang].'"';
//~ 			$result=$db->query($sql);
//~ 			$res= mysqli_fetch_assoc($result);

//~ 			$this->previousSGDr= $res['scoreGlobal'];
//~ 			$this->previousSDr= $res['scoreDruide'];
//~ 			
//~ 			//maj des variables de scores

//~ 			$this->previousSGDr= $this->previousSGDr+$this->pointsDr;
//~ 			$this->previousSDr= $this->previousSDr+$this->pointsDr;
//~ 			
//~ 			//maj du score dans la BD
//~ 			$sql = 'UPDATE score 
//~ 					SET  scoreGlobal='.$db->escape((string) $this->previousSGDr) . ', ' .
//~ 					'scoreDruide='.$db->escape((string) $this->previousSDr) . '
//~ 					WHERE userid='.$this->druid.' AND langue="'.$iso[$this->userlang].'"';
//~ 			$db->query($sql);
			
			$_SESSION["notif"]["notification_done"]["Druide"] = 'pointsDruide';
			header('Location: index.php?page.home.html');
			
			// après avoir cliqué sur "valider" = description correcte et jouable
		}elseif (isset($_POST['validate'])){

				//connexion à la BD
				$db = db::getInstance();
				// insertion des informations dans la table arbitrage
				$sql = 'INSERT INTO arbitrage
				(enregistrementID,idDruide,tpsArbitrage,validation)
					VALUES(' .
						$db->escape((string) $this->enregistrement ) . ', ' .
						$db->escape((string) $this->druid) . ', ' .
						$db->escape((string) $this->et_c_est_le_temps_qui_court) . ', ' .
						$db->escape((string) $this->valid ) . ') ' ;	
					$db->query($sql);
				
				//	mettre à jour le champs "validation" de la table enregistrement pour que cet enregistrement devienne jouable
				$sql = 'UPDATE enregistrement 
				SET validation =  ' .$db->escape((string) $this->valid ) . ' 
				WHERE enregistrementID="'.$this->enregistrement .'" ' ;
				
					
				$db->query($sql);	
				
			// Requête de modification du score de l'Oracle dont la description est élevée au rang de prediction divine
			
				updateScoreOracleDruideAccepte($this->oracle,$iso[$this->userlang],$this->enregistrement);
				
//~ 				//récupération du score précédent;
//~ 				$sql = 'SELECT `scoreGlobal`,`scoreOracle` FROM `score` WHERE `userid`="'.$this->oracle.'" AND langue="'.$iso[$this->userlang].'"';

//~ 				$result=$db->query($sql);
//~ 				$res= mysqli_fetch_assoc($result);


//~ 				$this->previousSGO= $res['scoreGlobal'];
//~ 				$this->previousSO= $res['scoreOracle'];
//~ 				
//~ 				// ici peut-être prévoir une requête qui vérifie si cette partie a déjà été arbitrée 
//~ 			
//~ 				//maj des variables de scores: le score ne doit jamais être négatif.
//~ 	
//~ 				$this->previousSGO= $this->previousSGO+$this->points;				
//~ 				$this->previousSO= $this->previousSO+$this->points;				
//~ 			
//~ 				//maj du score dans la BD
//~ 				$sql = 'UPDATE score 
//~ 					SET  scoreGlobal='.$db->escape((string) $this->previousSGO) . ', ' .
//~ 					'scoreOracle='.$db->escape((string) $this->previousSO) . '
//~ 					WHERE userid='.$this->oracle.' AND langue="'.$iso[$this->userlang].'"';
//~ 					

//~ 				$db->query($sql);
				
		//Requête de modification du score du Druide l'accomplissement de son fastidieux travail d'inquisition
			//récupération du score précédent;
			
			updateScoreDruideArbitrage($this->druid,$iso[$this->userlang],$this->pointsDr);

//~ 			$sql = 'SELECT `scoreGlobal`,`scoreDruide` FROM `score` WHERE `userid`="'.$this->druid.'" AND langue="'.$iso[$this->userlang].'"';

//~ 			$result=$db->query($sql);
//~ 			$res= mysqli_fetch_assoc($result);

//~ 			$this->previousSGDr= $res['scoreGlobal'];
//~ 			$this->previousSDr= $res['scoreDruide'];
//~ 			
//~ 			//maj des variables de scores: le score ne doit jamais être négatif.

//~ 			$this->previousSGDr= $this->previousSGDr+$this->pointsDr;
//~ 			$this->previousSDr= $this->previousSDr+$this->pointsDr;
//~ 			
//~ 			//maj du score dans la BD
//~ 			$sql = 'UPDATE score 
//~ 					SET  scoreGlobal='.$db->escape((string) $this->previousSGDr) . ', ' .
//~ 					'scoreDruide='.$db->escape((string) $this->previousSDr) . '
//~ 					WHERE userid='.$this->druid.' AND langue="'.$iso[$this->userlang].'"';
//~ 			$db->query($sql);

			$_SESSION["notif"]["notification_done"]["Druide"] = 'pointsDruide';
			header('Location: index.php?page.home.html');
			// sinon, c'est le premier passage dans la page, il n'y a pas encore eu d'arbitrage donc on affiche la page d'arbitrage
		}

		else{
					include('./views/druid.arbitrage.html');
		}
        return true;
	}

}

?>
