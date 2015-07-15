<?php
/*
------------------
Language: Français
------------------
*/

$lang = array();



//Utilisateurs : register.class.php, login.class.php, edit.form.html, login.form.html, register.form.html
$lang['user_username_blank'] = 'Vous devez entrer un pseudo.';
$lang['user_useremail_blank'] ='Vous devez entrer une adresse e-mail.';
$lang['user_password_blank'] = 'Vous devez entrer un mot de passe.';
$lang['user_passwordconfirm_blank'] = 'Veuillez confirmer votre mot de passe';
$lang['user_email_notvalid'] = 'Votre adresse e-mail n\'est pas valide.';
$lang['user_passwordconfirm_false'] = 'Vos mots de passe ne sont pas identiques.';
$lang['user_exists_already'] = 'Ce pseudo existe déjà.';
$lang['user_pass_user_nonmatch'] = 'Le pseudo et le mot de passe ne correspondent pas';
$lang['user_username'] ='Pseudo';
$lang['users_email'] = 'E-mail';
$lang['users_passwd'] = 'Mot de passe';
$lang['users_confirm_passwd'] = 'Entrez à nouveau votre mot de passe';
$lang['password_confirm'] = 'confirmez votre mot de passe';
$lang['photoProfil'] = 'Photo de profil';
$lang['user_userlang'] ='Langue de l\'utilisateur';
$lang['user_userlang_interface']='Langue de l\'interface';
$lang['login'] = 'Connexion';
$lang['logout'] = 'Déconnexion';
$lang['langue_apprentissage']='Indiquez la/les langue(s) que vous apprenez:';
$lang['ajout_langue']='ajouter une langue parlée';
//Menu et boutons de formulaires 
$lang['cmd_submit'] = 'Valider';
$lang['cmd_cancel'] = 'Annuler';
$lang['register'] = 'Enregistrer';
$lang['rules'] = 'Règles';
$lang['about'] = 'A propos';

//Page d'accueil: menu, home, page.header.html
$lang['menu_profile'] = 'Profil';
$lang['menu_logout'] = 'Déconnexion';
$lang['homepage'] = 'Accueil';
$lang['rules'] = 'Règles du Jeu';
$lang['home_welcome'] = 'Bienvenue';

$lang['oracle'] = 'Oracle';
$lang['druide'] = 'Druide';
$lang['devin'] = 'Devin';
$lang['learning'] = 'Vous jouez en ';

//Sélection des modes de jeux
$lang['select_mode'] = 'Selectionez un mode';
$lang['select_role']='Selectionez un rôle';
$lang['card_create'] = 'Création d\'une carte';
$lang['card_description']='Description d\'une carte';
$lang['game_arbitrage']='Arbitrage d\'une partie';

// Description d'une carte par un Oracle oracle.card.display.html
$lang['warning'] = 'Attention, votre micro n\'a pas été activé.';
$lang['cut_sound'] = 'vous serez par conséquant redirigé vers le menu principal. Veuillez paramétrer votre micro';
$lang['start_describe'] = 'Commence ta description :';
$lang['record'] = 'Jouer';
$lang['send_description'] = 'Envoie ta description !';
$lang['erase'] = 'Efface et recommence';
$pointsCoeff = $points*0.5;
//$lang['giveUp']='Enregistrement non fourni. Vous allez donc être sanctionné de 10 points en tant qu\'Oracle, mais pour vous encourager nous vous gratifions de 5 points Druide.';
//$lang['giveUpWithoutPoints'] = 'Vous n\'avez pas fourni d\'enregistrement. Vous n\'êtes cependant pas sanctionné puisque votre score d\'oracle est ègal à 0. Mais gare à vous la prochaine fois';
$lang['pointsOracle'] = 'L\'enregistrement a bien été déposé sur le serveur. Vous serez gratifié ou sanctionné de  '.$pointsCoeff.' points en fonction des résultats obtenus par les druides et devins.';
$lang['giveUpOracle'] = 'L\'enregistrement n\'a pas été déposé sur le serveur.';


