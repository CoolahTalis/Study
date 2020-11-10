-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 10 nov. 2020 à 18:01
-- Version du serveur :  5.7.31
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stuliday`
--

-- --------------------------------------------------------

--
-- Structure de la table `adverts`
--

DROP TABLE IF EXISTS `adverts`;
CREATE TABLE IF NOT EXISTS `adverts` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `images` varchar(255) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`ad_id`),
  KEY `category_fk` (`category_id`),
  KEY `author_fk` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `adverts`
--

INSERT INTO `adverts` (`ad_id`, `ad_name`, `content`, `address`, `price`, `images`, `author_id`, `category_id`) VALUES
(28, 'TrÃ¨s joli Loft - Agen', 'Salut ! Je propose 2 places pour ce joli loft Ã  Agen d\'une capacitÃ© de 6 personnes. Nous sommes dÃ©jÃ  4 pour une durÃ©e d\'une semaine. Contactez moi par mail pour plus d\'infos ..\r\n', '15 rue des pruneaux, 47000 BOE, France', 180, '5faa50eed56f1_appt2.jpg', 1, 4),
(29, 'Nice house above river', 'Hi there !  Nice house located in \"Keur Massar\", 8 people capicity, natural area, calm et secure. We are 6 folks already for a 1 week trip, so there are 4 booking still available. Contact me by email for more info. See you around !\r\n', '34 beat street, 4654 Keurmassar, SUNUGAL', 200, '5fa987d1799ee_sunu.jpg', 2, 1),
(31, 'Appartements Bordeaux Centre ', 'SituÃ© Ã  Bordeaux, Ã  proximitÃ© du musÃ©e d\'Aquitaine, de la grosse cloche et de la cathÃ©drale Saint-AndrÃ©,  bÃ©nÃ©ficie d\'une connexion Wi-Fi gratuite. CapacitÃ© 4 personnes ...', '34 rue de stulidÃ©, 33000 Bordeaux, France', 450, '5fa98efe184bb_appt3.jpg', 2, 2),
(38, 'Belle Maison - Arcachon', 'Salut ! Je propose cette trÃ¨s belle maison de 130mÂ² situÃ© prÃ¨s de la dune du Pyla, capacitÃ© 8 personnes dans une zone naturelle, calme et sÃ©curisÃ©e. Contactez moi par mail pour plus d\'infos. Au plaisir !\r\n', '15 rue du Pyla, Arcachon, 33111 Arcachon, France', 150, 'Array', 1, 1),
(39, 'Vintage Loftin Old Wssex', 'Wonderful four Loft property situated in a great location close to Kingslanding Street. The property has vintage style. This is a 6 lads capacity available for 2 week. There is a nice restaurant nearby. The food & whiskey are tasty trust me. Contact me by email for more infos. Cheers ..', '7 Tender street, 1541Old Wessex, United Kingdom', 180, '', 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_name` varchar(255) NOT NULL,
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`) VALUES
(1, 'House'),
(2, 'Flat'),
(3, 'Chalet'),
(4, 'Loft'),
(5, 'Mobile Home'),
(6, 'Barge');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(25) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `fullname` (`fullname`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fullname`) VALUES
(1, 'coolah@msn.com', '$2y$10$soKDSLuqsU4UD2Xi9zPcpeJaNlpAUGUSZbkWtnvW0OXDRIb1wwPaC', 'coolah'),
(2, 'gassa@msn.com', '$2y$10$sik9TZcigHI8pCSe/H2PfeGeQBmau5QFFh3rDdb12dCOraIqnh6v2', 'Gassa'),
(3, 'sandor@msn.com', '$2y$10$MX6zots3laaJKK/5lV0mTeZ.c/RPHTB4vmtgFdHTq1wnhRypYk0o6', 'Clegan Sandor ');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `adverts`
--
ALTER TABLE `adverts`
  ADD CONSTRAINT `author_fk` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `category_fk` FOREIGN KEY (`category_id`) REFERENCES `categories` (`categories_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
