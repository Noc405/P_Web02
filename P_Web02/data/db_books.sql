-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 04 avr. 2022 à 15:07
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
DROP DATABASE IF EXISTS `db_books`;
CREATE DATABASE `db_books`;
USE `db_books`;
-- --------------------------------------------------------

--
-- Structure de la table `t_author`
--

CREATE TABLE `t_author` (
  `idAuthor` int(8) NOT NULL,
  `autName` varchar(20) NOT NULL,
  `autSurname` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_author`
--

INSERT INTO `t_author` (`idAuthor`, `autName`, `autSurname`) VALUES
(1, 'Christie', 'Agatha'),
(2, 'Louis Stevenson', 'Robert'),
(3, 'Dafoe', 'Daniel'),
(4, 'Proust', 'Marcel'),
(5, 'Shelley', 'Mary'),
(6, 'Shakespeare', 'William');

-- --------------------------------------------------------

--
-- Structure de la table `t_book`
--

CREATE TABLE `t_book` (
  `idBook` int(11) NOT NULL,
  `booTitle` varchar(50) NOT NULL COMMENT 'Titre du livre',
  `booPicture` text NOT NULL COMMENT 'Image du livre',
  `booPage` int(5) NOT NULL COMMENT 'Nombre de page du livre',
  `booExtract` text NOT NULL COMMENT 'Extrait du livre',
  `booAbstract` text NOT NULL COMMENT 'Résumé du livre',
  `booDate` varchar(30) NOT NULL COMMENT 'Date de sortie du livre',
  `fkAuthor` int(8) NOT NULL,
  `fkCategory` int(8) NOT NULL COMMENT 'Type du livre',
  `fkEditor` int(8) NOT NULL,
  `fkUser` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_book`
--

INSERT INTO `t_book` (`idBook`, `booTitle`, `booPicture`, `booPage`, `booExtract`, `booAbstract`, `booDate`, `fkAuthor`, `fkCategory`, `fkEditor`, `fkUser`) VALUES
(1, 'Le Crime de l\'Orient-Express', 'AgathaTrain.jpg', 256, 'AgathaTrain.pdf', 'Par le plus grand des hasards, Hercule Poirot se trouve dans la voiture de l\'Orient-Express – ce train de luxe qui traverse l\'Europe – où un crime féroce a été commis. Une des plus difficiles et des plus délicates enquêtes commence pour le fameux détective belge.', '01.01.1934', 1, 45, 1, 1),
(2, 'L\'Étrange Cas du docteur Jekyll et de M. Hyde', 'DrJekyll.jpg', 142, 'DrHide.pdf', 'Comment l\'excellent docteur Jekyll, éminent scientifique et membre de la meilleure société londonienne, a-t-il pu se lier avec M. Hyde, un homme violent et sans éducation ? Ses amis s\'inquiètent : n\'a-t-on pas vu le sinistre M. Hyde se glisser, aux petites heures du matin, chez le docteur, en utilisant sa propre clef ? Il ne fait aucun doute que le docteur Jekyll cache un effroyable secret...', '09.01.1886', 2, 15, 3, 1),
(3, 'Robinson Crusoé', 'RobinsonCrusoe.jpg', 588, 'Defoe-Robinson.pdf', 'Quand il embarque à dix-neuf ans, contre l\'avis de son père, Robinson ignore encore l\'incroyable destin qui l\'attend. Seul rescapé d\'un naufrage, perdu sur une île déserte, il va devoir apprendre à survivre au milieu d\'une nature hostile... Inspiré d\'une histoire vraie, un chef-d\'oeuvre du roman d\'aventures en version abrégée.', '25.04.1719', 3, 33, 4, 1),
(4, 'Du côté de chez Swann', 'LaRechercheDuTempsPerdu_1.jpg', 720, 'LaRechercheDuTempsPerdu_1.pdf', 'Du côté de chez Swann relate les jours heureux qu\'il a passés à Combray, avec sa famille et leurs amis, alors qu\'il était enfant. Il est amoureux de Gilberte la fille de Monsieur Swann. Le livre est divisé en trois parties. Dans \"Combray\", le narrateur parle de sa relation avec sa mère. Il réclame toujours sa présence avant de se coucher. Il évoque aussi ses premières lectures (George Sand notamment). On voit que le narrateur est fasciné par la littérature. Il étudie aussi beaucoup les voisins, les Guermantes.', '14.11.1913', 4, 44, 6, 1),
(5, 'À l’ombre des jeunes filles en fleurs', 'LaRechercheDuTempsPerdu_2.jpg', 647, 'LaRechercheDuTempsPerdu_2.pdf', 'Tout d\'un coup, dans le petit chemin creux, je m\'arrêtai touché au coeur par un doux souvenir d\'enfance : je venais de reconnaître, aux feuilles découpées et brillantes qui s\'avançaient sur le seuil, un buisson d\'aubépines défleuries, hélas, depuis la fin du printemps. Autour de moi flottait une atmosphère d\'anciens mois de Marie, d\'après-midi du dimanche, de croyances, d\'erreurs oubliées. J\'aurais voulu la saisir. Je m\'arrêtai une seconde et Andrée, avec une divination charmante, me laissa causer un instant avec les feuilles de l\'arbuste. Je leur demandai des nouvelles des fleurs, ces fleurs de l\'aubépine pareilles à de gaies jeunes filles étourdies, coquettes et pieuses. \"Ces demoiselles sont parties depuis déjà longtemps\", me disaient les feuilles.', '30.11.1918', 4, 44, 6, 1),
(6, 'Le Coté de Guermantes', 'LaRechercheDuTempsPerdu_3.jpg', 1088, 'LaRechercheDuTempsPerdu_3.pdf', 'Sur la route qui mène de l\'enfance à la vieillesse, des joies de Combray à la perte des illusions du Temps retrouvé, Le Côté de Guermantes signe la fin de l\'adolescence. On y observe l\'aristocratie parisienne à travers les yeux d\'un jeune bourgeois. Deux amours impossibles et douloureuses s\'y nouent : la passion du Narrateur pour Oriane de Guermantes, et celle de son ami Saint-Loup pour l\'actrice Rachel. Le salon mondain est un microcosme qui révèle ce qui intéresse en profondeur le romancier : la lutte de l\'intelligence contre la bêtise, la force de la confrontation des points de vue, la richesse de la fluidité des identités.Le Côté de Guermantes est le témoignage mélancolique d\'une époque en transition, qui court à la guerre de 1914. Le spectre de l\'affaire Dreyfus plane sur tout le roman et en divise les acteurs. La lucidité et le pessimiste de Proust s\'y expriment avec vigueur. Dénonçant le règne des apparences, le romancier met son extraordinaire talent d\'observateur au service d\'une satire sociale. Il fait de l\'ironie une arme de combat, et de la méchanceté un art. Le Côté de Guermantes est le roman le plus drôle de toute la Recherche. Il est aussi le plus sombre : s\'y jouent la maladie de la grand-mère du Narrateur, et celle de Swann. Mais par-dessus tout, c\'est l\'émerveillement devant le mouvement de la vie qui emporte le Narrateur et son lecteur.À la recherche du temps perdu est une exceptionnelle comédie sociale. Le Côté de Guermantes en est la preuve éclatante.', 'Août 1920-21', 4, 44, 6, 1),
(7, 'Sodome et Gomorrhe', 'LaRechercheDuTempsPerdu_4.jpg', 382, 'LaRechercheDuTempsPerdu_4.pdf', 'Nous entendions la voix de M. de Charlus tout près de nous : “Comment ? vous vous appelez Victurnien, comme dans Le Cabinet des Antiques”, disait le Baron pour prolonger la conversation avec les deux jeunes gens. “De Balzac ; oui”, répondit l\'aîné des Surgis qui n\'avait jamais lu une ligne du romancier, mais à qui son professeur avait signalé, il y avait quelques jours, la similitude de son prénom avec celui de d\'Esgrignon. Mme de Surgis était ravie de voir son fils briller et M. de Charlus extasié devant tant de science.', '1921-22', 4, 44, 6, 1),
(8, 'La Prisonnière', 'LaRechercheDuTempsPerdu_5.jpg', 496, 'LaRechercheDuTempsPerdu_5.pdf', 'Je pouvais mettre ma main dans sa main, sur son épaule, sur sa joue, Albertine continuait de dormir. Je pouvais prendre sa tête, la renverser, la poser contre mes lèvres, entourer mon cou de ses bras, elle continuait à dormir comme une montre qui ne s\'arrête pas, comme une bête qui continue de vivre quelque position qu\'on lui donne, comme une plante grimpante, un volubilis qui continue de pousser ses branches quelque appui qu\'on lui donne. Seul son souffle était modifié par chacun de mes attouchements, comme si elle eût été un instrument dont j\'eusse joué et à qui je faisais exécuter des modulations en tirant de l\'une, puis de l\'autre de ses cordes, des notes différentes.', '1923', 4, 44, 6, 1),
(9, 'Albertine disparue', 'LaRechercheDuTempsPerdu_6.jpg', 366, 'LaRechercheDuTempsPerdu_6.pdf', 'Mademoiselle Albertine est partie !\" Comme la souffrance va plus loin en psychologie que la psychologie ! Il y a un instant, en train de m\'analyser, j\'avais cru que cette séparation sans s\'être revus était justement ce que je désirais, et comparant la médiocrité des plaisirs que me donnait Albertine à la richesse des désirs qu\'elle me privait de réaliser, je m\'étais trouvé subtil, j\'avais conclu que je ne voulais plus la voir, que je ne l\'aimais plus. Mais ces mots : \"Mademoiselle Albertine est partie\" venaient de produire dans mon coeur une souffrance telle que je sentais que je ne pourrais pas y résister plus longtemps. Ainsi ce que j\'avais cru n\'être rien pour moi, c\'était tout simplement toute ma vie.', '1925', 4, 44, 6, 1),
(10, 'Le Temps retrouvé', 'LaRechercheDuTempsPerdu_7.jpg', 1088, 'LaRechercheDuTempsPerdu_7.pdf', 'Marcel Proust est sur son lit de mort. En regardant des photos, il se souvient de son enfance, de sa jeunesse, de ses conquêtes et de la façon dont lGuerre a mis fin à une couche de la société. Ses souvenirs vont et viennent dans le temps. Marcel, à différents âges, interagit avec Odette, avec la belle Gilberte et son mari condamné, avec le baron de Charlus, qui recherche le plaisir, avec Albertine, l\'amante de Marcel, et avec d\'autres personnes', '1927', 4, 44, 6, 1),
(11, 'Frankenstein', 'Frankenstein.jpg', 384, 'Frankenstein.pdf', 'Le livre raconte l\'histoire de Victor Frankenstein, un médecin qui est fasciné par la vie et par la Création. Il décide de créer à son tour une créature vivante et de l\'animer, afin d\'essayer de comprendre comment fonctionne la vie et comment elle a été créée.', '1818', 5, 18, 7, 1),
(12, 'Othello', 'Othello.jpg', 224, 'Othello.pdf', 'Doucement. Que je vous dise encore un mot ou deux avant votre départ. J\'ai rendu à l\'État quelques services, cela se sait : n\'en parlons plus. Et quand vous rendrez compte dans vos lettres de ces événements malheureux, s\'il vous plaît dépeignez-moi tel que je suis : sans atténuer quoi que ce soit, ni l\'aggraver par malveillance. De qui, en ces instants, devrez-vous parler ? D\'un qui n\'aima que trop, bien que sans sagesse, d\'un être peu enclin à la jalousie, qui, pourtant, manoeuvré, perdit tout de son jugement, jetant, comme le pauvre Indien, à tout venant, la perle qui valait plus que toute sa tribu. D\'un homme dont les yeux accablés par la souffrance, bien que peu habitués à verser des larmes, le font avec la même force, précipitée, que l\'arbre d\'Arabie répand la myrrhe qui, elle, est secourable. Mettez cela par écrit.', '1623', 6, 12, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

CREATE TABLE `t_category` (
  `idCategory` int(8) NOT NULL,
  `catName` varchar(50) NOT NULL COMMENT 'Nom des catégories'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `catName`) VALUES
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
  `idEditor` int(8) NOT NULL,
  `ediName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_editor`
--

INSERT INTO `t_editor` (`idEditor`, `ediName`) VALUES
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
-- Structure de la table `t_note`
--

CREATE TABLE `t_note` (
  `IDmark` int(11) NOT NULL,
  `notMark` int(11) NOT NULL,
  `notCommentary` text NOT NULL,
  `fkBook` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int(11) NOT NULL,
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
  ADD PRIMARY KEY (`idAuthor`);

--
-- Index pour la table `t_book`
--
ALTER TABLE `t_book`
  ADD PRIMARY KEY (`idBook`),
  ADD KEY `fkAuthor` (`fkAuthor`),
  ADD KEY `fkEditor` (`fkEditor`),
  ADD KEY `fkUser` (`fkUser`),
  ADD KEY `fkCategory` (`fkCategory`);

--
-- Index pour la table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Index pour la table `t_editor`
--
ALTER TABLE `t_editor`
  ADD PRIMARY KEY (`idEditor`);

--
-- Index pour la table `t_note`
--
ALTER TABLE `t_note`
  ADD PRIMARY KEY (`IDmark`),
  ADD KEY `fkBook` (`fkBook`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_author`
--
ALTER TABLE `t_author`
  MODIFY `idAuthor` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `t_book`
--
ALTER TABLE `t_book`
  MODIFY `idBook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `t_editor`
--
ALTER TABLE `t_editor`
  MODIFY `idEditor` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `t_note`
--
ALTER TABLE `t_note`
  MODIFY `IDmark` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_note`
--
ALTER TABLE `t_note`
  ADD CONSTRAINT `fkBook` FOREIGN KEY (`fkBook`) REFERENCES `t_book` (`idBook`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
