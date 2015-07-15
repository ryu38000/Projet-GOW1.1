<?php
/*
------------------
Language: English
------------------
*/

$lang = array();

///Utilisateurs : register.class.php, login.class.php, edit.form.html, login.form.html, register.form.html
$lang['user_username_blank'] = 'You must enter a user name';
$lang['user_useremail_blank'] ='You must enter an email address';
$lang['user_password_blank'] = 'You must enter a password';
$lang['user_passwordconfirm_blank'] = 'Please confirm your password';
$lang['user_email_notvalid'] = 'Your email is not valid';
$lang['user_passwordconfirm_false'] = 'Your passwords do not match';
$lang['user_exists_already'] = 'This username already exists';
$lang['user_pass_user_nonmatch'] = 'The user name or the password is not a match';
$lang['user_username'] ='User name';
$lang['users_email'] = 'Email';
$lang['users_passwd'] = 'Password';
$lang['users_confirm_passwd'] = 'Re-enter password';
$lang['password_confirm'] = 'confirm your password';
$lang['photoProfil'] = 'Profile\'s photo';
$lang['user_userlang'] ='User language';
$lang['user_userlang_interface']='Interface language';
$lang['login'] = 'Log in';
$lang['logout'] = 'Log out';
$lang['user_userlang_maternelle']='native language';
$lang['langue_apprentissage']='Choose a/the languages that you are studying:';
$lang['ajout_langue']='Add a language that you are studying';

//Menu et boutons de formulaires
$lang['cmd_submit'] = 'Submit';
$lang['cmd_cancel'] = 'Cancel';
$lang['register'] = 'Register';
$lang['rules'] = 'Rules';
$lang['about'] = 'About';

//Page d'accueil: menu, home, page.header.html
$lang['menu_profile'] = 'Profile';
$lang['menu_logout'] = 'Logout';
$lang['homepage'] = 'Home';
$lang['rules'] = 'Rules';
$lang['home_welcome'] = 'Welcome';

$lang['oracle'] = 'Oracle';
$lang['druide'] = 'Druid';
$lang['devin'] = 'Diviner';
$lang['learning'] = 'You\'re playing in ';
$lang['userName'] = 'Player';

//Sélection des modes de jeux
$lang['select_mode'] = 'Select a mode';
$lang['select_role']='Select a role';
$lang['card_create'] = 'Card creation';
$lang['card_description']='Card description';
$lang['game_arbitrage']='Referee a game';

// Description d'une carte par un Oracle oracle.card.display.html
$lang['warning'] = 'Warning';
$lang['cut_sound'] = 'You have not authorised your microphone. Therefore you will return back to the principal menu of the game.';
$lang['start_describe'] = 'Start your description :';
$lang['record'] = 'Play';
$lang['send_description'] = 'Send your description !';
$lang['erase'] = 'Erase and restart';
//$lang['giveUp']=' You did not send your record, Therefore you will loose 10 points as Oracle but you will get 5 points as Druide'; 
//$lang['giveUpWithoutPoints'] = 'You did not send your record. But you have not enought points to loose. So you don\'t loose points for this time... Be carefull the next time ;)';

$pointsCoeff = $points*0.5;
$lang['pointsOracle'] = ' The record  has been sent. you will gain or loose '.$pointsCoeff.' points according the Druid/Oracle points.'; 
$lang['giveUpOracle'] = ' The record has not been sent to the server.';


// Affichage des cartes en création et lecture : Oracle | Druide | Devin
$lang['taboo_1'] = 'Word Taboo 1';
$lang['taboo_2'] = 'Word Taboo 2';
$lang['taboo_3'] = 'Word Taboo 3';
$lang['taboo_4'] = 'Word Taboo 4';
$lang['taboo_5'] = 'Word Taboo 5';
$lang['taboo_6'] = 'Word Taboo 6';
$lang['taboo']=' Taboo';
$lang['theme']='Subject';
$lang['word_to_find'] = 'Word to Find';
$lang["wordForbid"] = 'Forbidden words';
$lang['word_direction'] = 'Choose your difficulty level: ';
$lang['level_easy'] = 'Easy';
$lang['level_medium'] = 'Medium';
$lang['level_hard'] = 'Hard';
$lang['validate'] = 'Validate';
$lang['reset'] = 'Reset';
$lang['random'] = 'Randomize';

$lang['card_creation'] = 'Card Creation';
$lang['more_taboo'] = 'More taboo';
$lang['less_taboo'] = 'Less taboo';
$lang['enter_id'] ='Entrer an Id';

// Menu Oracle
$lang['card_alea'] = 'Random Card (Create)';
$lang['card_exist'] = 'Random Card (Exist)';
$lang['card_by_id'] ='Card by it\'s Identification';

