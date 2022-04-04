-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 04 avr. 2022 à 08:34
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

--
-- Déchargement des données de la table `t_category`
--

INSERT INTO `t_category` (`IDcategory`, `catName`) VALUES
(1, 'Art'),
(2, 'Bande dessinées'),
(3, 'Cuisine'),
(4, 'Droit'),
(5, 'Économie'),
(6, 'Histoire'),
(7, 'Littérature'),
(8, 'Jeunesse'),
(9, 'Humour'),
(10, 'Comédie romantique'),
(11, 'Romance'),
(12, 'Théatre'),
(13, 'Thrillers'),
(14, 'Suspense'),
(15, 'Fantastique'),
(16, 'Religion'),
(17, 'Guide'),
(18, 'Science fiction'),
(19, 'Fantaisie'),
(20, 'Éducatif'),
(21, 'Sport'),
(22, 'Science'),
(23, 'Dictionnaire'),
(24, 'Encyclopédie'),
(25, 'Poésie'),
(26, 'Manga'),
(27, 'Voyage'),
(28, 'Informatique'),
(29, 'Philosophe'),
(30, 'Géographie'),
(31, 'Bibliographie'),
(32, 'Roman épistolaire'),
(33, 'Aventure'),
(34, 'Horreur'),
(35, 'Conte'),
(36, 'Épopée'),
(37, 'Tragédie'),
(38, 'Drame'),
(39, 'Fable'),
(40, 'Western'),
(41, 'Pirate'),
(42, 'Fanfiction'),
(43, 'Mystère'),
(44, 'Roman'),
(45, 'Roman policier');

-- --------------------------------------------------------

--
-- Structure de la table `t_editor`
--

CREATE TABLE `t_editor` (
  `IDeditor` int(8) NOT NULL,
  `ediName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_editor`
--

INSERT INTO `t_editor` (`IDeditor`, `ediName`) VALUES
(1, ' Collins Crime Club'),
(2, 'Longmans'),
(3, 'Green & co.'),
(4, 'William Taylor'),
(5, ' Bernard Grasset'),
(6, 'Gallimard'),
(7, 'Lackington'),
(8, 'Hughes'),
(9, 'Harding'),
(10, 'Mavor et Jones');

-- --------------------------------------------------------

--
-- Structure de la table `t_livre`
--

CREATE TABLE `t_livre` (
  `IDlivre` int(11) NOT NULL,
  `livTitle` varchar(50) NOT NULL COMMENT 'Titre du livre',
  `livPage` int(5) NOT NULL COMMENT 'Nombre de page du livre',
  `livExtract` text NOT NULL COMMENT 'Extrait du livre',
  `livAbstract` varchar(255) NOT NULL COMMENT 'Résumé du livre',
  `livDate` varchar(30) NOT NULL COMMENT 'Date de sortie du livre',
  `livNote` float NOT NULL COMMENT 'Note du livre',
  `fkAuthor` int(8) NOT NULL,
  `fkCategory` int(8) NOT NULL COMMENT 'Type du livre',
  `fkEditor` int(8) NOT NULL,
  `fkUser` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `IDuser` int(11) NOT NULL,
  `useUsername` varchar(20) NOT NULL,
  `useMail` varchar(100) NOT NULL,
  `usePassword` varchar(255) NOT NULL,
  `useVote` int(5) NOT NULL COMMENT 'Nombre de note donnée à des ouvrages',
  `useDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date d''entrée dans le site'
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
ALTER TABLE `t_livre`
  ADD PRIMARY KEY (`IDlivre`),
  ADD KEY `fkAuthor` (`fkAuthor`),
  ADD KEY `fkEditor` (`fkEditor`),
  ADD KEY `fkUser` (`fkUser`),
  ADD KEY `fkCategory` (`fkCategory`);

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
  MODIFY `IDcategory` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `t_editor`
--
ALTER TABLE `t_editor`
  MODIFY `IDeditor` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `t_livre`
--
ALTER TABLE `t_livre`
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
