<?php

class score
{
	private $user= '';
	private $userid= '';
	private $mode = '';
	private $result2='';
	private $row="";
	private $usertab = array();
	private $userScoreTab = array();
	private $scoreTab = array();

	private $userName = "";
	private $userHighScore = false;
	private $coef = array();
	private $spokenLang = array();
	private $coefLangue = array();
	private $allScores = array();
	private $allScoresSorted = array();


	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
            $this->getscore();
            return $this->display();
        }
        return false;
	}

	private function init()
	{
		//récupération de userid
		$this->user = user::getInstance();
		$this->userid = $this->user->id;
		$this->userName = $this->user->username;
		$this->coef = $this->getCoeffScore();


		return true;
	}


	private function getscore()
	{

		//connexion à la BD
		$db = db::getInstance();

		//variable qui permet d'afficher les $this->scorE meilleurs scores
		$this->scorE = variable::gethighscore();

		//Récupération du score
		$sql = "SELECT 
			* FROM score WHERE userid='".$this->userid."' AND  first_game_time!=''";

		$this->result=$db->query($sql);

		

		if($this->result->num_rows>0){
			

			while($this->res = mysqli_fetch_assoc($this->result))
			{
				$classementGlobal = 0;

				$i=0;
				
				$sql = "SELECT 
					* FROM score WHERE langue='".$this->res["langue"]."' AND first_game_time!='' ORDER BY `scoreGlobal` DESC";
				$this->result2=$db->query($sql);
				$this->row=$this->result2->num_rows;


				while($this->res2 = mysqli_fetch_assoc($this->result2)){ 
					$i++;
					
					$name = $this->getName($this->res2["userid"]);
		            
		          //  if($this->userid == $this->res2["userid"]){
					//	$this->usertab[$this->res2["langue"]][$name]["place"] = $i;
					//}
					
					if($i<=$this->scorE){
						if($this->userid == $this->res2["userid"]){
							$this->userHighScore = true;
							//$this->usertab[$this->res2["langue"]][$name]["place"] = $i;						
						}
		            	
		        	}
		        	else{
		        		if(!$this->userHighScore){
		        			if($this->userid == $this->res2["userid"]){
		        				$this->userClassement = $i;		
							}
						}
		        	}
		        	$this->usertab[$this->res2["langue"]][$name]["scoreGlobal"] = $this->res2["scoreGlobal"];
		            $this->usertab[$this->res2["langue"]][$name]["scoreOracle"] = $this->res2["scoreOracle"];
		            $this->usertab[$this->res2["langue"]][$name]["scoreDruide"] = $this->res2["scoreDruide"];
		            $this->usertab[$this->res2["langue"]][$name]["scoreDevin"] = $this->res2["scoreDevin"];

 					$this->langue = $this->res2["langue"];

 					if(!isset($this->userScoreTab[$this->langue])){
			        	$this->userScoreTab[$this->langue]= array();
			        }
		        	
		        	array_push($this->userScoreTab[$this->langue], array($name=>array("scoreGlobal" => $this->res2["scoreGlobal"],
			        														   "scoreOracle" => $this->res2["scoreOracle"],
			        														   "scoreDruide" => $this->res2["scoreDruide"],
			        														   "scoreDevin" => $this->res2["scoreDevin"],
			        														   "classement" => $i,
			        															)));
		        }

		        if(!$this->userHighScore){ //si le joueur n'est pas dans le topFive
					$this->scoreTab[$this->langue] = $this->scoreDefine($this->userClassement , $this->userScoreTab , $this->langue);
				}
			
			}

		}

		//Score GLOBAL
		$sql = "SELECT 
			* FROM score WHERE first_game_time!=''";
		$this->resu=$db->query($sql);

		while($this->resultatt=mysqli_fetch_assoc($this->resu)){
			
			//on récupère le score global de l'utilisateur et le nombre de langues joué
			$totalScoreUser = $this->calculScoreGlobal($this->resultatt["userid"]);


			$name = $this->getName($this->resultatt["userid"]);


			if(!isset($tabName[$name])){
				$tabName[$name] = $name;
				array_push($this->allScores, array("name"=>$name,"ScoreGlobal"=>$totalScoreUser[0], "NbLangue"=>$totalScoreUser[1]));

			}

		}

		usort($this->allScores, $this->make_comparer(['ScoreGlobal', SORT_DESC]));

		$i=0;

		foreach($this->allScores as $key => $tab){
			$i++;

			$this->allScores[$key]["classement"] = $i;

			if($tab["name"] == $this->userName){
				$classementUser = $i;
			}
		}

		if($classementUser>$this->scorE){
			$this->scoreGlobalTab = $this->scoreDefine($classementUser , $this->allScores, "");
		}
		return false;
	}



	private function getName($id){
		$db = db::getInstance();

		$sql = 'SELECT `username`
		            	FROM user
		            	WHERE userid = ' . intval($id);

		            $this->resultaT = $db->query($sql);
		            $this->reS=mysqli_fetch_assoc($this->resultaT);
		return $this->reS["username"];
	}

	private function calculScoreGlobal($id){
		//connexion à la BD
		$db = db::getInstance();
		$i=0;
		$max = 0;
		$nblangues = 0;
		$scoreTotal=0;

		$sql="SELECT * FROM `score` WHERE  first_game_time !='' AND userid = '".intval($id)."' ORDER BY `scoreGlobal` DESC";
		$this->resultt = $db->query($sql);
		$this->spokenLang = $this->getLvlLang($id);
		//print_r($this->spokenLang);
		//On récupère les langues parlées par l'utilisateur avec le niveau

		//On récupère le coefficient en fonction du niveau dans la langue apprise
	

		while($this->ress = mysqli_fetch_assoc($this->resultt)) {

			$nblangues++;
			
			if(isset($this->spokenLang[$this->ress["langue"]])){
			//On récupère le coefficient en fonction du niveau dans la langue apprise
			$coeffNiveau = $this->getCoeffLang($this->spokenLang[$this->ress["langue"]]);
			}
			else{
				$coeffNiveau=1;	 //valeur par défaut si l'utilisateur n'a joué qu'en mode devin

			}
			

			if(isset($this->coef[$i])){
				$max = $i;
				$scoreTotal += $this->ress["scoreGlobal"]*$coeffNiveau*$this->coef[$i];
				$i++;
			}
			else{
				$scoreTotal += $this->ress["scoreGlobal"]*$coeffNiveau*$this->coef[$max];
			}
		} 
		return array($scoreTotal,$nblangues);

	}

	private function getCoeffScore(){
		//connexion à la BD
		$db = db::getInstance();
		$coefficient = array();

		$sql="SELECT * FROM `coeff_statut`";
		$this->resultat = $db->query($sql);

		while($this->res=mysqli_fetch_assoc($this->resultat)) {
			array_push($coefficient, $this->res["coeff"]);
		} 
		return $coefficient;
	}

	private function getLvlLang($id){
		//connexion à la BD
		$db = db::getInstance();

		$sql = "SELECT * FROM user_niveau WHERE userid ='".intval($id)."'";
		$this->resultat = $db->query($sql);
		$langue = array();
		$niveau = array();

		while($this->res=mysqli_fetch_assoc($this->resultat)) {
			$langue = explode(";", $this->res["spoken_lang"]);
			$niveau = explode(";", $this->res["niveau"]);
		} 
		$taille = sizeof($langue);

		for($i=0; $i<$taille;$i++){
			if($langue[$i]!=""){
				$spokLang[$langue[$i]] = $niveau[$i];
			}
		}
		return $spokLang;
	}

	private function getCoeffLang($niveau){
		//connexion à la BD
		$db = db::getInstance();

		$sql = "SELECT * FROM `coeff_niveau_langue` WHERE niveau_langue='".$niveau."'";
		$this->resultat = $db->query($sql);
		$this->res=mysqli_fetch_assoc($this->resultat);
		
		return $this->res["coeff"];
		
	}
	private function make_comparer() {
	    // Normalize criteria up front so that the comparer finds everything tidy
	    $criteria = func_get_args();
	    foreach ($criteria as $index => $criterion) {
	        $criteria[$index] = is_array($criterion)
	            ? array_pad($criterion, 3, null)
	            : array($criterion, SORT_ASC, null);
	    }
	 
	    return function($first, $second) use ($criteria) {
	        foreach ($criteria as $criterion) {
	            // How will we compare this round?
	            list($column, $sortOrder, $projection) = $criterion;
	            $sortOrder = $sortOrder === SORT_DESC ? -1 : 1;
	 
	            // If a projection was defined project the values now
	            if ($projection) {
	                $lhs = call_user_func($projection, $first[$column]);
	                $rhs = call_user_func($projection, $second[$column]);
	            }
	            else {
	                $lhs = $first[$column];
	                $rhs = $second[$column];
	            }
	 
	            // Do the actual comparison; do not return if equal
	            if ($lhs < $rhs) {
	                return -1 * $sortOrder;
	            }
	            else if ($lhs > $rhs) {
	                return 1 * $sortOrder;
	            }
	        }
	 
	        return 0; // tiebreakers exhausted, so $first == $second
	    };
	}

	private function scoreDefine($userClassement , $tab , $langue){

		$scoreclassement = array();
		
		$this->scoreOver = variable::gethighscoreOver();
		$this->scoreOver++;

		$j = $userClassement-$this->scoreOver; //joueurs au dessus
		$jj = $userClassement+$this->scoreOver; //joueurs qui précédent

		while($j<=$jj){
			if($langue!=""){
				if(isset($tab[$langue][$j])){
				
					if(!isset($scoreclassement[$langue])){
	    	    			$scoreclassement[$langue]= array();
	    	   		 }
					array_push($scoreclassement[$langue], $tab[$langue][$j]);
				}
			}
			else{
				if(isset($tab[$j])){
					array_push($scoreclassement, $tab[$j]);
				}
			}
			$j++;
		}
		if($langue!=""){
			return $scoreclassement[$langue];
		}
		else{
			return $scoreclassement;
		}
	}

	private function display()
	{
		include('./views/score.html');
        return true;
	}
}

?>