// Description d'une carte : Oracle
$lang['card_descr'] = 'Card Description';
$lang['description'] = 'You let the others gusse your description of the<span class="motatrouver"> first word</span> without using <span class="motTaboo"> the others words</span>';
$lang['beware_time']=' You can restart your recording as much as you want but beware, you are limited in time. If you don\'t send your recording, you loose the points from Oracle, but you get some points from Druide.';
$lang['card_preview'] = 'Card Preview';
$lang['id_describe'] = 'Here is your Card ID, send it to your friend so they can play with it ! ';
$lang['unknown_id'] = 'Unreachable card: either the card does not exist in this language, or your are it\'s creator and therefor can\'t play with.';
$lang['abandonner']='Give up';


//Arbitrage d'une description : Druide
$lang['arbitrage'] = 'Description Arbitration';
$lang['listen'] = 'Listen carefully to the Oracle description. Did he used taboo words?';
$lang['invalidate'] = 'Burn at the stake!';

//Ecoute d'une description : Devin
$lang['listen_diviner'] = 'Listen carefully to the Oracle description.';
$lang['id_card'] = 'You are guessing the card :';
$lang['card_creator'] = 'This card was created by :';
$lang['card_oracle'] = 'You listen to the description of :';
$lang['card_level'] = 'Level of the card : ';
$lang['guess'] = 'Guess !';
$lang['which_word'] = 'What is the word described ?';
$lang["RecordCard"] ='If you want to record yourself click here : ';
$lang["RecordArbitre"] ='If you want to judge this record click here : ';
$lang["restart"] ='Play again ? ';
$lang["start"] ='It\'s time to play the game !';
$lang["game"] ='Start the game';


//R�sultats, Scores et Points
$lang['well_done'] = 'Congratulation!';
$lang['points'] = ' +'.$points.' Points';
$lang['too_bad'] = 'Too bad !';
$lang['no_point'] = 'You haven\'t got points';
$lang['result'] = 'Score';
$lang['return']= 'Return';
$lang['score_role'] = 'Regarding the roles you played';
$lang['scores'] = 'Scores';
$lang['nbLangues'] = 'Languages number';
$lang['classement'] = 'Classement';
$lang['score_oracle']= 'Oracle_Score';
$lang['score_druid']= 'Druid_Score';
$lang['score_diviner']= 'Diviner_Score';
$lang['score_global']= 'Global score';
$lang['pointsDruide']= '+ 10 points';


// Timeout
$lang['diviner_timeout'] = 'You did not give an anwser in time';
$lang['oracle_timeout'] = 'You did not make a description in time';
$lang['oracle_card_timeout'] = 'You did not answer the card in time';


//Triche 
$lang['sanction']='We are sory but it seems that you leave suddenly the plateforme! So, you loose 5 points!';
$lang['sanction_without_points']='We are sory but it seems that you leave suddenly the plateforme! You are lucky this time, you don\'t have points to loose! But be careful the next time...';

//Pas de partie jouable
$lang['NoGame']='You have already played all the cards.';
//
$lang['add_btn']='Add a taboo word';
$lang['remv_btn']='Remove a taboo word';
$lang['subj']='Select your subject or create a new one';

//Erreurs
$lang['unavailable_card'] = 'Access card denied. The card does\'nt exist';
$lang['without_card']= 'Sorry,  There is no card to play, Would you create one.';
$lang['no_card']= ' Access card denied: maybe the card does\'nt exist in this language or  you are the creator of the card and  so, you can not play this card.'; 
$lang['no_card_active']= ' Card production is not available  for the other languages; is just available for french.'; 
$lang['user_name']= 'Please enter a user name';
$lang['email']= 'Please enter an email address';
$lang['password']= 'Please enter a password';
$lang['choose_lang']= 'Choose a language';
$lang['invalid_email']= 'Invalid email!';
$lang['invalid_password']= 'The passwords do not match';
$lang['username_exist']= 'This username already exists';
$lang['enter_username']= 'You must enter a user name';
$lang['enter_password']= 'You must enter a password';
$lang['not_match']= 'The user name or the password are not match.';
$lang['enter_email']= 'You must enter an email';
$lang['enter_language']= 'You must choose a language';
$lang['enter_nativelang']='Please enter your native language';
$lang['tabooWords']= 'The word to find in the card must be diffrent from the taboo words';
$lang['noCardBD']= ' There is no card to play in the Data base';
$lang['noEnregistrement']= ' There is no available record'; 
$lang['Becareful']= 'Attention!';
$lang['Word2find'] = "The word to find is:";
$lang['home_miss_lang_game'] = 'Please select a game language in your profile.';

$lang["languePlay"] = "You are playing in ";

//Erreur upload
$lang['file_unupload'] = 'Attention, the file was not fully uploaded.';
$lang['sizeOfUp'] = 'The uploaded file is too large.';
$lang['extUp'] = 'The uploaded file format is not supported (accepted formats are: png,gif,jpg,jpeg).'; 
$lang['uploadProb'] = 'The file has not been uploaded yet...'; 

//
$lang['same_lang'] = ' You have chosen twice the same language in langues parlées';

?>
