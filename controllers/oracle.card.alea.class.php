<?php

class oracle_card_alea
{
	private $submit = false;
	private $errors = array();

	private $encoding = "UTF-8";
	private $res='';
	private $result= '';
	private $mode = '';
	public $tableau = '';
	private $boobool = true;
	private $time;
	
	private $mot = '';
	private $tabou1 = '';
	private $tabou2 = '';
	private $tabou3 = '';
	private $tabou4 = '';
	private $tabou5 = '';
	private $nivcarte = '';
	private $userlang = '';
	private $user= '';
	private $oracle= '';

	public function set_mode($mode)
	{
		$this->mode = $mode;
	}

	public function process()
	{
		if ( $this->init() )
        {
			$this->crawler();
            return $this->display();
        }
        return false;
	}

	public function init()
	{
		
		$this->submit = isset($_POST['submit_form']);
		
		$this->userlvl = userlvl::getInstance();
		$this->time = $this->userlvl->get_time();

		//quand on a appuyé sur "valider", récupération du formulaire
		if ( $this->submit )
		{	

		    
			$this->res['mot'] = isset($_POST['mot']) ? trim($_POST['mot']) : '';
		    $this->res['nivcarte'] = isset($_POST['nivcarte']) ? trim($_POST['nivcarte']) : '';
		    
		    $this->res['tabou1'] = isset($_POST['tabou1']) ? trim($_POST['tabou1']) : '';
		    $this->res['tabou2'] = isset($_POST['tabou2']) ? trim($_POST['tabou2']) : '';
		    $this->res['tabou3'] = isset($_POST['tabou3']) ? trim($_POST['tabou3']) : '';
		    $this->res['tabou4'] = isset($_POST['tabou4']) ? trim($_POST['tabou4']) : '';
		    $this->res['tabou5'] = isset($_POST['tabou5']) ? trim($_POST['tabou5']) : '';
	
		    $this->et_c_est_le_temps_qui_court = date("d/m/Y H:i");

		}
		
		// initialisation du booléen de codiion finale d'acceptation de la génération
		$this->boobool = true;
		
		// récupération des informations relatives à l'utilisateur: userid, et sa langue.
		$this->user = user::getInstance();
		$this->oracle = $this->user->id;
		$this->userlang = $this->user->userlang;
		
		// la génération automatique de carte n'existe qu'en français pour l'instant
		if ($this->userlang !== 'fr'){
			array_push( $this->errors,'no_card_active');

		}
		
		return true;
	}
	
