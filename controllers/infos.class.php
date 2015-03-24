<?php

class infos
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
		//Qu'est-ce qui est blanc et qui vole?
		return true;
	}

		// Superfrigo!
	private function display()
	{
		include('./views/infos.html');
        return true;
	}
}

?>
