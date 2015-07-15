	<?php

class diviner_menu
{
	private $mode = '';

	public function set_mode($mode)
	{
		$this->mode = $mode;
	
	}

	public function process()
	{
	
// Traitement des modes
	switch ( $this->mode )
		{
		case 'diviner.timeout':
			include('controllers/diviner.timeout.class.php');
			$controller = new diviner_timeout();
			$controller->set_mode($this->mode);
			return $controller->process();
		break;
		case 'diviner.result':
			include('controllers/diviner.result.class.php');
			$controller = new diviner_result();
			$controller->set_mode($this->mode);
			return $controller->process();
		break;
		case 'diviner.game':
				include('controllers/diviner.class.php');
				$controller = new diviner_game();
				$controller->set_mode($this->mode);
				return $controller->process();
		break;
		default:
				include('controllers/diviner.menu.game.php');
				$controller = new diviner_menu_game();
				$controller->set_mode($this->mode);
				return $controller->process();
		}
	}
}

?>
