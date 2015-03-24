<?php

class oracle_result
{
	//ceci est la classe result
	private $submit = false;
	private $file = '';
	private $userlang = '';
	private $user= '';
	private $oracle= '';
	private $mode = '';
	private $errors = '';
	private $previousSG = 0;
	private $previousSO = 0;
	private $points = 10;
	private $result = '';

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

	private function init()
	{
		// récupération de l'id de l'utilisateur et de sa langue étudiée
		$this->user = user::getInstance();
		$this->userlang = $this->user->userlang;
		$this->oracle = $this->user->id;
	
		return true;
	}
	
	private function score()
	{

		// si on a cliqué sur "valider"
		$this->submit = isset($_POST['submit_form']);
		if ( $this->submit )
		{

			//récupération du score précédent
			$db = db::getInstance();
			$sql = 'SELECT `scoreGlobal`,`scoreOracle` FROM `score` WHERE `userid`="'.$this->oracle.'"';
			$result=$db->query($sql);
			$res2= mysqli_fetch_assoc($result);

			$this->previousSG= $res2['scoreGlobal'];
			$this->previousSO= $res2['scoreOracle'];
			
			//maj des variables de scores:
			$this->previousSG= $this->previousSG+$this->points;
			$this->previousSO= $this->previousSO+$this->points;
			 
			//maj du score dans la BD
			$db = db::getInstance();
			$sql = 'UPDATE score 
			SET  scoreGlobal='.$db->escape((string) $this->previousSG) . ', ' .
				'scoreOracle='.$db->escape((string) $this->previousSO) . '
			WHERE userid='.$this->oracle.'';

			$db->query($sql);
		}
		

		return true;
	}

	private function display()
	{
		
		include('./views/oracle.resultat.html');
        return true;
	}
}

?>
