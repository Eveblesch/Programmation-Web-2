-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : osr-mysql.unistra.fr:3306
-- Généré le :  ven. 26 avr. 2019 à 23:51
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
-- Structure de la table `COMMENTAIRE_NOTE`
--

CREATE TABLE `COMMENTAIRE_NOTE` (
  `id` int(60) NOT NULL,
  `note` int(60) NOT NULL,
  `id_utilisateur` int(60) DEFAULT NULL,
  `id_commentaire` int(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `COMMENTAIRE_NOTE`
--

INSERT INTO `COMMENTAIRE_NOTE` (`id`, `note`, `id_utilisateur`, `id_commentaire`) VALUES
(19, 1, 71, 66),
(20, 1, 71, 65),
(21, 1, 71, 69),
(22, 1, 71, 70),
(23, 1, 69, 65),
(24, 1, 69, 67),
(27, 1, 69, 68),
(28, 1, 70, 81),
(29, 1, 72, 84),
(30, 1, 72, 77),
(31, 1, 72, 81),
(32, -1, 72, 75),
(33, -1, 72, 86),
(34, 1, 71, 84),
(35, -1, 71, 86),
(36, -1, 69, 86),
(37, 1, 69, 66),
(38, 1, 71, 82),
(39, 1, 69, 77),
(40, 1, 69, 70),
(41, 1, 69, 82),
(42, -1, 72, 73),
(43, 1, 72, 66),
(44, -1, 69, 73),
(45, 1, 69, 87),
(46, 1, 69, 83),
(47, -1, 69, 70),
(48, -1, 72, 102),
(50, -1, 69, 101),
(51, -1, 82, 73),
(52, 1, 82, 65),
(53, 1, 82, 105),
(54, -1, 82, 107);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `COMMENTAIRE_NOTE`
--
ALTER TABLE `COMMENTAIRE_NOTE`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_commentaire` (`id_commentaire`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `COMMENTAIRE_NOTE`
--
ALTER TABLE `COMMENTAIRE_NOTE`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `COMMENTAIRE_NOTE`
--
ALTER TABLE `COMMENTAIRE_NOTE`
  ADD CONSTRAINT `COMMENTAIRE_NOTE_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `UTILISATEUR` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
