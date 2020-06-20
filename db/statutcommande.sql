-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  sam. 20 juin 2020 à 15:51
-- Version du serveur :  8.0.18
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
-- Base de données :  `php_ecommerce`
--

-- --------------------------------------------------------

--
-- Structure de la table `statutcommande`
--

DROP TABLE IF EXISTS `statutcommande`;
CREATE TABLE IF NOT EXISTS `statutcommande` (
  `idStatutCommande` int(11) NOT NULL AUTO_INCREMENT,
  `nomStatutCommande` varchar(255) NOT NULL,
  PRIMARY KEY (`idStatutCommande`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `statutcommande`
--

INSERT INTO `statutcommande` (`idStatutCommande`, `nomStatutCommande`) VALUES
(1, 'En cours'),
(2, 'Validé'),
(3, 'Payé');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
