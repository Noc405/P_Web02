-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 25 mars 2022 à 10:22
-- Version du serveur :  5.7.11
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_books`
--
CREATE DATABASE `db_books`;
USE `db_books`;
-- --------------------------------------------------------

--
-- Structure de la table `t_author`
--

CREATE TABLE `t_author` (
  `IDauthor` int(8) NOT NULL,
  `autName` varchar(20) NOT NULL,
  `autSurname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

CREATE TABLE `t_category` (
  `IDcategory` int(8) NOT NULL,
  `catName` varchar(50) NOT NULL COMMENT 'Nom des catégories'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_editor`
--

CREATE TABLE `t_editor` (
  `IDeditor` int(8) NOT NULL,
  `ediName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_livre`
--

CREATE TABLE `t_livre` ( /*A changer en "book"*/
  `IDlivre` int(11) NOT NULL,
  `livTitle` varchar(50) NOT NULL COMMENT 'Titre du livre',
  `livPage` int(5) NOT NULL COMMENT 'Nombre de page du livre',
  `livExtract` text NOT NULL COMMENT 'Extrait du livre',
  `livAbstract` varchar(255) NOT NULL COMMENT 'Résumé du livre',
  `livDate` date NOT NULL COMMENT 'Date de sortie du livre',
  `livNote` float NOT NULL COMMENT 'Note du livre',
  `fkAuthor` text NOT NULL, /*pk en type text quand une clé est forcément en int ?*/
  `fkCategory` text NOT NULL COMMENT 'Type du livre',/*pk en type text quand une clé est forcément en int ?*/
  `fkEditor` text NOT NULL, /*pk en type text quand une clé est forcément en int ?*/
  `fkUser` text NOT NULL /*pk en type text quand une clé est forcément en int ?*/
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `IDuser` int(11) NOT NULL,
  `useUsername` varchar(20) NOT NULL,
  `usePassword` varchar(30) NOT NULL,
  `useVote` int(5) NOT NULL COMMENT 'Nombre de note donnée à des ouvrages',
  `useDate` date NOT NULL COMMENT 'Date d''entrée dans le site'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_author`
--
ALTER TABLE `t_author`
  ADD PRIMARY KEY (`IDauthor`);

--
-- Index pour la table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`IDcategory`);

--
-- Index pour la table `t_editor`
--
ALTER TABLE `t_editor`
  ADD PRIMARY KEY (`IDeditor`);

--
-- Index pour la table `t_livre`
--
ALTER TABLE `t_livre`/*A changer en "book"*/
  ADD PRIMARY KEY (`IDlivre`),
  ADD KEY `fkAuthor` (`fkAuthor`(8)),
  ADD KEY `fkEditor` (`fkEditor`(8)),
  ADD KEY `fkUser` (`fkUser`(8)),
  ADD KEY `fkCategory` (`fkCategory`(8));

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`IDuser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_author`
--
ALTER TABLE `t_author`
  MODIFY `IDauthor` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `IDcategory` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_editor`
--
ALTER TABLE `t_editor`
  MODIFY `IDeditor` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_livre`
--
ALTER TABLE `t_livre` /*A changer en "book"*/
  MODIFY `IDlivre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `IDuser` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
