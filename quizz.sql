-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 13 fév. 2025 à 17:37
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quizz`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Histoire'),
(2, 'Foot'),
(3, 'Géographie'),
(4, 'jeux-video'),
(5, 'Musique'),
(6, 'Manga');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categorie_id` int DEFAULT NULL,
  `question_text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categorie_id` (`categorie_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `categorie_id`, `question_text`) VALUES
(1, 1, 'En quelle année a eu lieu la revolution francaise'),
(2, 1, 'Quelle année pour la 1er guerre mondiale'),
(3, 1, 'Quelle année pour la 2nd guerre mondiale'),
(4, 1, 'En quelle année est mort Staline?'),
(5, 2, 'Quelle année l OM on t il gagné la ligue des champions ?'),
(6, 2, 'De quelle pays vient Mpappe ?'),
(7, 2, 'Ou joue Ronaldo actuellement ?'),
(8, 3, 'Quelle est la capitale de la France ?'),
(9, 3, 'Quelle est la capitale de l Espagne ?'),
(10, 3, 'Quelle est la capitale du Maroc ?'),
(11, 4, 'Quand sort GTA 6 ?'),
(12, 4, 'Quelle est l arme préféré de fox ?'),
(13, 4, 'Qui est la femme de Mario ?'),
(14, 5, 'Qui est le 1er rappeur Francais ?'),
(15, 5, 'Qui a sortit \"la vie en rose ?'),
(16, 5, 'De quel nationalité est le groupe \"Daft Punk\" ?'),
(17, 6, 'Qui est le père de \"Naruto\" ?');

-- --------------------------------------------------------

--
-- Structure de la table `reponses`
--

DROP TABLE IF EXISTS `reponses`;
CREATE TABLE IF NOT EXISTS `reponses` (
  `id` int NOT NULL AUTO_INCREMENT,
  `question_id` int DEFAULT NULL,
  `reponse_text` text NOT NULL,
  `est_correct` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `question_id` (`question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reponses`
--

INSERT INTO `reponses` (`id`, `question_id`, `reponse_text`, `est_correct`) VALUES
(1, 1, '1789', 1),
(2, 1, '2025', 0),
(3, 1, '1826', 0),
(4, 1, '1689', 0),
(5, 2, '1959', 0),
(6, 2, '1914', 1),
(7, 2, '1939', 0),
(8, 2, '1814', 0),
(9, 3, '1958', 0),
(10, 3, '1939', 1),
(11, 3, '1901', 0),
(12, 3, '1914', 0),
(13, 4, '1759', 0),
(14, 4, '1953', 1),
(15, 4, '1960', 0),
(16, 4, '1952', 0),
(17, 5, '1993', 1),
(18, 5, '1913', 0),
(19, 5, '2002', 0),
(20, 5, '1903', 0),
(21, 6, 'Espagne', 0),
(22, 6, 'France', 1),
(23, 6, 'Argentine', 0),
(24, 6, 'Suisse', 0),
(25, 7, 'PSG', 0),
(26, 7, 'Al nassr FC', 1),
(27, 7, 'Juventus', 0),
(28, 7, 'Madrid', 0),
(29, 8, 'Madrid', 0),
(30, 8, 'Amsterdame', 0),
(31, 8, 'Paris', 1),
(32, 8, 'Marseille', 0),
(33, 9, 'Barcelone', 0),
(34, 9, 'Berlin', 0),
(35, 9, 'Paris', 0),
(36, 9, 'Madrid', 1),
(37, 10, 'Rabbat', 1),
(38, 10, 'Marrackech', 0),
(39, 10, 'Casablanca', 0),
(40, 10, 'marseille', 0),
(41, 11, 'automne', 1),
(42, 11, 'hiver', 0),
(43, 11, 'été', 0),
(44, 11, 'il est deja sortit', 0),
(45, 12, 'le couteau', 0),
(46, 12, 'la brosse', 0),
(47, 12, 'le pistolet lazer', 1),
(48, 12, 'une épé', 0),
(49, 13, 'mini', 0),
(50, 13, 'Alexis', 0),
(51, 13, 'Peach', 1),
(52, 13, 'Hello kitty', 0),
(53, 14, 'Jul', 1),
(54, 14, 'Ninho', 0),
(55, 14, 'Booba', 0),
(56, 14, 'Kaaris', 0),
(57, 15, 'Jul', 1),
(58, 15, 'Il existe pas ce son !', 0),
(59, 15, 'Daft Punk', 0),
(60, 15, 'Edith Piaf', 0),
(61, 16, 'Argentin', 0),
(62, 16, 'Francais', 1),
(63, 16, 'Americain', 0),
(64, 16, 'Suisse', 0),
(65, 17, 'Tsunade', 0),
(66, 17, 'Minato', 1),
(67, 17, 'Jyraya', 0),
(68, 17, 'Pain', 0);

-- --------------------------------------------------------

--
-- Structure de la table `scores`
--

DROP TABLE IF EXISTS `scores`;
CREATE TABLE IF NOT EXISTS `scores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int DEFAULT NULL,
  `score` int NOT NULL,
  `date_participation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `utilisateur_id` (`utilisateur_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
