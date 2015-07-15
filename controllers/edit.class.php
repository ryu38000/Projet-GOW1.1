<?php

class edit
{
    private $submit = false;
    private $userid = 0;
    private $username = '';
    private $useremail = '';
    private $password = '';
    private $password_confirm = '';
    private $userlang = '';
    private $errors = array();
    private $mode = '';
    private $spoken_lang='';
    private $niveau='';
    private $photo ='';
    private $userlvl = '';

    private $userlang_game = '';
    private $userlang_interface = '';

    public function set_mode($mode)
    {
        $this->mode = $mode;
    }

    public function process()
    {
        if ( $this->init() )
        {
            $this->check();
            $this->validate();
            return $this->display();
        }
        return false;
    }

    private function init()
    {
	   include('./sys/load_iso.php');
    

        $db = db::getInstance();
        $user = user::getInstance();

		$this->userlang = $user->get_lang();

        // initialisation
        $this->submit = isset($_POST['submit_form']);

        $this->userid = ($this->mode == 'profile') ? intval($_SESSION['userid']) : (isset($_REQUEST['userid']) && intval($_REQUEST['userid']) ? intval($_REQUEST['userid']) : 0 );

        // recherche dans la BDD
        $sql = 'SELECT *
                    FROM user
                    WHERE userid = ' . intval($this->userid);
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $result->free();
        if ( !$row )
        {
            die('Game over.');
        }
        $this->username = $row['username'];
        $this->useremail = $row['useremail'];
        $this->photo = $row['photo'];
        $this->userlvl = $row['userlvl'];

        if (!file_exists($this->photo)) {
            $this->photo = "profil/unknow.jpg";
        }
	
	$this->userlang_interface = $row['userlang'];
	$this->userlang_game = $row['userlang_game'];
	
	// TODO initialiser les datalist (edit.form.html) avec les langues parlées dans la bd
	$sql = 'SELECT *
                    FROM user_niveau
                    WHERE userid = ' . intval($this->userid);
        $result = $db->query($sql);
        $row = $result->fetch_assoc();
        $result->free();

	$this->spoken_lang = $row['spoken_lang'];
	$this->niveau = $row['niveau'];

        // recherche sur le formulaire
        if ( $this->submit )
        {
             include('./sys/upload.php');
            

            $upload = upload($_POST["profilphot"],'profil/',3000000, array('png','gif','jpg','jpeg'), $this->username );
            if($upload){
                if(is_array($upload)){
                     $this->errors=$upload;
                 }
                else{
                    $this->photo=$upload;
                }
            }

            $this->username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $this->useremail = isset($_POST['useremail']) ? trim($_POST['useremail']) : '';
            $this->password = isset($_POST['userpass']) ? trim($_POST['userpass']) : '';
            $this->password_confirm = isset($_POST['password_confirm']) ? trim($_POST['password_confirm']) : '';
            $this->userlvl = isset($_POST['userlvl']) ? trim($_POST['userlvl']) : '';


        // TODO réecuper la langue de jeu suivant l'id de la case "jeu" sélectionnée
            $this->userlang = isset($_POST['userlang_interface']) ? trim($_POST['userlang_interface']) : '';
            //$_SESSION["langDevin"] = $this->userlang ;
	    $this->spoken_lang = '';
	    $this->niveau = '';
	    
         for ($i=1; $i<=10; $i++) {
            for($j=$i+1; $j<=10; $j++){
                if(isset($_POST['choix_langs_'.$i]) && isset($_POST['choix_langs_'.$j]) && $_POST['choix_langs_'.$i] == $_POST['choix_langs_'.$j]){
                    array_push( $this->errors,'same_lang');
                    break;
                }
            }
            
         $this->spoken_lang .= isset($_POST['choix_langs_'.$i]) ? trim($_POST['choix_langs_'.$i]).';' : '';


            //$this->spoken_lang .= isset($_POST['choix_niveau_'.$i]) ? trim($_POST['choix_niveau_'.$i]).';' : '';
            $this->niveau .= isset($_POST['choix_niveau_'.$i]) ? trim($_POST['choix_niveau_'.$i]).';' : '';

            if (!isset($_POST['choix_niveau_'.$i])) { break; }

        }

	    $this->userlang_game = isset($_POST['lang_game']) ? array_search(trim($_POST['lang_game']),$iso) : '';
	   // $this->userlang_interface = isset($_POST['userlang_interface']) ? trim($_POST['userlang_interface']) : '';
            //$this->spoken_lang = isset($_POST['userlang_spoken']) ? trim($_POST['userlang_spoken']) : '';
	    //echo $this->spoken_lang;
	   //TODO ajouter les nouveaux champs
	    //$this->langs = isset($_POST['langs']) ? trim($_POST['langs']) : '';
        }
        return true;
    }
//TODO ajouter test sur nouveaux champs
    private function check()
    {
        $db = db::getInstance();

        if ( !$this->submit )
        {
            return false;
        }
        if ( empty($this->username) )
        {
		array_push( $this->errors,'enter_username');

        }
        if ( empty($this->useremail) )
        {
            array_push( $this->errors,'enter_email');
        }

	//if (empty($this->spoken_lang))
	//{
		//echo "erreur!!!";
	//}
	
        if ( empty($this->userlang) )
        {
            array_push( $this->errors,'enter_language');
        }
        // Vérification de l'unicité
        if ( !$this->errors )
        {
            $mailvalid = true;
            if ( !filter_var($this->useremail, FILTER_VALIDATE_EMAIL) )
            {
               array_push( $this->errors,'invalid_email');
                $mailvalid = false;
            }
            if ( $this->password )
            {
                if ( $this->password != $this->password_confirm )
                {
                    array_push( $this->errors,'invalid_password');
                }
            }
        }
    }

