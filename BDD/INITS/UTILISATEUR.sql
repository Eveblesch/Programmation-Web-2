-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : osr-mysql.unistra.fr:3306
-- Généré le :  ven. 26 avr. 2019 à 22:29
-- Version du serveur :  5.5.61-0ubuntu0.14.04.1
-- Version de PHP :  7.0.33-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `eblesch`
--

-- --------------------------------------------------------

--
-- Structure de la table `UTILISATEUR`
--

CREATE TABLE `UTILISATEUR` (
  `id` int(60) NOT NULL,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(250) NOT NULL,
  `pseudo` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `id_droit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `UTILISATEUR`
--

INSERT INTO `UTILISATEUR` (`id`, `login`, `mdp`, `pseudo`, `email`, `id_droit`) VALUES
(69, 'administrateur', '$2y$10$W8mAa7VE1PAW0NzkyFRBPOlJ7FiqCWA4qUQcptVy1AXzZtbR.9qyC', 'Admin', 'admin@hotmail.com', 3),
(70, 'moderateur', '$2y$10$WHMthkqO3yJc8zA/vHWKJeC5SAIhrp70Mf4Xki6klP1LLe3Pr82gi', 'modo', 'moderateur@hotmail.com', 2),
(71, 'utilisateur1', '$2y$10$/aq9oonw90gO6pb1smedYO/cBuuIPskQlzR3bwM88uE/CVZx6L5iG', 'uti1', 'utilisateur1@hotmail.com', 1),
(72, 'utilisateur2', '$2y$10$C3N9Rr2C.QuTv8Vr1zXY5e39U36/3NghX47nNkZ/oFtvAe6Ulk3g2', 'uti2', 'utilisateur2@hotmail.com', 1),
(82, 'utilisateur3', '$2y$10$GN16vi5nprBpfe0rJYDWee/hD.Y61bec91eXAS8b2AtN/PREjhPkW', 'uti3', 'utilisateur3@hotmail.com', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_droit` (`id_droit`) USING BTREE;

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `UTILISATEUR`
--
ALTER TABLE `UTILISATEUR`
  ADD CONSTRAINT `UTILISATEUR_ibfk_1` FOREIGN KEY (`id_droit`) REFERENCES `DROIT` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