// Affichage des cartes en création et lecture : Oracle | Druide | Devin
$lang['taboo_1'] = 'Mot Tabou 1';
$lang['taboo_2'] = 'Mot Tabou 2';
$lang['taboo_3'] = 'Mot Tabou 3';
$lang['taboo_4'] = 'Mot Tabou 4';
$lang['taboo_5'] = 'Mot Tabou 5';
$lang['taboo_6'] = 'Mot Tabou 6';
$lang['taboo']='Tabou';
$lang['theme']='Thème';
$lang['word_to_find'] = 'Mot à trouver';
$lang["wordForbid"] = 'Mots interdits';
$lang['word_direction'] = 'Choisissez votre niveau de difficulté: ';
$lang['level_easy'] = 'Facile';
$lang['level_medium'] = 'Moyen';
$lang['level_hard'] = 'Difficile';
$lang['validate'] = 'Valider';
$lang['reset'] = 'Réinitialiser';
$lang['random'] = 'Aléatoire';

$lang['card_creation'] = 'Création de carte';
$lang['more_taboo'] = '+ de mots  tabou';
$lang['less_taboo'] = '- de mots tabou';
$lang['enter_id'] ='Entrez un identifiant';

// Menu Oracle
$lang['card_alea'] = 'Carte Aléatoire (Création)';
$lang['card_exist'] = 'Carte Aléatoire (Existante)';
$lang['card_by_id'] = 'Carte par son Identifiant';

// Description d'une carte : Oracle
$lang['card_descr'] = 'Description d\'une carte';
$lang['description'] = 'Tu dois faire deviner aux autres joueurs  le<span class="motatrouver"> premier mot</span> sans dire les<span class="motTaboo"> autres mots.</span><br/>
Tu recevras 10 points à la fin de ta description. Si elle n\'est pas validée par le Druide, tu les perdras. Si elle est validée mais que le Devin ne trouve pas le mot décrit, tu perdras 5 points.';
$lang['abandonner']='Abandonner';
$lang['beware_time']='Tu peux recommencer ton enregistrement à infini, mais ton temps est limité. Si tu décides de ne pas envoyer tu perderas des points d\'Oracle mais tu gagneras un peu de Druide';
$lang['card_preview'] = 'Aperçu de votre carte';
$lang['id_describe'] = 'Voici l\' identifiant de votre carte (ID), transmettez-le à vos amis pour qu\'ils jouent à votre carte ! ';
$lang['unknown_id'] = 'Carte inaccessible: soit la carte n\'existe pas dans cette langue, soit vous en êtes le créateur et dans ce cas vous ne pouvez pas y jouer.';




//Arbitrage d'une description : Druide
$lang['arbitrage'] = 'Arbitrage d\'une description';
$lang['listen'] = 'Ecoute attentivement la description de l\'oracle. A-t-il utilisé des mots tabou?';
$lang['invalidate'] = 'Au bûcher!';

//Ecoute d'une description : Devin
$lang['listen_diviner'] = 'Ecoute attentivement la description de l\'oracle.';
$lang['id_card'] = 'Tu devines la carte numéro';
$lang['card_creator'] = 'Cette carte a été créée par';
$lang['card_oracle'] = 'Tu écoutes la description de';
$lang['card_level'] = 'Niveau de la carte décrite';
$lang['guess'] = 'Devine !';
$lang['which_word'] = 'Quel est le mot décrit ?';
$lang['NoGame']='Il n\'y a pas de carte à jouer.';
$lang["RecordCard"] ='Si vous voulez proposer un enregistrement pour cette carte cliquez ici : ';
$lang["RecordArbitre"] ='Si vous voulez arbitrer cet enregistrement cliquez ici : ';
$lang["restart"] ='Rejouer une partie ? ';
$lang["start"] ='Il est temps de jouer !';
$lang["game"] ='Jouer';


