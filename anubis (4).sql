-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 09 mai 2021 à 15:25
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `anubis`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E6667B3B43D` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `user_id`, `titre`, `description`, `image`, `created_at`) VALUES
(2, 71, 'esfsdf', 'fdvfdvdvdrf', 'f68e9f37ca0063fe5e30dd45988160c9.jpeg', '2021-04-01 07:04:59'),
(3, 71, 'jihene', 'mjmlkm', 'dded19cd3f9f6652961c12f3232c4003.jpeg', '2021-04-01 09:08:29'),
(10, 71, 'me', 'me', 'Profile30305.jpg', '2021-04-29 00:00:00'),
(17, 71, 'we', 'we', 'Profile66902.jpg', '2021-04-29 00:00:00'),
(18, 71, 'test', 'test', 'Profile98255.jpg', '2021-04-29 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `article_like`
--

DROP TABLE IF EXISTS `article_like`;
CREATE TABLE IF NOT EXISTS `article_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1C21C7B27294869C` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `idcomment` int(11) NOT NULL AUTO_INCREMENT,
  `idArticle` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `commentaire` varchar(255) NOT NULL,
  PRIMARY KEY (`idcomment`),
  KEY `idArticle` (`idArticle`),
  KEY `iduser` (`iduser`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `idArticle` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67F068BC12836594` (`idArticle`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `name`, `email`, `website`, `message`, `created_at`, `idArticle`) VALUES
(1, 'melek', 'jihne.sliti@yahoo.fr', 'https://mail.google.com/mail/u/0/#inbox', 'fdds\r\n', '2021-04-01 09:05:06', 2),
(2, 'test', 'jihne.sliti@yahoo.fr', 'https://mail.google.com/mail/u/0/#inbox', 'rhgsxgsd', '2021-04-01 09:09:23', 3);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210303114159', '2021-03-03 11:42:03', 78),
('DoctrineMigrations\\Version20210303120457', '2021-03-03 12:06:59', 66),
('DoctrineMigrations\\Version20210303121910', '2021-03-03 12:19:59', 588),
('DoctrineMigrations\\Version20210303140901', '2021-03-03 14:09:21', 83),
('DoctrineMigrations\\Version20210303141124', '2021-03-03 14:11:30', 314),
('DoctrineMigrations\\Version20210306113520', '2021-03-06 11:36:08', 1106),
('DoctrineMigrations\\Version20210306113555', '2021-03-06 11:37:19', 44),
('DoctrineMigrations\\Version20210306113917', '2021-03-06 11:39:23', 53),
('DoctrineMigrations\\Version20210310162130', '2021-03-10 16:21:41', 184),
('DoctrineMigrations\\Version20210310164139', '2021-03-10 16:42:01', 162),
('DoctrineMigrations\\Version20210318004006', '2021-03-18 00:40:22', 94),
('DoctrineMigrations\\Version20210318004418', '2021-03-18 00:52:18', 166),
('DoctrineMigrations\\Version20210318010206', '2021-03-18 01:02:15', 1266),
('DoctrineMigrations\\Version20210318010446', '2021-03-18 01:04:53', 45),
('DoctrineMigrations\\Version20210318010706', '2021-03-18 01:07:12', 110),
('DoctrineMigrations\\Version20210318174257', '2021-03-18 17:43:22', 80),
('DoctrineMigrations\\Version20210318194357', '2021-03-18 19:44:09', 65),
('DoctrineMigrations\\Version20210318195232', '2021-03-18 19:52:42', 52),
('DoctrineMigrations\\Version20210318210410', '2021-03-18 21:04:20', 42),
('DoctrineMigrations\\Version20210318210526', '2021-03-18 21:05:33', 90),
('DoctrineMigrations\\Version20210320170324', '2021-03-20 17:03:40', 105),
('DoctrineMigrations\\Version20210321132123', '2021-03-21 13:21:40', 314),
('DoctrineMigrations\\Version20210323003822', '2021-03-23 00:38:38', 211),
('DoctrineMigrations\\Version20210326114239', '2021-03-26 11:42:53', 242),
('DoctrineMigrations\\Version20210326114442', '2021-03-26 11:45:01', 1035),
('DoctrineMigrations\\Version20210328111409', '2021-03-28 11:14:39', 159),
('DoctrineMigrations\\Version20210329102510', '2021-03-29 10:25:35', 61),
('DoctrineMigrations\\Version20210329102657', '2021-03-29 10:27:03', 47),
('DoctrineMigrations\\Version20210330070748', '2021-03-30 07:07:55', 77),
('DoctrineMigrations\\Version20210330070956', '2021-03-30 07:10:03', 64),
('DoctrineMigrations\\Version20210330071625', '2021-03-30 07:16:31', 195),
('DoctrineMigrations\\Version20210330073931', '2021-03-30 07:39:36', 40),
('DoctrineMigrations\\Version20210330091621', '2021-03-30 09:16:38', 954),
('DoctrineMigrations\\Version20210330091822', '2021-03-30 09:18:32', 44),
('DoctrineMigrations\\Version20210330092036', '2021-03-30 09:20:41', 59),
('DoctrineMigrations\\Version20210330092312', '2021-03-30 09:23:20', 240),
('DoctrineMigrations\\Version20210401014055', '2021-04-01 01:41:33', 349),
('DoctrineMigrations\\Version20210401043907', '2021-04-01 04:39:29', 1028),
('DoctrineMigrations\\Version20210423081706', '2021-04-23 08:17:23', 1727),
('DoctrineMigrations\\Version20210423092529', '2021-04-23 09:25:40', 35),
('DoctrineMigrations\\Version20210424033252', '2021-04-24 03:33:05', 197);

