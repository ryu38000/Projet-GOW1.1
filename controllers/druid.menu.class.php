<?php

class druid_menu
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
		case 'druid.result':
			include('controllers/druid.result.class.php');
			$controller = new druid_result();
			$controller->set_mode($this->mode);
			return $controller->process();
		break;
		
		case 'druid.display':
			include('controllers/druid.display.class.php');
			$controller = new druid_display();
			$controller->set_mode($this->mode);
			return $controller->process();
		break;
		case'druid.arbitrage':
			include('controllers/druid.arbitrage.class.php');
				$controller = new druid_arbitrage();
				$controller->set_mode($this->mode);
				return $controller->process();
		break;
		case'druid.card':
			include('controllers/druid.card.class.php');
				$controller = new druid_card();
				$controller->set_mode($this->mode);
				return $controller->process();
		break;
		
			default:
				include('controllers/druid.menu.game.class.php');
				$controller = new druid_menu_game();
				$controller->set_mode($this->mode);
				return $controller->process();
		}
	}
}

?>