//Résultats, Scores et Points
$lang['well_done'] = 'Félicitation!';
$lang['points'] = ' +'.$points.' Points';
$lang['too_bad'] = 'Dommage!';
$lang['no_point'] = 'Tu n\'as pas eu de points';
$lang['result'] = 'Score';
$lang['return']= 'Retour';
$lang['score_role'] = 'En fonction des rôles que tu as joué.';
$lang['scores'] = 'Scores';
$lang['classement'] = 'Classement';
$lang['nbLangues'] = 'Nombre de langues';
$lang['score_oracle']= 'Score_Oracle';
$lang['score_druid']= 'Score_Druide';
$lang['score_diviner']= 'Score_Devin';
$lang['score_global']= 'Score Global';
$lang['pointsDruide']= '+ 10 points';
$lang['userName']= 'Joueur';


// Timeout
$lang['diviner_timeout'] = 'Tu n\'as pas fourni de réponse dans le temps imparti';
$lang['oracle_timeout'] = 'Tu n\'as pas fourni de description dans le temps imparti';
$lang['oracle_card_timeout'] = 'Tu n\'as pas répondu à la carte dans le temps imparti';

//Triche 
$lang['sanction'] = 'Il semblerait que vous avez subitement quitté la précédente partie. Par conséquent, vous serez sanctionné de 5 points...';
$lang['sanction_without_points'] = 'Il semblerait que vous ayez subitement quitté la partie précédente. Néamoins vous n\'avez pas de point pour le moment, vous ne serez donc pas sanctionné! Mais gare à vous la prochaine fois ;)';

//Pas de partie jouable
$lang['NoGame']='aucune partie disponible pour l\'instant.';
//
$lang['add_btn']='Ajouter un mot tabou';
$lang['remv_btn']='Retirer un mot tabou';
$lang['subj']='Choisissez votre thème ou créez-en un nouveau';

//Erreurs
$lang['unavailable_card'] = 'Carte inaccessible: la carte n\'existe pas.';
$lang['without_card']= 'Désolé, il n\'y a pas de carte disponible à  jouer, veuillez en créer une.'; 
$lang['no_card']= 'Carte inaccessible: soit la carte n\'existe pas dans cette langue, soit vous en êtes le créateur et dans ce cas vous ne pouvez pas y jouer.';
$lang['no_card_active']= 'La génération de carte n\'est pas active pour d\'autres langues que le français pour l\'instant';
$lang['user_name']= 'Veuillez entrer un pseudo';
$lang['email']= 'Veuillez entrer une adresse mail';
$lang['password']= 'Veuillez entrer un mot de passe';
$lang['choose_lang']= 'Veuillez choisir une langue';
$lang['invalid_email']= 'L\'adresse mail est invalide';
$lang['invalid_password']= 'Les password ne sont pas compatibles';
$lang['username_exist']= 'Cet utilisateur existe déjà';
$lang['enter_username']= 'Il faut entrer un pseudo';
$lang['enter_password']= 'Il faut entrer un mot de passe';
$lang['not_match']= 'Le pseudo ou le mot de passe est incorrect...';
$lang['enter_email']= 'Il faut entrer une adresse mail';
$lang['enter_language']= 'Il faut choisir une langue';
$lang['tabooWords']= 'L\'intitulé de la carte doit être différent des mots taboo';
$lang['noCardBD']= 'Il n\'y a pas de carte à jouer dans la base de données...';
$lang['noEnregistrement']= 'Aucun enregistrement n\'a été trouvé.';
$lang['Becareful']= 'ATTENTION!';
$lang['enter_nativelang']='Veuillez entrer votre langue maternelle';
$lang['Word2find'] = "Le mot à trouver était : ";
$lang['home_miss_lang_game'] = 'Veuillez sélectionner une langue de jeu dans votre profil.';

$lang["languePlay"] = "Vous jouez en ";



//Erreur upload
$lang['file_unupload'] = 'Attention le fichier a mal été uploadé.';
$lang['sizeOfUp'] = 'La taille du fichier uploadé est trop grande.';
$lang['extUp'] = 'Le fichier uploadé n\'est pas dans un format acceptable (png,gif,jpg,jpeg).'; 
$lang['uploadProb'] = 'Le fichier n\'a pas été uploadé...'; 

//
$lang['same_lang'] = 'Vous avez choisi deux fois la même langue  dans langues parlées '; 



?>
