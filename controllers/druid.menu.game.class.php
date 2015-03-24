<?php

class druid_menu_game
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
		// Coucou David et Maryam! Cette page est relativement inutile,
		//elle affiche le menu du druide mais ne fait rien d'autre. Sans dout y a-t-il moyen de 
		//supprimer cet intermédiaire.
		return true;
	}

	private function display()
	{
		include('./views/druid.menu.html');
        return true;
	}
}

?>
