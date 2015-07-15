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
		return true;
	}

	private function display()
	{
		include('./views/druid.menu.html');
        return true;
	}
}

?>
