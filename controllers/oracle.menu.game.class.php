<?php

class oracle_menu_game
{
	private $userlang = '';
	private $user= '';
	private $oracle ='';
	private $wronglang ='0';

	private $mode = '';

	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
            return $this->display();
        }
        return false;
	}

	private function init()
	{
		$this->user = user::getInstance();
		$this->oracle = $this->user->id;
		$this->userlang = $this->user->userlang;
		// Si l'utilisateur n'apprend pas le français, initalisation de wronglang à 1. Solution provisoire.
		if ($this->userlang !== 'fr'){
			$this->wronglang = "1";
		}
		return true; 
	}


	private function display()
	{
		include('./views/oracle.menu.html');
        return true;
	}
}

?>
