<?php

class register
{
    private $submit = false;
    private $username = '';
    private $useremail = '';
    private $password = '';
    private $password_confirm = '';
    private $photo='';
    private $userlang = '';
    private $errors = array();
    private $spoken_lang='';
    private $points_initiaux= 0;
    private $userid = 0;
    private $niveau='';
    private $GameLvl='';
    private $userlang_game = '';


    private $mode = '';

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
        $this->submit = isset($_POST['submit_form']);
        if ( $this->submit )
        {
            include('./sys/upload.php');
            
            $this->photo='';
            $upload = upload($_POST["profilphot"],'profil/',3000000, array('png','gif','jpg','jpeg'),$_POST['username'] );
            if(is_array($upload)){
                 $this->errors=$upload;
            }
            else{
                $this->photo=$upload;
            }

            $this->username = isset($_POST['username']) ? trim($_POST['username']) : '';
            $this->useremail = isset($_POST['useremail']) ? trim($_POST['useremail']) : '';
            $this->password = isset($_POST['userpass']) ? trim($_POST['userpass']) : '';
            $this->password_confirm = isset($_POST['password_confirm']) ? trim($_POST['password_confirm']) : '';
            $this->userlang = isset($_POST['userlang']) ? trim($_POST['userlang']) : '';
            $this->GameLvl = isset($_POST['userlvl']) ? trim($_POST['userlvl']) : '';

	   $this->spoken_lang = '';
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
        }
        return true;
    }

    private function check()
    {
        $db = db::getInstance();

        if ( !$this->submit )
        {
            return false;
        }

        if ( empty($this->username) )
        {
            array_push($this->errors,'user_name');
        }
        if ( empty($this->useremail) )
        {
            array_push($this->errors,'email');
        }
        if ( empty($this->password) )
        {
           array_push($this->errors,'password');
        }
        if ( empty($this->password_confirm) )
        {
            array_push($this->errors,'password_confirm');
        }
        if ( empty($this->userlang) )
        {
            array_push($this->errors,'choose_lang');
        }
        // Vérification de l'unicité
        if ( !$this->errors )
        {
            $mailvalid = true;
            if ( !filter_var($this->useremail, FILTER_VALIDATE_EMAIL) )
            {
                array_push($this->errors,'invalid_email');
                $mailvalid = false;
            }
            if ( $this->password != $this->password_confirm )
            {
                array_push($this->errors,'invalid_password');
            }
            $sql = 'SELECT *
                        FROM user
                        WHERE username = ' . $db->escape((string) $this->username) . (!$mailvalid ? '' : '
                            OR useremail = ' . $db->escape((string) $this->useremail) );
            $result = $db->query($sql);
            $row = $result->fetch_assoc();
            $result->free();
            if ($row)
            {
                array_push($this->errors,'username_exist');
            }
        }
    }

    private function validate()
    {
        $db = db::getInstance();
		// Mise à jour de la bdd
        if ( !$this->submit || $this->errors )
        {
            return false;
        }
        $sql = 'INSERT INTO user
                    (username, useremail, userpass, userlang, userlang_game, photo, userlvl)
					VALUES(' .
						$db->escape((string) $this->username) . ', ' .
						$db->escape((string) $this->useremail) . ', ' .
						$db->escape((string) md5($this->password)) . ', ' .
						//spoken_lang = ' . $db->escape((string) $this->spoken_lang) . ',
						$db->escape((string) $this->userlang) . ',' .
						$db->escape((string) $this->userlang_game) . ','.
                        $db->escape((string) $this->photo) .','.
                        $db->escape((string) $this->GameLvl) .')' ;
						
					
						
        $db->query($sql);
   
	// ajout d'une ligne correspondante dans la table score
        
			//selection de l'id de l'utilisateur
       
			$sql = 'SELECT userid
                    FROM user WHERE username="'.$this->username.'"';	    
			$result=$db->query($sql);
			$res= mysqli_fetch_assoc($result);
			$this->userid=$res['userid'];
			
	
     //ajout des langues parlées dans la table user_niveau
	      $sql = 'INSERT INTO user_niveau
                    (userid, spoken_lang, niveau)
					VALUES(' .
						$db->escape((string) $this->userid) . ', ' .
						$db->escape((string)$this->spoken_lang). ', '.
						$db->escape((string) $this->niveau) . ')' ;
					
						
        $db->query($sql);	
			
			//insertion dans la table score
            $spoken_langg = explode(';',$this->spoken_lang);

            foreach ($spoken_langg as $key){
                if($key!=""){
        			$sql = 'INSERT INTO score
                       (userid, scoreGlobal, scoreOracle, scoreDruide, scoreDevin, langue)
    	       				VALUES(' .
    			     			$db->escape((string) $this->userid) . ', ' .
    				    		$db->escape((string) $this->points_initiaux) . ', ' .
    					       	$db->escape((string) $this->points_initiaux) . ', ' .
    						  $db->escape((string) $this->points_initiaux) . ', ' .
    						  $db->escape((string) $this->points_initiaux) . ', ' .
                                $db->escape((string) $key) . ')';
			         $db->query($sql);
                 }
            }
        redirect('');
    }

    private function display()
    {
        include('./views/register.form.html');
        return true;
    }
}

?>
