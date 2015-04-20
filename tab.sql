-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 26 Février 2015 à 19:02
-- Version du serveur: 5.5.40
-- Version de PHP: 5.4.36-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