    private function validate()
    {
        $db = db::getInstance();

        if ( !$this->submit || $this->errors )
        {
            return false;
        }
        $sql = 'UPDATE user
                    SET
                        username = ' . $db->escape((string) $this->username) . ',
                        useremail = ' . $db->escape((string) $this->useremail) . (!$this->password ? '' : ',
                        userpass = ' . $db->escape((string) md5($this->password))) . ',
                        userlang = ' . $db->escape((string) $this->userlang) . ',
			            userlang_game = ' . $db->escape((string) $this->userlang_game) . ',
                        photo = ' . $db->escape((string) $this->photo) . ',
                        userlvl = ' . $db->escape((string) $this->userlvl) . '
                    WHERE userid = ' . intval($this->userid);
	
        $db->query($sql);
	
	// test whether the user has a record in the 'user_niveau' table
	$sql = "SELECT * FROM user_niveau WHERE userid = " . intval($this->userid);
	$result = $db->query($sql);
	if ($result->num_rows > 0) {
	      $sql = 'UPDATE user_niveau 
		      SET					
			spoken_lang='. $db->escape((string)$this->spoken_lang). ', 
			niveau='. $db->escape((string) $this->niveau) . '
		 WHERE userid = ' . intval($this->userid);
	} else {
		$sql = 'INSERT INTO user_niveau '
			. '(userid,spoken_lang,niveau) VALUES('
			. intval($this->userid) . ', '
			. $db->escape((string)$this->spoken_lang). ', '
			. $db->escape((string) $this->niveau) . ')';
	}

					
	
        $db->query($sql);	
        for ($i=1; $i<=10; $i++) {
                if(isset($_POST['choix_langs_'.$i]) && $_POST['choix_langs_'.$i]!=""){
                    $sql = 'SELECT *
                        FROM score
                        WHERE userid = ' . intval($this->userid).' AND langue="'.$_POST["choix_langs_".$i].'"';
                    $result = $db->query($sql);
                      if (!($result->num_rows > 0)) {
                           $score = 0;
                            $sql = 'INSERT INTO `score`(`userid`, `scoreGlobal`, `scoreOracle`, `scoreDruide`, `scoreDevin`, `langue`) VALUES ('.$this->userid.','.$score.','.$score.','.$score.','.$score.',"'.$_POST["choix_langs_".$i].'")';
                          $db->query($sql);
                        }
                 }
         }

	
        // Mise à jour de la bdd
        redirect('');
    }

    private function display()
    {
        include('./views/edit.form.html');
        return true;
    }
}

?>