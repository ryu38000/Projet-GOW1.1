<?php

class diviner_result
{
	private $mode = '';
	private $user = '';
	private $devin = '';
	
	private $previousSGDev = 0;
	private $previousSDev = 0;
	private $pointsDev = 10;
	
	private $reussie = 'oui';

	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
            $this->score();;
            return $this->display();
        }
        return false;
	}

	private function init()
	
	{	
		//Récupération des informaions de base: userid
		$this->user = user::getInstance();
		$this->devin = $this->user->id;
	
		return true;
	}

	private function score()
	{
		// Requête de modification du score du Devin qui a cherché en vain la réponse dans les astres alors qu'il fallait chercher dans les livres
		
			//connexion à la BD
			$db = db::getInstance();
			
			//récupération du score précédent;
			$sql = 'SELECT `scoreGlobal`,`scoreDevin` FROM `score` WHERE `userid`="'.$this->devin.'"';
			$result=$db->query($sql);
			$res= mysqli_fetch_assoc($result);

			$this->previousSGDev= $res['scoreGlobal'];
			$this->previousSDev= $res['scoreDevin'];
			
			
			//maj des variables de scores
			
			$this->previousSGDev= $this->previousSGDev+$this->pointsDev;
			$this->previousSDev= $this->previousSDev+$this->pointsDev;
			
			
			//maj des scores dans la BD
			$sql = 'UPDATE score 
					SET  scoreGlobal='.$db->escape((string) $this->previousSGDev) . ', ' .
					'scoreDevin='.$db->escape((string) $this->previousSDev) . '
					WHERE userid='.$this->devin.'';	
			$db->query($sql);
	
		// Requête de mise à jour de la table partie
			$db = db::getInstance();
			$sql = 'UPDATE parties 
					SET  reussie='.$db->escape((string) $this->reussie).'
					WHERE idDevin='.$this->devin.' ORDER BY tpsDevin DESC LIMIT 1 ';		
			$db->query($sql);
		return true;
	}

	private function display()
	{
		include('./views/diviner.result.html');
        return true;
	}
}

?>
