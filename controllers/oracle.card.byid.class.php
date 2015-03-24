<?php

class oracle_card_byid
{
	
	private $errors = array();
	private $nivcarte = '';
	private $userlang = '';
	private $user= '';
	private $oracle= '';
	public $carteId='';
	private $boobool= true;
	
	private $res='';
	private $result= '';
	private $mode = '';


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
	
		// récupération de l'id de l'utilisateur et de sa langue étudiée
		$this->user = user::getInstance();
		$this->userlang = $this->user->userlang;
		$this->oracle = $this->user->id;
		
		//récupération du l'id de la carte dans la zone de texte
		$this->submit = isset($_POST['submit_form']);
		if ( $this->submit )
		{	
			
		    $this->carteId = isset($_POST['carteId']) ? trim($_POST['carteId']) : '';
		}
		return true;
	}
	
	 public function selectcarte()
	{
	// modifications 08/02/2015
	$db = db::getInstance();
	//if ( !$this->submit)
	if ( !$this->submit || $this->errors )
	{
		return false;
	}
	// Sélection 
	$sql = 'SELECT carteID,niveau,mot,tabou1,tabou2,tabou3,tabou4,tabou5 FROM carte WHERE idDruide!="'.$this->oracle.'" AND langue="'.$this->userlang.'" AND carteID="'.$this->carteId.'" ';
        $this->result=$db->query($sql); 
        $this->res= mysqli_fetch_assoc($this->result);

	// ligne pour permettre la récupération du niveau de la carte dans la table enregistrement
	$this->res['nivcarte'] = $this->res['niveau'];
	}

	private function display()
	{
		if(isset($_POST['submit_form']))
		{	
			
			if ( $_POST['carteId'] != $this->res['carteID'] )
			{
				//echo $lang['unknown_id']; --> je ne parvient pas a utiliser le echo pour l'instant
				$this->errors[] = 'Carte inaccessible: soit la carte n\'existe pas dans cette langue, soit vous en êtes le créateur et dans ce cas vous ne pouvez pas y jouer.' ;
				include('./views/oracle.card.byid.html');	
				}else{	
					include('./views/oracle.card.display.html');
				}
		}else{
			include('./views/oracle.card.byid.html');
		}
        return true;
	}
}

?>
