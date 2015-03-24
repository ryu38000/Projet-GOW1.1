<?php

class oracle_menu
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
		case 'oracle.card.alea':
		       include('controllers/oracle.card.alea.class.php');
				$controller = new oracle_card_alea();
				$controller->set_mode($this->mode);
				return $controller->process();
			break;
		    
		case 'oracle.byid':
				include('controllers/oracle.card.byid.class.php');
				$controller = new oracle_card_byid();
				$controller->set_mode($this->mode);
				return $controller->process();
			break;
		case 'oracle.alea.exist':
				include('controllers/oracle.alea.exist.class.php');
				$controller = new oracle_alea_exist();
				$controller->set_mode($this->mode);
				return $controller->process();
			break;
		case 'oracle.result':
				include('controllers/oracle.result.class.php');
				$controller = new oracle_result();
				$controller->set_mode($this->mode);
				return $controller->process();
			break;
		case 'oracle.timeout':
				include('controllers/oracle.timeout.class.php');
				$controller = new oracle_timeout();
				$controller->set_mode($this->mode);
				return $controller->process();
			break;
		case 'oracle.timeout.card':
				include('controllers/oracle.timeout.card.class.php');
				$controller = new oracle_timeout_card();
				$controller->set_mode($this->mode);
				return $controller->process();
			break;
			
				default:
					//print $mode;
					include('controllers/oracle.menu.game.class.php');
					$controller = new oracle_menu_game();
					$controller->set_mode($this->mode);
					return $controller->process();
		}
	}
}

?>
