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
$lang['user_userlang'] ='Langue de l\'utilisateur';
$lang['login'] = 'Connexion';
$lang['logout'] = 'Déconnexion';

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
$lang['learning'] = 'Vous apprenez le Français.';

//Sélection des modes de jeux
$lang['select_mode'] = 'Selectionez un mode';
$lang['card_create'] = 'Création d\'une carte';
$lang['card_description']='Description d\'une carte';
$lang['game_arbitrage']='Arbitrage d\'une partie';

// Description d'une carte par un Oracle oracle.card.display.html
$lang['warning'] = 'Attention';
$lang['cut_sound'] = 'Vous allez vous enregistrer, il est fortement recommandé de couper le son de vos enceintes avant de lancer l\'enregistrement et de le remettre ensuite pour pouvoir entendre votre description.';
$lang['start_describe'] = 'Commence ta description :';
$lang['record'] = 'Enregistre-toi';
$lang['send_description'] = 'Envoie ta description !';
$lang['erase'] = 'Efface et recommence';

// Affichage des cartes en création et lecture : Oracle | Druide | Devin
$lang['taboo_1'] = 'Mot Tabou 1';
$lang['taboo_2'] = 'Mot Tabou 2';
$lang['taboo_3'] = 'Mot Tabou 3';
$lang['taboo_4'] = 'Mot Tabou 4';
$lang['taboo_5'] = 'Mot Tabou 5';

$lang['word_to_find'] = 'Mot à trouver';
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
$lang['beware_time'] = 'Attention! tu as un temps limité !';
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

//Résultats, Scores et Points
$lang['well_done'] = 'Félicitation!';
$lang['points'] = ' +10 Points';
$lang['too_bad'] = 'Dommage!';
$lang['no_point'] = 'Tu n\'as pas eu de points';
$lang['result'] = 'Score';
$lang['return']= 'Retour';
$lang['score_role'] = 'En fonction des rôles que tu as joué.';
$lang['scores'] = 'Scores';
$lang['score_oracle']= 'Oracle';
$lang['score_druid']= 'Druide';
$lang['score_diviner']= 'Devin';
$lang['score_global']= 'Score Global';

// Timeout
$lang['diviner_timeout'] = 'Tu n\'as pas fourni de réponse dans le temps imparti';
$lang['oracle_timeout'] = 'Tu n\'as pas fourni de description dans le temps imparti';
$lang['oracle_card_timeout'] = 'Tu n\'as pas choisi de carte dans le temps imparti';


?>
