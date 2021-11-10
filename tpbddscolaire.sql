-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 10 nov. 2021 à 10:46
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tpbddscolaire`
--
CREATE DATABASE IF NOT EXISTS `tpbddscolaire` DEFAULT CHARACTER SET latin1 COLLATE latin1_general_cs;
USE `tpbddscolaire`;

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `IDMTR` int(11) NOT NULL,
  `LBLLMTR` varchar(50) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`IDMTR`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`IDMTR`, `LBLLMTR`) VALUES
(1, 'ALGORITHME'),
(2, 'WEB'),
(3, 'GAME DESIGN');

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

DROP TABLE IF EXISTS `note`;
CREATE TABLE IF NOT EXISTS `note` (
  `IDNT` int(11) NOT NULL AUTO_INCREMENT,
  `IDUSR` int(11) NOT NULL,
  `IDMTR` int(11) NOT NULL,
  `LBLLNT` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `VALEUR` int(11) NOT NULL,
  PRIMARY KEY (`IDNT`),
  KEY `FK_NCptUsr` (`IDUSR`),
  KEY `FK_NCptMtr` (`IDMTR`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`IDNT`, `IDUSR`, `IDMTR`, `LBLLNT`, `VALEUR`) VALUES
(1, 4, 1, 'TP', 12),
(2, 4, 2, 'TP', 10),
(3, 4, 1, 'Quizz', 6),
(4, 8, 2, 'TP', 15),
(5, 4, 1, 'Quizz', 11),
(6, 4, 2, 'TP', 16),
(7, 5, 2, 'TP', 19),
(8, 5, 3, 'TP', 15),
(9, 6, 3, 'TP', 20),
(10, 6, 3, 'TP', 19),
(11, 7, 2, 'TP', 12),
(12, 7, 1, 'TP', 14),
(13, 8, 2, 'TP', 16),
(14, 8, 3, 'TP', 17),
(15, 8, 2, 'TP', 11),
(16, 6, 1, 'TP', 15),
(17, 5, 2, 'TP', 15);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `IDTP` int(11) NOT NULL,
  `LBLLTP` varchar(50) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`IDTP`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`IDTP`, `LBLLTP`) VALUES
(1, 'Professeur.e'),
(2, 'Etudiant.e');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `IDUSR` int(11) NOT NULL AUTO_INCREMENT,
  `IDTP` int(11) NOT NULL,
  `IDGRP` int(11) NOT NULL,
  `NOM` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `PRENOM` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `LOGIN` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `PASSWORD` varchar(50) COLLATE latin1_general_cs NOT NULL,
  PRIMARY KEY (`IDUSR`),
  KEY `FK_UCptTp` (`IDTP`),
  KEY `FK_UCptGrp` (`IDGRP`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`IDUSR`, `IDTP`, `IDGRP`, `NOM`, `PRENOM`, `LOGIN`, `PASSWORD`) VALUES
(1, 1, 0, 'LOVELACE', 'Ada', 'alovelace', '12345678'),
(2, 1, 0, 'HEINEMAN', 'Rebecca', 'rheineman', '12345678'),
(3, 1, 0, 'DESSIE', 'Betelhem', 'bdessie', '12345678'),
(4, 2, 1, 'ELEVE', 'Un', 'ueleve', '12345678'),
(5, 2, 2, 'EVELE', 'Deux', 'devele', '12345678'),
(6, 2, 3, 'EVEL', 'Trois', 'tevel', '12345678'),
(7, 2, 4, 'VEL', 'Quatre', 'qvel', '12345678'),
(8, 2, 2, 'LEVE', 'Cinq', 'cleve', '12345678');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `FK_NCptMtr` FOREIGN KEY (`IDMTR`) REFERENCES `matiere` (`IDMTR`),
  ADD CONSTRAINT `FK_NCptUsr` FOREIGN KEY (`IDUSR`) REFERENCES `user` (`IDUSR`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_UCptGrp` FOREIGN KEY (`IDGRP`) REFERENCES `groupe` (`IDGRP`),
  ADD CONSTRAINT `FK_UCptTp` FOREIGN KEY (`IDTP`) REFERENCES `type` (`IDTP`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
