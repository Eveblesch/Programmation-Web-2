-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : osr-mysql.unistra.fr:3306
-- Généré le :  ven. 26 avr. 2019 à 23:48
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
-- Structure de la table `TOPIC_NOTE`
--

CREATE TABLE `TOPIC_NOTE` (
  `id` int(60) NOT NULL,
  `note` decimal(60,0) NOT NULL,
  `id_utilisateur` int(60) DEFAULT NULL,
  `id_topic` int(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `TOPIC_NOTE`
--

INSERT INTO `TOPIC_NOTE` (`id`, `note`, `id_utilisateur`, `id_topic`) VALUES
(15, '5', 71, 19),
(16, '5', 71, 18),
(17, '5', 71, 20),
(19, '5', 69, 18),
(21, '5', 70, 18),
(22, '5', 70, 28),
(24, '5', 71, 27),
(25, '5', 69, 19),
(26, '5', 69, 23),
(27, '5', 69, 20),
(28, '5', 69, 25),
(29, '5', 69, 28),
(30, '4', 72, 28),
(31, '5', 71, 28),
(34, '5', 69, 26),
(35, '5', 69, 29),
(36, '5', 69, 22),
(37, '5', 71, 22),
(38, '5', 71, 29),
(39, '5', 71, 23),
(40, '5', 71, 25),
(41, '5', 69, 27),
(48, '5', 82, 28);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `TOPIC_NOTE`
--
ALTER TABLE `TOPIC_NOTE`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_topic` (`id_topic`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `TOPIC_NOTE`
--
ALTER TABLE `TOPIC_NOTE`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `TOPIC_NOTE`
--
ALTER TABLE `TOPIC_NOTE`
  ADD CONSTRAINT `TOPIC_NOTE_ibfk_1` FOREIGN KEY (`id_topic`) REFERENCES `TOPIC` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `TOPIC_NOTE_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `UTILISATEUR` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
