-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : osr-mysql.unistra.fr:3306
-- Généré le :  ven. 26 avr. 2019 à 23:49
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
-- Structure de la table `TOPIC`
--

CREATE TABLE `TOPIC` (
  `id` int(60) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `note_moy` float(10,2) DEFAULT NULL,
  `date_modif` date NOT NULL,
  `id_utilisateur` int(60) DEFAULT NULL,
  `id_categorie` int(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `TOPIC`
--

INSERT INTO `TOPIC` (`id`, `intitule`, `note_moy`, `date_modif`, `id_utilisateur`, `id_categorie`) VALUES
(18, 'Epagneul Breton', 4.25, '2019-04-12', 69, 16),
(19, 'Lion', 3.00, '2019-04-12', 69, 15),
(20, 'Lapin', 4.00, '2019-04-12', 69, 17),
(22, 'Chinchilla', 3.50, '2019-04-12', 69, 17),
(23, 'Thon', 3.50, '2019-04-12', 69, 18),
(25, 'Canari', 5.00, '2019-04-12', 69, 14),
(26, 'Tigre', 3.50, '2019-04-12', 69, 15),
(27, 'Conures', 3.50, '2019-04-12', 69, 14),
(28, 'Berger Allemand', 4.40, '2019-04-12', 69, 16),
(29, 'Caniche', 4.00, '2019-04-14', 71, 16);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `TOPIC`
--
ALTER TABLE `TOPIC`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `intitule` (`intitule`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `TOPIC`
--
ALTER TABLE `TOPIC`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `TOPIC`
--
ALTER TABLE `TOPIC`
  ADD CONSTRAINT `TOPIC_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `CATEGORIE` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `TOPIC_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `UTILISATEUR` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
