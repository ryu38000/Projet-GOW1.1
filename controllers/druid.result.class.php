<?php

class druid_result
{
	private $mode = '';
	
	private $user = '';
	private $druid = '';
	
	private $previsousSG = 0;
	private $previousSDr = 0;
	
	private $points = 10;

	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
            $this->score();
            return $this->display();
        }
        return false;
	}

	// Cette page est relativement inutile pour l'instant. Elle sert à afficher la page de résultat
	// avec les points marqués par le druide. Pour l'instant le nb de points est contenu dans la variable
	// $lang['points'] dans les fichiers langues. Si à terme vous comptez changer le nb de points, calculez
	// ce nb ici grâce à l'ébauche de requête sql dans la fonction score
	private function init()
	{
			// récup de userid
			$this->user = user::getInstance();
			$this->druid = $this->user->id;
						
		return true;
	}

	
	private function score()
	{
		// Requête de récupération des points du Druide après l'accomplissement de son fastidieux travail d'inquisition
			
			//récupération du score précédent;
			//~ $db = db::getInstance();
			//~ $sql = 'SELECT `scoreGlobal`,`scoreDruide` FROM `score` WHERE `userid`="'.$this->druid.'"';
			//~ $result=$db->query($sql);
			//~ $res= mysqli_fetch_assoc($result);
//~ 
			//~ $this->previousSG= $res['scoreGlobal'];
			//~ $this->previousSDr= $res['scoreOracle'];

		return true;
	}

	private function display()
	{
		include('./views/druid.result.html');
        return true;
	}
}

?>
