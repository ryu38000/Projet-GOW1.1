<?php

class diviner_menu_game
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
		return true;
	}

	private function display()
	{
		include('./views/diviner.menu.html');
        return true;
	}
}

?>