-- --------------------------------------------------------

--
-- Structure de la table `entretien`
--

DROP TABLE IF EXISTS `entretien`;
CREATE TABLE IF NOT EXISTS `entretien` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offre_id` int(11) NOT NULL,
  `date_entretien` date DEFAULT NULL,
  `type_entretien` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2B58D6DA4CC8505A` (`offre_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entretien`
--

INSERT INTO `entretien` (`id`, `offre_id`, `date_entretien`, `type_entretien`, `adresse`) VALUES
(3, 6, '2024-01-03', 'jih', 'tunis'),
(4, 5, '2021-06-12', 'jih', 'tunis'),
(5, 6, '2022-06-11', 'Distanciel', 'bizerte'),
(6, 5, '2021-03-04', 'Distanciel', 'tunis');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `start` datetime DEFAULT NULL,
  `lieu` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `end` datetime DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` double NOT NULL,
  `lon` double NOT NULL,
  `capacite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`id`, `start`, `lieu`, `image`, `title`, `end`, `description`, `lat`, `lon`, `capacite`) VALUES
(23, '2021-03-21 02:00:00', 'Sousse', 'g-605685df9b7fe.webp', 'Accenture, Avanade, and Microsoft present Envision', '2021-03-21 04:00:00', 'At Envision, business leaders will hear diverse perspectives from a worldwide audience and gain fresh insights as executives across industries come together to discuss the challenges and opportunities in this era of digital disruption.', 35.82539, 10.63699, 8),
(24, '2021-03-20 05:00:00', 'sfax', 'RWyWGK-605685105c7e1.webp', 'Game Stack Live', '2021-03-23 05:00:00', 'A digital event focused on all things game development. Learn how to grow and build your games with sessions from Microsoft and Industry experts.', 34.748, 10.766, 1),
(25, '2021-03-02 03:00:00', 'Nabeul', 'RE4AuTt-6056856b795d5.jpeg', 'Microsoft Business Applications Summit', '2021-03-09 02:00:00', 'The Microsoft Business Applications Summit brings Microsoft customers and partners together to learn how end-to-end Dynamics 365 and Power Platform can create solutions to drive business and land new cloud customers.', 36.455, 10.715, 2),
(31, '2021-03-21 02:00:00', 'Sousse', 'g-605685df9b7fe.webp', 'Accenture, Avanade, and Microsoft present Envision', '2021-03-21 04:00:00', 'At Envision, business leaders will hear diverse perspectives from a worldwide audience and gain fresh insights as executives across industries come together to discuss the challenges and opportunities in this era of digital disruption.', 35.82539, 10.63699, 5),
(32, '2021-03-20 05:00:00', 'sfax', 'RWyWGK-605685105c7e1.webp', 'Game Stack Live', '2021-03-23 05:00:00', 'A digital event focused on all things game development. Learn how to grow and build your games with sessions from Microsoft and Industry experts.', 34.748, 10.766, 1),
(33, '2021-03-02 03:00:00', 'Nabeul', 'RE4AuTt-6056856b795d5.jpeg', 'Microsoft Business Applications Summit', '2021-03-09 02:00:00', 'The Microsoft Business Applications Summit brings Microsoft customers and partners together to learn how end-to-end Dynamics 365 and Power Platform can create solutions to drive business and land new cloud customers.', 36.455, 10.715, 2),
(39, '2021-04-12 00:00:00', 'pp', 'Profile141980.jpg', 'o', '2021-04-06 00:00:00', 'tttttttttttt', 88.5, 88.2, 100),
(48, '2021-04-09 04:04:00', '2', 'dded19cd3f9f6652961c12f3232c4003-6089f3a2b5eb1.jpeg', 'testsymweb', '2021-05-09 04:00:00', 'test', 78.2, 88, 5),
(49, '2021-04-01 00:00:00', 'tttttt', 'Profile229776.jpg', 'ttt', '2021-04-10 00:00:00', 'hhhhh', 88, 88, 5);

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_404021BF71F7E88B` (`event_id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `nom`, `type`, `duree`, `prix`, `event_id`) VALUES
(24, 'Formation Office pour le web', 'Formation qualifiante', 4, 20, 23),
(25, 'Formation Office 2013', 'Formation qualifiante', 5, 40, 25),
(26, 'Aide-mémoires', 'Formation continu', 6, 30, 24),
(40, 'Formation Office pour le web', 'Formation qualifiante', 44, 20, 23),
(41, 'Formation Office 2013', 'Formation qualifiante', 5, 40, 25),
(43, 'formation2', 'Formation qualifiante', 5, 5, 23),
(51, 'yy', 'yy', 5, 10, 24),
(53, 'jjj', 'iiiii', 8, 5, 25);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postes_vacants` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_contrat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remuneration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langues` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_expiration` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`id`, `titre`, `entreprise`, `adresse`, `postes_vacants`, `type_contrat`, `experience`, `remuneration`, `langues`, `description`, `date_expiration`) VALUES
(5, 'yut', 'yujytu', 'ytjyj', 'yjyj', 'yyjgj', 'yyjgt', 'yjhy', 'hj', 'gjygj', '2016-01-01'),
(6, 'hh', 'ttt', 'ttt', 'tt', 'tt', 'ttt', 'tt', 'tt', 'ttt', '2016-01-01');

-- --------------------------------------------------------

--
-- Structure de la table `post_likes`
--

DROP TABLE IF EXISTS `post_likes`;
CREATE TABLE IF NOT EXISTS `post_likes` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`user_id`),
  KEY `IDX_DED1C2924B89032C` (`post_id`),
  KEY `IDX_DED1C29267B3B43D` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `post_likes`
--

INSERT INTO `post_likes` (`post_id`, `user_id`) VALUES
(2, 6);

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `enonce` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `choix1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choix2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `choix3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reponse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B6F7494E853CD175` (`quiz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `quiz_id`, `enonce`, `choix1`, `choix2`, `choix3`, `reponse`) VALUES
(1, 1, 'aaaaaaaaaaaaa', 'aaa', 'ffffff', 'cccccccc', 'aaa'),
(4, 2, 'uu', 'p', 'm', 'l', 'p'),
(5, 2, 'uu', 'k', 'm', 'l', 'k'),
(8, 1, 'test', 't1', 't2', 't3', 't3');

-- --------------------------------------------------------

--
-- Structure de la table `quiz`
--

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duree` double NOT NULL,
  `nbquestion` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `quiz`
--

INSERT INTO `quiz` (`id`, `theme`, `duree`, `nbquestion`) VALUES
(1, 'math', 20, 20),
(2, 'anglais', 55, 1),
(4, 'jihene', 5, 5),
(5, 'aaaa', 6, 8),
(9, 'test', 5, 5);

-- --------------------------------------------------------

--
-- Structure de la table `reclamation`
--

DROP TABLE IF EXISTS `reclamation`;
CREATE TABLE IF NOT EXISTS `reclamation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sujet` varchar(2555) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CE606404A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reclamation`
--

INSERT INTO `reclamation` (`id`, `user_id`, `sujet`, `commentaire`, `type`, `created_at`, `etat`) VALUES
(1, 4, 'uuuu', 'lllll', 'refus', '2021-04-22', 'accepte'),
(5, 71, 'aaaaaaaaaaaa', 'ffffffffffffff', 'mot de passe', 'Wed Apr 28 23:55:24 CEST 2021', 'accepte'),
(6, 71, 'kkk', 'jjjjjj', 'mot de passe', 'Thu Apr 29 00:02:37 CEST 2021', 'accepte'),
(7, 71, 'ttt', 'ffverfref', 'mot de passe', 'Thu Apr 29 00:06:36 CEST 2021', 'refus'),
(8, 4, '<p>aaaaaaaaaaa</p>', '<p>ooooo</p>', 'ooo', '12/05/2010', 'refus'),
(9, 71, 'test', 'tetstst', 'mot de passe', 'Thu Apr 29 11:17:41 CEST 2021', 'accepte');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iduser_id` int(11) NOT NULL,
  `idevent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C84955786A81FB` (`iduser_id`),
  KEY `IDX_42C84955DB22A086` (`idevent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` varchar(2555) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activation_token` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_token` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `cin`, `username`, `activation_token`, `reset_token`) VALUES
(4, 'j.j@esprit.tn', '[\"Recruteur\"]', '$argon2id$v=19$m=65536,t=4,p=1$LktESndEQVJacjVwMFBWeA$BKF5slsgo9i/+sTFhHGd6X+/6e7faTrN/xAdRQSL46g', 111114, 'jihene7', 'eda6175ac6691ee218305ce14f20e53b', NULL),
(6, 'seifeddine.fathallah@esprit.tn', '[\"Recruteur\"]', '$argon2id$v=19$m=65536,t=4,p=1$am8zLlRyb0lESUVBTTFZOA$3GYajqnLdyvfMrFhSJ/2AYfk7H373EwQGiezxAt+M+g', 111111, 'telecom', 'd76f48c8bcfa059eda8f18ccbb385099', NULL),
(7, 'sk@esprit.tn', '[\"Candidat\"]', '$argon2id$v=19$m=65536,t=4,p=1$eXVrUDR3d2dmaEN5bW1FOA$JOsACtE45picI94LNboXLayB48kb5dHHEcpyk0eXYtM', 11404297, 'sk', 'eb40589f07fe3ffc7f6aa6065e631687', NULL),
(8, 'aaaa@esprit.tn', 'Admin', '$argon2id$v=19$m=65536,t=4,p=1$VElKNng5Z0lqcmYub3dEeA$+nfgjjXAQrI5Zx4VLsWXyqMVMVFm5A1p40kumFIT7Eg', 123456789, 'aa', '076a468635d075ec255c168d10395c4e', NULL),
(10, 'seifa@esprit.tn', '\'[\'candidat\']\'', 'd9ba767121c62de709344c0c3b4eb80bc3d6bf99d47c9c13f7fc8684d3c021e5', 1234567, 'seiff', '7bdaf20f0e396e6f3446065296e16d65', NULL),
(20, 'skander.farhatsliti@esprit.tn', '\'[\'candidat\']\'', '750777fecf364dd6d44c506439b8166ff9b0205c53869f47f0a1ff0331840ff9', 1123789, 'skoo', 'c25cf5fc8d4df1b009d8a0c99f5bfc55', NULL),
(71, 'jihene.nour@esprit.tn', '[\"Admin\"]', '8bb0cf6eb9b17d0f7d22b456f121257dc1254e1f01665370476383ea776df414', 123456, 'jihene', NULL, NULL),
(72, 'azerty.azerty@esprit.tn', '[\"Candidat\"]', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 123456, 'azerty', NULL, NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `FK_23A0E6667B3B43D` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `article_like`
--
ALTER TABLE `article_like`
  ADD CONSTRAINT `FK_1C21C7B27294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`);

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `FK_67F068BC12836594` FOREIGN KEY (`idArticle`) REFERENCES `article` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `entretien`
--
ALTER TABLE `entretien`
  ADD CONSTRAINT `FK_2B58D6DA4CC8505A` FOREIGN KEY (`offre_id`) REFERENCES `offre` (`id`);

--
-- Contraintes pour la table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `FK_404021BF71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Contraintes pour la table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `FK_DED1C2924B89032C` FOREIGN KEY (`post_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `FK_DED1C29267B3B43D` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_B6F7494E853CD175` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`);

--
-- Contraintes pour la table `reclamation`
--
ALTER TABLE `reclamation`
  ADD CONSTRAINT `FK_CE606404A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C84955786A81FB` FOREIGN KEY (`iduser_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_42C84955DB22A086` FOREIGN KEY (`idevent_id`) REFERENCES `event` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
