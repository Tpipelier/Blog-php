-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 05, 2026 at 07:42 PM
-- Server version: 8.4.7
-- PHP Version: 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_user` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `titre`, `description`, `pseudo`) VALUES
(1, 'Poke bowl : la recette originale', '1. La base\r\n\r\n    Riz : le plus courant est le riz à sushi (riz vinaigré), mais le riz jasmin ou le riz complet fonctionnent aussi.\r\n\r\n    Quinoa, boulgour ou nouilles soba pour une version sans gluten ou plus originale.\r\n\r\n    Chou kale, jeunes pousses, ou salade pour une version ultra-légère.\r\n\r\n2. Les protéines\r\n\r\n    Poisson cru : saumon, thon, daurade, truite (surgelés puis décongelés pour éviter tout risque sanitaire).\r\n\r\n    Crevettes, tofu, tempeh, œuf mollet ou poulet mariné pour les alternatives.\r\n\r\n3. Les toppings &amp; garnitures\r\n\r\n    Légumes crus : concombre, radis, carottes râpées, avocat, edamame, oignon rouge, choux rouge…\r\n\r\n    Fruits : mangue, ananas, grenade…\r\n\r\n    Graines et noix : sésame, cacahuètes concassées, noix de cajou.\r\n\r\n    Herbes fraîches : coriandre, ciboulette, menthe.\r\n\r\n4. La sauce\r\n\r\n    Sauce soja, sauce ponzu, mayo épicée (sriracha + mayonnaise), vinaigrette au sésame, ou yakitori maison.\r\n\r\nRecette classique : Poké Bowl au saumon mariné et avocat\r\nIngrédients pour 2 personnes :\r\n\r\n    200 g de riz à sushi cuit et refroidi\r\n\r\n    200 g de saumon frais (qualité sashimi, préalablement congelé)\r\n\r\n    1 avocat bien mûr\r\n\r\n    ½ concombre\r\n\r\n    ½ mangue\r\n\r\n    1 c. à soupe de sauce soja\r\n\r\n    1 c. à café d’huile de sésame\r\n\r\n    1 c. à soupe de jus de citron vert\r\n\r\n    1 c. à café de graines de sésame\r\n\r\n    Quelques feuilles de coriandre fraîche\r\n\r\nPréparation :\r\n\r\n    Coupez le saumon en petits dés. Faites-le mariner 15 à 30 minutes dans un bol avec la sauce soja, le jus de citron et l’huile de sésame.\r\n\r\n    Coupez l’avocat, le concombre et la mangue en fines lamelles ou en dés.\r\n\r\n    Dans deux bols, répartissez le riz.\r\n\r\n    Disposez harmonieusement les toppings sur le riz : saumon mariné, avocat, mangue, concombre.\r\n\r\n    Saupoudrez de graines de sésame et de coriandre fraîche.\r\n\r\n    Servez bien frais !\r\n', 'M.Jaloux'),
(2, 'Exercice impossible pour les BUT 1', '1 + 1 = ?\r\n\r\nA. 11\r\nB. 10\r\nC. 2\r\nD. Parse error: syntax error, unexpected token &quot;=&quot; ', 'M.Jaloux'),
(3, 'Top 3 des lettres', 'Numéro 3. P \r\nNuméro 2. H\r\nNuméro 1. P \r\n\r\nMention spéciale: ඞ', 'Théo'),
(4, 'Coin?', 'Coin coin coin coin\r\ncoin coin?\r\ncoin coin !', 'Canard');

-- --------------------------------------------------------

--
-- Table structure for table `article_categorie`
--

DROP TABLE IF EXISTS `article_categorie`;
CREATE TABLE IF NOT EXISTS `article_categorie` (
  `article_id` int NOT NULL,
  `categorie_id` int NOT NULL,
  PRIMARY KEY (`article_id`,`categorie_id`),
  KEY `fk_categorie` (`categorie_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_categorie`
--

INSERT INTO `article_categorie` (`article_id`, `categorie_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 3),
(4, 3),
(4, 4),
(6, 1),
(6, 2),
(6, 3),
(6, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`) VALUES
(1, 'Jeux Vidéo'),
(2, 'Cuisine'),
(3, 'IUT'),
(4, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int NOT NULL AUTO_INCREMENT,
  `description` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `article_id` int NOT NULL,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentaire_article` (`article_id`),
  KEY `fk_commentaire_user` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commentaire`
--

INSERT INTO `commentaire` (`id`, `description`, `article_id`, `pseudo`) VALUES
(2, 'coin coin coin', 4, 'Canard'),
(3, 'Hein?', 2, 'M.Jaloux'),
(4, 'test', 4, 'Canard'),
(22, 'magie', 4, 'Canard'),
(21, 'bonjour la street', 4, 'Canard'),
(20, 'testetetse', 4, 'Canard'),
(23, 'Merci pour cette recette ! ', 1, 'Théo'),
(24, 'update: j\'ai brulé ma cuisine', 1, 'Théo'),
(25, 'Coin 1. 🦆', 3, 'Canard');

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pseudo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `email`, `mdp`, `pseudo`, `admin`) VALUES
(1, 'admin@localhost.fr', 'admin69IUT;', 'admin', 1),
(2, 'jalouxSuperEmail@gmail.com', 'ILovePokemon', 'M.Jaloux', 0),
(3, 'théAudace@yahoo.fr', '123456789', 'Théo', 0),
(4, 'coin@gmail.com', 'coincoin', 'Canard', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
