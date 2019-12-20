-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : osr-mysql.unistra.fr:3306
-- Généré le :  ven. 26 avr. 2019 à 23:52
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
-- Structure de la table `COMMENTAIRE`
--

CREATE TABLE `COMMENTAIRE` (
  `id` int(60) NOT NULL,
  `intitule` varchar(255) NOT NULL,
  `note_totale` int(60) DEFAULT NULL,
  `date_ecriture` date NOT NULL,
  `id_utilisateur` int(60) DEFAULT NULL,
  `id_topic` int(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `COMMENTAIRE`
--

INSERT INTO `COMMENTAIRE` (`id`, `intitule`, `note_totale`, `date_ecriture`, `id_utilisateur`, `id_topic`) VALUES
(65, 'Ce sont de vrais chasseurs !', 3, '2019-04-12', 71, 18),
(66, 'Ils aboient beaucoup...', 3, '2019-04-12', 71, 28),
(67, 'Les chinchillas sont tr&egrave;s doux\r\n', 1, '2019-04-12', 71, 22),
(68, 'Le roi des animaux', 1, '2019-04-12', 71, 19),
(69, 'J\'ai un lapin blanc qui s\'appelle Sushi', 1, '2019-04-12', 71, 20),
(70, 'Les canaris ont un tr&egrave;s joli chant', 1, '2019-04-12', 71, 25),
(73, 'Ce sont des chiens de troupeaux', -3, '2019-04-12', 69, 28),
(74, 'Whraaaaaaah', 0, '2019-04-12', 69, 19),
(77, 'J\'ai plusieurs conures &agrave; la maison, elles sont tr&egr', 2, '2019-04-14', 70, 27),
(79, 'Ce sont des animaux qui vivent la nuit', 0, '2019-04-14', 70, 22),
(81, 'Il faut bien penser &agrave; leur donner du foin, aussi non ils ont des probl&egrave;mes de dents', 2, '2019-04-14', 70, 20),
(82, 'Ce sont des petits oiseaux jaunes tr&egrave;s sympas', 2, '2019-04-14', 70, 25),
(83, 'Quel animal magnifique !', 1, '2019-04-14', 70, 26),
(84, 'J\'avais un Epagneul Breton qui a v&eacute;cu 13 ans', 2, '2019-04-14', 72, 18),
(86, 'Moi j\'aime bien manger les lapins', -3, '2019-04-14', 72, 20),
(87, 'J\'aime beaucoup les caniches, ils font chien de star !', 1, '2019-04-14', 71, 29),
(88, 'Les conures ont un dr&ocirc;le de plumage', 0, '2019-04-14', 71, 27),
(101, 'De tr&egrave;s beaux chiens', -1, '2019-04-26', 72, 28),
(102, 'J\'ai 2 bergers Allemands &agrave; la maison ', -1, '2019-04-26', 72, 28),
(105, 'J\'avais un Epagneul Breton qui s\'appelait Calouine', 1, '2019-04-26', 69, 18),
(107, 'coucou', -1, '2019-04-26', 69, 18);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `COMMENTAIRE`
--
ALTER TABLE `COMMENTAIRE`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_commentaire` (`id_topic`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `COMMENTAIRE`
--
ALTER TABLE `COMMENTAIRE`
  MODIFY `id` int(60) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `COMMENTAIRE`
--
ALTER TABLE `COMMENTAIRE`
  ADD CONSTRAINT `COMMENTAIRE_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `UTILISATEUR` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `COMMENTAIRE_ibfk_2` FOREIGN KEY (`id_topic`) REFERENCES `TOPIC` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