	public function crawler()
	{
		if ( (($this->submit) && ($this->boobool == false)) || (!$this->submit)) // si on a appuyé sur valider mais que la carte est mauvaise (rechargement de la page) ou qu'on n'a pas encore appuyé sur valider
		{
			
			include_once('controllers/simple_html_dom.php');
		
			// fonction aléatoire entre 0 et 100 000
			$alea = mt_rand(0, 100000);

			$target_url = 'http://www.jeuxdemots.org/rezo-xml.php?gotermrelid='.$alea;
			$html = new simple_html_dom();
			$html->load_file($target_url);
			$motatrouver='';
			$listemot = '';
			foreach($html->find('body') as $post){
				$post= iconv("ISO-8859-1", "UTF-8", $post);
				$posts = $post ? explode('<br>', $post) : array();
			
					foreach ($posts as $wpost){
						$findmot = '&lt;mot-formate&gt;';	// pour trouver le mot à trouver
						$findme   = '&quot; tid=&quot;';	// pour trouver les mots tabous
						$mos = strpos($wpost, $findmot);
						$pos = strpos($wpost, $findme);
					

						// Notez notre utilisation de ===.  == ne fonctionnerait pas comme attendu
						// car la position de 'a' est la 0-ième (premier) caractère.
						if ($mos !== false) {
							$pos1=strpos($wpost, '&lt;mot-formate&gt;');
							$pos2=strpos($wpost, '&lt;/mot-formate&gt;');
							$motatrouver=substr($wpost, $pos1+19, ($pos2-($pos1+19)));
						//	echo "mot à trouver : ".$word.'<br />';
							$listemot = $motatrouver;
						}
						if ($pos !== false) {
							$pos1=strpos($wpost, '&quot;&gt;');
							$pos2=strpos($wpost, '&lt;/rel&gt;');
							$tabword=substr($wpost, $pos1+10, ($pos2-($pos1+10)));
							// récupération de la balise de relation pour affinage futur du crawler
							$pos3=strpos($wpost, '&lt;rel type=&quot;');
							$pos4=strpos($wpost, '&quot; poids');
							$tabbalise=substr($wpost, $pos3+19, ($pos4-($pos3+19)));
						
						//ici appel d'une fonction de tri qui renvoie vrai ou faux selon si le mot est acceptable comme mot tabou
						// test de $motatrouver dans $tabword, test de "_" dans $tabword, test de /^[A-Za-z]/ (s'il n'y a que des chiffres)
						// si au moins une de ces conditions est vrai alors la fonction renvoie false et le mot n'est pas ajouté.
					

							if ($this->checkmottab($motatrouver,$tabword,$tabbalise,$listemot)==true){
							//test extérieur car la fonction renvoie juste vrai. remplace "patate>89621" par "patate" tout court
								$tabword = preg_replace ('/\&gt;[0-9]+/', '' , $tabword);
								
								$listemot = $listemot.",".$tabword;
							}
						}
					
					}	
					
					//changement d'encodage à faire ici
					$this->tableau = $listemot ? explode(',', $listemot) : array();
					
					//Si la carte n'a pas 5 mots tabous, on ne la valide pas.
					if (!isset($this->tableau[5]))
					{
						$this->boobool = false;
					
					}else{
					// carte acceptée
						
						//adaptation à la page display qui utilise $res
						$this->res['mot'] = $this->tableau[0];
						$this->res['tabou1'] = $this->tableau[1];
						$this->res['tabou2'] = $this->tableau[2];
						$this->res['tabou3'] = $this->tableau[3];
						$this->res['tabou4'] = $this->tableau[4];
						$this->res['tabou5'] = $this->tableau[5];

						
						$this->boobool =true;
		
					}
	
			}	
		}
	}
	private function checkmottab($a,$b,$c,$d) //$a = $motatrouver, $b = $tabword, $c = $tabbalise, $d = $listemot
	{		
			
			$inclusiondash = strpos($b, '_'); //supprime tout ce qui commence par "_"
			if($inclusiondash !== false){
				return false;
			}
				
			$tagset = strpos($c, 'r_pos'); //supprime ce qui n'est que tag (Nom+Masc+Sing)
			if($tagset !== false){
				return false;
			}
			
			$inclusionmot = stripos($b, $a);//supprime tous les tabword contenant le mot à trouver: à affiner car on pourrait garder le reste
			if($inclusionmot !== false){
				return false;
			}
			
			$racinemot= substr($a,0,4); //récupère les 4 premiers caractères du mots (racine) si le mot ne fait que 3 lettres ça prend les trois lettres
			$inclusionracine = stripos($b,$racinemot); 
			if($inclusionracine !== false){				// Si le mot tabou a la même racine que le mot à trouver
				
				// L'idéal serait d'arriver à garder certains mots des locutions au lieu de les supprimer mais cette
				//condition ne marche pas:
				//~ $locution = preg_match($a.' W+ w+',$b); // Vérfification de locution, si s'en est une ($motatrouver de blabla):
				//~ if (($locution !== false)){
					//~ $b = preg_replace ($a.' W+ ', '' , $b);// remplace "$motatrouver de " par rien et ne garde que le "blabla".
				//~ }else{
				
					return false;							//sinon c'est juste un mot de la même famille
				//~ }
			}
			
			
			
			$suitepointschiffres = preg_match('/::/',$b); //enlève les suites du genre ":::112905:56362"
			if (($suitepointschiffres == 1)){
				return false;
			}
			
			$racinetab= substr($b,0,4); //récupère les 4 premiers caractères du mots (racine) si le mot ne fait que 3 lettres ça prend les trois lettres
			$doublon = stripos($d,$racinetab); // recherche du mot tabou dans la liste des mots tabous déjà enregistrés
			if (($doublon !== false)){
				return false;
			}
			
			return true;
		}
	


	private function display()
	{
		if (!$this->boobool) //carte non validée
		{
			 //on relance la procédure de génération
			$this->process();
		}else{
			
			if(isset($_POST['submit_form'])) //carte validée, enregistrement dans la BD
			{	
					// connxion à la BD
				    $db = db::getInstance();

				if ( !$this->submit || $this->errors )
				{
					return false;
				}
;
				// insertion de la carte
				$sql = 'INSERT INTO carte
				(idDruide,temps,niveau,langue,mot,tabou1,tabou2,tabou3,tabou4,tabou5)
					VALUES(' .
						$db->escape((string) $this->oracle) . ', ' .
						$db->escape((string) $this->et_c_est_le_temps_qui_court) . ', ' .
						$db->escape((string) $this->res['nivcarte']) . ', ' .
						$db->escape((string) $this->userlang) . ', ' .
						
						$db->escape((string) $this->res['mot']) . ', ' .
						$db->escape((string) $this->res['tabou1']) . ', ' .
						$db->escape((string) $this->res['tabou2']) . ', ' .
						$db->escape((string) $this->res['tabou3']) . ', ' .
						$db->escape((string) $this->res['tabou4']) . ', ' .
						$db->escape((string) $this->res['tabou5']) . ')';

				$db->query($sql);
				
					// requête de récupération de l'indentifiant de la carte juste créee pour insertion dans la table enregistrement
					$sql = "SELECT carteID,niveau FROM carte WHERE mot='".$this->res['mot']."'";
					$resulto=$db->query($sql);
					$reso= mysqli_fetch_assoc($resulto);
				
					$this->res['carteID'] = $reso['carteID'];
					
			// affichage de la carte
				include('./views/oracle.card.display.html');	
				
			}else{	
				//si carte pas encore validée, c'est le premier passage dans la page : affichage de la page génération de carte
				include('./views/oracle.alea.html');		
			}
		}
        return true;
	}
}

?>
