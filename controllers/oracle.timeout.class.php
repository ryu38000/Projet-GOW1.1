<?php

class oracle_timeout
{
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
		// cette carte ne sert qu'à afficher la page de timeout et à calculer les scores si besoin
		return true;
	}



	private function display()
	{
		include('./views/oracle.timeout.html');
        return true;
	}
}

?>
