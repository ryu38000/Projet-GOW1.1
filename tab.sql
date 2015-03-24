-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 26 Février 2015 à 19:02
-- Version du serveur: 5.5.40
-- Version de PHP: 5.4.36-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `tab`
--

-- --------------------------------------------------------

--
-- Structure de la table `arbitrage`
--

CREATE TABLE IF NOT EXISTS `arbitrage` (
  `arbitrageID` int(11) NOT NULL AUTO_INCREMENT,
  `enregistrementID` int(11) NOT NULL,
  `idDruide` int(11) NOT NULL,
  `tpsArbitrage` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `validation` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`arbitrageID`),
  KEY `validation` (`validation`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `arbitrage`
--

INSERT INTO `arbitrage` (`arbitrageID`, `enregistrementID`, `idDruide`, `tpsArbitrage`, `validation`) VALUES
(1, 5, 1, '24/02/2015 04:32', 'valid'),
(2, 13, 6, '25/02/2015 00:39', 'invalid'),
(3, 12, 6, '25/02/2015 00:39', 'invalid'),
(4, 2, 6, '25/02/2015 00:40', 'invalid'),
(5, 11, 6, '25/02/2015 00:40', 'valid'),
(6, 13, 6, '25/02/2015 00:40', 'valid'),
(7, 2, 6, '25/02/2015 00:41', 'valid'),
(8, 16, 6, '25/02/2015 00:42', 'invalid'),
(9, 15, 6, '25/02/2015 00:51', 'valid'),
(10, 12, 2, '25/02/2015 03:30', 'valid'),
(11, 8, 2, '25/02/2015 16:47', 'valid'),
(12, 2, 2, '25/02/2015 16:50', 'valid'),
(13, 16, 1, '25/02/2015 17:00', 'valid'),
(14, 8, 1, '25/02/2015 17:02', 'valid'),
(15, 24, 7, '25/02/2015 18:31', 'valid'),
(16, 11, 7, '25/02/2015 18:31', 'valid'),
(17, 5, 8, '26/02/2015 17:01', 'valid');

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE IF NOT EXISTS `carte` (
  `carteID` int(11) NOT NULL AUTO_INCREMENT,
  `theme` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idDruide` int(30) NOT NULL,
  `temps` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `niveau` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `langue` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mot` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tabou1` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tabou2` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tabou3` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tabou4` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tabou5` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`carteID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `carte`
--

INSERT INTO `carte` (`carteID`, `theme`, `idDruide`, `temps`, `niveau`, `langue`, `mot`, `tabou1`, `tabou2`, `tabou3`, `tabou4`, `tabou5`) VALUES
(1, '', 6, '24/02/2015 03:45', 'facile', 'en', 'coffee', 'bean', 'drink', '', '', ''),
(2, '', 6, '24/02/2015 03:46', 'moyen', 'en', 'phone', 'talk', 'distance', 'hand', '', ''),
(3, '', 6, '24/02/2015 03:48', 'difficile', 'en', 'orchid', 'flower', 'rare', 'plant', '', ''),
(4, '', 1, '24/02/2015 03:49', 'facile', 'fr', 'poire', 'fruit', 'pomme', '', '', ''),
(5, '', 1, '24/02/2015 03:50', 'moyen', 'fr', 'dessin', 'crayon', 'papier', 'feuille', '', ''),
(6, '', 1, '24/02/2015 03:51', 'difficile', 'fr', 'doctoresse', 'faire des études', 'passer sa thèse', 'femme', 'professionnel de santé', 'être humain'),
(7, '', 5, '24/02/2015 03:56', 'difficile', 'fr', 'tranquilliser', 'calme', 'soulagement', 'sécurité', 'apaiser', 'mettre'),
(8, '', 5, '24/02/2015 04:04', 'difficile', 'fr', 'forge', 'marteau', 'feu', 'enclume', 'métal', 'chauffer'),
(9, '', 5, '24/02/2015 04:10', 'difficile', 'fr', 'chevreuil', 'cervidé', 'ruminant', 'herbivore', 'artiodactyle', 'mammifère'),
(10, '', 2, '24/02/2015 23:42', 'facile', 'fr', 'pomme de terre', 'tubercule', 'frite', '', '', ''),
(11, '', 2, '24/02/2015 23:44', 'facile', 'fr', 'chocolat', 'carré', 'sucre', 'barre', '', ''),
(12, '', 4, '24/02/2015 23:45', 'difficile', 'fr', 'Astérix', 'gaulois', 'obélix', 'potion magique', 'césar', 'irreductible'),
(13, '', 4, '24/02/2015 23:47', 'difficile', 'fr', 'saucisson', 'saucisse sèche', 'cochon', 'gras', 'porc', 'ferme'),
(14, '', 4, '24/02/2015 23:48', 'moyen', 'fr', 'poney', 'cheval', 'petit', 'licorne', 'pégase', 'sabot'),
(15, '', 2, '24/02/2015 23:49', 'moyen', 'en', 'Beatles', 'rock', 'band', 'submarine', 'Lucy', ''),
(16, '', 4, '24/02/2015 23:49', 'facile', 'fr', 'ballon', 'football', 'baudruche', 'fête', 'gonfler', 'rond'),
(17, '', 2, '25/02/2015 00:29', 'facile', 'fr', 'cadenas', 'clé', 'fermer', 'verrou', 'serrure', 'clef'),
(18, '', 2, '25/02/2015 03:31', 'facile', 'fr', 'moussant', 'bulle', 'écumant', 'émulsionnant', 'spumescent', 'bain'),
(19, '', 2, '25/02/2015 14:59', 'facile', 'fr', 'dirigiste', 'interventionniste', 'étatiste', 'Blocus', 'John Maynard Keynes', 'Ludwig von Mises'),
(20, '', 2, '25/02/2015 16:33', 'facile', 'fr', 'baguette', 'pain', 'magique', 'mener', 'France', ''),
(21, '', 2, '25/02/2015 16:34', 'facile', 'fr', 'jeux vidéo', 'console', 'ordinateur', 'addiction', 'jouer', 'playstation'),
(22, '', 2, '25/02/2015 16:36', 'moyen', 'fr', 'rouille', 'fer', 'couleur', 'sauce', 'oxydation', 'métal'),
(23, '', 7, '25/02/2015 18:34', 'facile', 'fr', 'Tarot', 'Carte', 'Atout', 'Garde', '', ''),
(24, '', 1, '25/02/2015 20:04', 'facile', 'fr', 'salade', 'verte', 'feuille', '', '', ''),
(25, '', 1, '25/02/2015 20:06', 'facile', 'en', 'mouse', 'small', 'animal', '', '', ''),
(26, '', 1, '25/02/2015 20:07', 'moyen', 'en', 'computer', 'calcul', 'machine', '', '', ''),
(27, '', 8, '26/02/2015 16:59', 'moyen', 'fr', 'bronzage', 'soleil', 'crème solaire', 'plage', 'brun', 'peau');

-- --------------------------------------------------------

--
-- Structure de la table `enregistrement`
--

CREATE TABLE IF NOT EXISTS `enregistrement` (
  `enregistrementID` int(11) NOT NULL AUTO_INCREMENT,
  `cheminEnregistrement` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idOracle` int(30) NOT NULL,
  `OracleLang` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tpsEnregistrement` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `carteID` int(11) NOT NULL,
  `nivcarte` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `validation` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`enregistrementID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Contenu de la table `enregistrement`
--

INSERT INTO `enregistrement` (`enregistrementID`, `cheminEnregistrement`, `idOracle`, `OracleLang`, `tpsEnregistrement`, `carteID`, `nivcarte`, `validation`) VALUES
(2, 'oracle358999.mp3', 5, 'fr', '24/02/2015 04:11', 9, 'difficile', 'valid'),
(5, 'oracle169999.mp3', 5, 'fr', '24/02/2015 04:21', 6, 'difficile', 'valid'),
(6, 'oracle1896011.mp3', 2, 'en', '24/02/2015 23:53', 3, 'difficile', '0'),
(7, 'oracle1297331.mp3', 2, 'en', '24/02/2015 23:55', 2, 'moyen', '0'),
(9, 'oracle6458471.mp3', 2, 'en', '24/02/2015 23:56', 1, 'facile', '0'),
(11, 'oracle6388681.mp3', 4, 'fr', '24/02/2015 23:59', 6, 'difficile', 'valid'),
(12, 'oracle4940501.mp3', 4, 'fr', '25/02/2015 00:06', 4, 'facile', 'valid'),
(13, 'oracle6172621.mp3', 4, 'fr', '25/02/2015 00:08', 7, 'difficile', 'valid'),
(14, 'oracle2767651.mp3', 2, 'fr', '25/02/2015 00:18', 14, 'moyen', '0'),
(15, 'oracle6830861.mp3', 2, 'fr', '25/02/2015 00:30', 17, 'facile', 'valid'),
(16, 'oracle6518981.mp3', 2, 'fr', '25/02/2015 00:32', 14, 'moyen', 'valid'),
(17, 'oracle5373921.mp3', 2, 'fr', '25/02/2015 00:45', 8, 'difficile', '0'),
(18, 'oracle8851001.mp3', 2, 'fr', '25/02/2015 00:49', 16, 'facile', '0'),
(19, 'oracle1607411.mp3', 2, 'fr', '25/02/2015 03:32', 18, 'facile', '0'),
(21, 'oracle2987821.mp3', 1, 'fr', '25/02/2015 04:06', 14, 'moyen', '0'),
(23, 'oracle1452881.mp3', 2, 'fr', '25/02/2015 16:38', 14, 'moyen', '0'),
(24, 'oracle6104961.mp3', 2, 'fr', '25/02/2015 16:39', 14, 'moyen', 'valid'),
(26, 'oracle4582221.mp3', 2, 'fr', '25/02/2015 16:45', 13, 'difficile', '0'),
(28, 'oracle5377541.mp3', 8, 'fr', '26/02/2015 17:00', 27, 'moyen', '0');

-- --------------------------------------------------------

--
-- Structure de la table `parties`
--

CREATE TABLE IF NOT EXISTS `parties` (
  `partieID` int(11) NOT NULL AUTO_INCREMENT,
  `enregistrementID` int(11) NOT NULL,
  `tpsDevin` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `idDevin` int(11) NOT NULL,
  `tpsdejeu` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reussie` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`partieID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=82 ;

--
-- Contenu de la table `parties`
--

INSERT INTO `parties` (`partieID`, `enregistrementID`, `tpsDevin`, `idDevin`, `tpsdejeu`, `reussie`) VALUES
(4, 2, '24/02/2015 05:29:42', 1, '', 'non'),
(5, 2, '24/02/2015 23:33:32', 1, '', 'non'),
(34, 17, '25/02/2015 04:12:02', 1, '', 'non'),
(36, 17, '25/02/2015 15:11:38', 1, '', 'oui'),
(42, 15, '25/02/2015 17:02:47', 1, '', 'oui'),
(56, 5, '25/02/2015 18:07:47', 2, '', 'en cours'),
(57, 13, '25/02/2015 18:09:20', 2, '', 'en cours'),
(58, 5, '25/02/2015 18:24:33', 7, '', 'non'),
(59, 17, '25/02/2015 18:26:47', 7, '', 'non'),
(60, 26, '25/02/2015 18:28:03', 7, '', 'en cours'),
(61, 2, '25/02/2015 18:28:17', 7, '', 'non'),
(62, 21, '25/02/2015 18:29:24', 7, '', 'oui'),
(63, 14, '25/02/2015 18:29:43', 7, '', 'en cours'),
(64, 24, '25/02/2015 18:29:53', 7, '', 'non'),
(65, 8, '25/02/2015 18:31:56', 7, '', 'en cours'),
(66, 13, '25/02/2015 18:32:00', 7, '', 'oui'),
(67, 12, '25/02/2015 18:32:43', 7, '', 'oui'),
(68, 16, '25/02/2015 18:33:01', 7, '', 'en cours'),
(69, 26, '25/02/2015 18:33:07', 7, '', 'en cours'),
(70, 14, '25/02/2015 18:33:09', 7, '', 'en cours'),
(71, 26, '25/02/2015 18:33:11', 7, '', 'en cours'),
(72, 8, '25/02/2015 18:33:13', 7, '', 'en cours'),
(73, 26, '25/02/2015 18:33:15', 7, '', 'en cours'),
(74, 19, '25/02/2015 18:33:16', 7, '', 'oui'),
(75, 18, '25/02/2015 18:34:56', 7, '', 'oui'),
(76, 5, '25/02/2015 18:42:00', 2, '', 'en cours'),
(77, 12, '25/02/2015 18:42:16', 2, '', 'non'),
(78, 13, '25/02/2015 19:57:55', 1, '', 'non'),
(79, 11, '26/02/2015 00:21:55', 2, '', 'oui'),
(80, 15, '26/02/2015 17:00:25', 8, '', 'en cours'),
(81, 16, '26/02/2015 17:01:22', 8, '', 'oui');

-- --------------------------------------------------------

--
-- Structure de la table `score`
--

CREATE TABLE IF NOT EXISTS `score` (
  `scoreID` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(100) NOT NULL,
  `scoreGlobal` int(100) NOT NULL,
  `scoreOracle` int(100) NOT NULL,
  `scoreDruide` int(100) NOT NULL,
  `scoreDevin` int(100) NOT NULL,
  PRIMARY KEY (`scoreID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `score`
--

INSERT INTO `score` (`scoreID`, `userid`, `scoreGlobal`, `scoreOracle`, `scoreDruide`, `scoreDevin`) VALUES
(1, 1, 120, 20, 80, 20),
(2, 2, 240, 80, 70, 90),
(3, 3, 0, 0, 0, 0),
(4, 4, 65, 25, 40, 0),
(5, 5, 30, 30, 0, 0),
(6, 6, 110, 0, 110, 0),
(7, 7, 80, 0, 30, 50),
(8, 8, 30, 10, 10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `useremail` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `userpass` varchar(32) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `userlang` varchar(32) NOT NULL,
  `niveau` varchar(9) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `valkey` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`userid`, `username`, `useremail`, `userpass`, `userlang`, `niveau`, `valkey`) VALUES
(1, 'Justine', 'reverdy.justine@gmail.com', 'b55050b2f605b7cf0d48346ff3d432d3', 'en', '', ''),
(2, 'CloCimp', 'cimpello.chloe@gmail.com', 'efb721822649b133e569e289fd32b9ae', 'fr', '', ''),
(3, 'kiki', 'kevin.miguet@gmx.fr', 'cc1e5fa69afb7097fd4791e6a6ced5bd', 'fr', '', ''),
(4, 'WhiskeyDusk', 'nac_s@free.fr', 'd9fd932e114c21309e61c08496bdc78e', 'fr', '', ''),
(5, 'Isabelle', 'medelice.isabelle@free.fr', '4757067ca131abf21c7dedea7efd0c80', 'fr', '', ''),
(6, 'Jeremy', 'jeremy.balland@gmail.fr', '6967cabefd763ac1a1a88e11159957db', 'en', '', ''),
(7, 'Benji', 'benji@toto.com', '4c73ddb52f07a7f3bc34242e47567995', 'fr', '', ''),
(8, 'demo', 'demo@gmail.com', 'fe01ce2a7fbac8fafaed7c982a04e229', 'fr', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
