<?php

session_start();
header('Content-Type: text/html; charset=UTF-8');
require('./sys/utils.func.php');
require('./sys/db.class.php');
require('./sys/variable.php');
require('./models/user.class.php');
require('./models/userlvl.class.php');
require('./languages/language.php');


// Initialisation
if ( isset($_POST['cancel_form']) )
{
    redirect('');
}
$mode = isset($_REQUEST['mode']) ? $_REQUEST['mode'] : '';
$user = user::getInstance();
if ( !$user->logged_in() && ($mode != 'register') )
{
    $mode = 'login';
}

$userlogged = $user->logged_in();


$modes = $mode ? explode('.', $mode) : array(); // condition  ? if  :else  
$modes = array_slice($modes, 0, 1);
$wmode = implode('.', $modes); // deux premiers paramètres de $mode

// Traitement des modes
$html = false;
switch ( $wmode )
{
    case 'login':
        include('controllers/login.class.php');
        $controller = new login();
        $controller->set_mode($mode);
        $html = $controller->process();
    break;
    case 'register':
        include('controllers/register.class.php');
        $controller = new register();
        $controller->set_mode($mode);
        $html = $controller->process();
    break;
    case 'logout':
		$user->set_logout();
        redirect('');
    break;
    case 'profile':
        include('controllers/edit.class.php');
        $controller = new edit();
        $controller->set_mode($mode);
        $html = $controller->process();
    break;
     case 'score':
        include('controllers/score.class.php');
        $controller = new score();
        $controller->set_mode($mode);
        $html = $controller->process();
    break;
	case 'infos':
        include('controllers/infos.class.php');
        $controller = new infos();
        $controller->set_mode($mode);
        $html = $controller->process();
    break;
    case 'oracle':
        include('controllers/oracle.menu.class.php');
        $controller = new oracle_menu();
        $controller->set_mode($mode);
        $html = $controller->process();
    break;
    
    case 'druid':
        include('controllers/druid.menu.class.php');
        $controller = new druid_menu();
        $controller->set_mode($mode);
        $html = $controller->process();
    break;
    
    case 'diviner':
        include('controllers/diviner.menu.class.php');
        $controller = new diviner_menu();
        $controller->set_mode($mode);
        $html = $controller->process();
    break;
				
    default:
        $html = true;
        unset($_SESSION["CreateCard"]); //Sécurité pour éviter que l'utilisateur ne s'ajoute des points à l'infini lorsqu'il créé une carte (refresh)

        include('./views/page.home.html');
        $mode = '';
}
// Affichage de la page
if ( !$html )
{
    include('./views/page.errors.html');
}

?>
