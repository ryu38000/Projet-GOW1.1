<?php

class score
{
	private $user= '';
	private $userid= '';
	private $mode = '';

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
		return true;
	}


	private function getscore()
	{
		//connexion à la BD
		$db = db::getInstance();
		
		//Récupération du score
		$sql = "SELECT 
			scoreGlobal,scoreOracle,scoreDruide,scoreDevin FROM score WHERE userid='".$this->userid."'";
		$this->result=$db->query($sql);
		$this->res= mysqli_fetch_assoc($this->result);
				
		return false;
	}

	private function display()
	{
		include('./views/score.html');
        return true;
	}
}

?>
