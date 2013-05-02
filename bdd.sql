-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 26 Avril 2013 à 16:17
-- Version du serveur: 5.5.8
-- Version de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `bdd`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) CHARACTER SET utf8 NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8 NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8 NOT NULL,
  `sexe` varchar(2) CHARACTER SET utf8 NOT NULL,
  `jour` int(20) NOT NULL,
  `mois` varchar(20) CHARACTER SET utf8 NOT NULL,
  `annee` int(20) NOT NULL,
  `situation` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `adresse` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `adresse2` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ville` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `CP` int(10) DEFAULT NULL,
  `pays` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `login`, `mdp`, `nom`, `prenom`, `mail`, `sexe`, `jour`, `mois`, `annee`, `situation`, `adresse`, `adresse2`, `ville`, `CP`, `pays`) VALUES
(8, 'JM', '51f8b1fa9b424745378826727452997ee2a7c3d7', 'Lagniez', 'Jean Marc', 'jean.marc@coucou.fr', 'H', 8, '1', 1992, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'stephen', '0ffaaa6d8ba2a8826cfc2864e33c6375d5c916cd', 'Baroan', 'Stephen', 'stephen.baroan@gmail.com', 'F', 31, '5', 1990, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Mouss', '137591da2ecd87f03256981c7b539487e5f2b4ef', 'D', 'M', 'mouss.diouf@gmail.com', 'H', 0, '', 0, '', '', '', '', 0, 'France'),
(17, 'Viktor', '86faeb3e05561b856666236e198c27e698275e82', 'Lesnyak', 'Viktor', 'viktor.lesnyak@hotmail.com', 'H', 22, '9', 1990, 'CÃ©libataire', '914, Chemin de Moulares', NULL, 'Montpellier', 34070, 'France'),
(18, 'Arihy', 'feb60ea4e50538d99d4506c10e52feffb040f78d', 'Mohammed El-Had', 'Mel', 'dsd@hsd.jed', 'F', 30, '11', 1988, 'En couple', NULL, NULL, NULL, NULL, 'France');
