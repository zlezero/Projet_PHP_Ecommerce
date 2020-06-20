-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  sam. 20 juin 2020 à 17:08
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
-- Base de données :  php_ecommerce
--

--
-- Déchargement des données de la table utilisateur
--

INSERT INTO utilisateur (idUtilisateur, nom, prenom, email, mdp, idRole, idCB) VALUES
(7, 'Corréa', 'Thomas', 'thomas.vathonne@gmail.com', '$2y$10$6Bacf1XRdbzsvO9KQlj4OOSFSCpeYOZM1viSenVeKFqDc6eS77bPa', 1, 1),
(8, 'Zonchello', 'Sebastien', 'sebastien.zonchello@gmail.com', '$2y$10$2Zg2gkEMl0LnLl4gFtNFFu3Pg.yg4aK9JkkO8DIXDtrQSJj.u7Wl6', 2, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
