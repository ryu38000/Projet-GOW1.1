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
	private $pointsDruide = 5;
	private $result = '';
	private $pointsPerdus = false;

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

		$this->userlvl = userlvl::getInstance();
		$this->time = $this->userlvl->get_time();
		$this->points = $this->userlvl->get_points();
	
		return true;
	}
	
	private function score()
	{

		
		if(!isset($_SESSION["Record"]))
		{
			if ( isset($_POST['submit_form']) )
			{
				$_SESSION["notif"]["notification_done"]["Oracle"] = 'pointsOracle';


				//récupération du score précédent
				/*$db = db::getInstance();
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
				$_SESSION["Record"]=true;*/
			}
			else{
					
				//récupération du score précédent
				/*$db = db::getInstance();
				$sql = 'SELECT `scoreGlobal`,`scoreOracle`, `scoreDruide` FROM `score` WHERE `userid`="'.$this->oracle.'"';
				$result=$db->query($sql);
				$res2= mysqli_fetch_assoc($result);

				$this->previousSG= $res2['scoreGlobal'];
				$this->previousSO= $res2['scoreOracle'];
				$this->previousSD= $res2['scoreDruide'];		

				//maj des variables de scores:
				if($this->previousSO>=$this->points){
					$this->previousSG-= $this->points;
					$this->previousSO-= $this->points;
					$this->previousSG+= $this->pointsDruide; //On ne met pas de points Druide si le score globale est égal à 0 (trop facile sinon)
					$this->previousSD+= $this->pointsDruide;
					$this->pointsPerdus = true;*/
					$_SESSION["notif"]["notification_error"]["Oracle"] = 'giveUpOracle';
					
				//}
				/*else{
					$_SESSION["notif"]["notification_error"]["Oracle"] = 'giveUpWithoutPoints';
				}*/


				//maj du score dans la BD
				/*$db = db::getInstance();
				$sql = 'UPDATE score 
				SET  scoreGlobal='.$db->escape((string) $this->previousSG) . ', ' .
					'scoreOracle='.$db->escape((string) $this->previousSO) . ','.
					'scoreDruide='.$db->escape((string) $this->previousSD) . '
				WHERE userid='.$this->oracle.'';

				$db->query($sql);
				$_SESSION["Record"]=true;*/
			}
			return true;

		}
		else{
			unset($_SESSION["Record"]);
			header('Location: index.php?page.home.html');
		}

	}

	private function display()
	{		
		include('./views/page.home.html');
        return true;
	}
}

?>
