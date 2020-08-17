-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 17 août 2020 à 08:28
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dashboard_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat_materiel`
--

DROP TABLE IF EXISTS `achat_materiel`;
CREATE TABLE IF NOT EXISTS `achat_materiel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `location` int(11) NOT NULL,
  `name_product` varchar(100) NOT NULL,
  `ref_product` varchar(20) NOT NULL,
  `categories` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `garanty_date` date DEFAULT NULL,
  `price` float NOT NULL,
  `advice` varchar(256) DEFAULT NULL,
  `picture` int(11) DEFAULT NULL,
  `manual` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `location` (`location`),
  KEY `categories` (`categories`),
  KEY `picture` (`picture`,`manual`),
  KEY `manual` (`manual`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achat_materiel`
--

INSERT INTO `achat_materiel` (`ID`, `location`, `name_product`, `ref_product`, `categories`, `purchase_date`, `garanty_date`, `price`, `advice`, `picture`, `manual`) VALUES
(2, 1, 'fefdgdf', 'ff', 3, '2019-03-04', '2020-03-05', 56, 'fsfd', 1, 1),
(3, 2, 'mixeur', '45UtZ', 3, '2019-03-04', '2020-03-05', 45, 'Ne pas mettre les doigts dedans', 1, 2),
(4, 5, 'TV', 'AZ32P', 3, '2018-03-10', '2020-03-11', 450, 'Ne pas coller ses yeux à l\'écran', 2, 1),
(5, 3, 'pof', 'AP325T', 4, '2019-07-11', '2020-07-11', 32, 'blablavla', 2, 1),
(6, 3, 'gef', '34ZDT', 3, '2019-07-11', '2020-07-11', 329, 'blablavla', 2, 1),
(7, 8, 'Autruche', 'PET547', 7, '2020-07-01', '2027-07-01', 530, 'Eviter de la lancer d\'un immeuble pour la voir voler ...', 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'Appliances'),
(4, 'Clothes'),
(5, 'Vehicles'),
(6, 'Sport'),
(7, 'Animals'),
(8, 'Home & Kitchen'),
(9, 'Outdoors'),
(10, 'Decoration');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`id`, `user`, `password`) VALUES
(1, 'steph', '$2y$10$sQfDMujXbG6uqiFoxplpEupLpCPxccgx46nNZq7LEknQxV66edwgS'),
(2, 'lea', '$2y$10$0ceYF9oGxQOnGDm2F2u6ce7R2w3AA9R1Qa/8JAjYe4EBXh6YRVSY2');

-- --------------------------------------------------------

--
-- Structure de la table `manu`
--

DROP TABLE IF EXISTS `manu`;
CREATE TABLE IF NOT EXISTS `manu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manual` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `manu`
--

INSERT INTO `manu` (`id`, `manual`) VALUES
(1, 'medias/manuel1.pdf'),
(2, 'medias/manuel2.pdf'),
(3, 'medias/manuel3.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `pic`
--

DROP TABLE IF EXISTS `pic`;
CREATE TABLE IF NOT EXISTS `pic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `picture` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `pic`
--

INSERT INTO `pic` (`id`, `picture`) VALUES
(1, 'medias/ticket1.png'),
(2, 'medias/ticket2.png'),
(3, 'medias/autruche.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `sites`
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sites`
--

INSERT INTO `sites` (`id`, `name`) VALUES
(1, 'gefz'),
(2, 'gez'),
(3, 'https://www.wix.com/'),
(4, 'https://www.cdiscount.com/'),
(5, 'https://www.amazon.fr/'),
(6, 'https://www.zalando.fr/'),
(7, 'https://www.veepee.fr/'),
(8, 'Vesoul');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat_materiel`
--
ALTER TABLE `achat_materiel`
  ADD CONSTRAINT `achat_materiel_ibfk_1` FOREIGN KEY (`categories`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `achat_materiel_ibfk_2` FOREIGN KEY (`location`) REFERENCES `sites` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `achat_materiel_ibfk_3` FOREIGN KEY (`picture`) REFERENCES `pic` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `achat_materiel_ibfk_4` FOREIGN KEY (`manual`) REFERENCES `manu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
