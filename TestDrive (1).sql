-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 23 fév. 2023 à 09:54
-- Version du serveur : 10.4.8-MariaDB
-- Version de PHP : 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `testdrive`
--

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

CREATE TABLE `participant` (
  `IdParticipant` int(11) NOT NULL,
  `Mail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Mdp` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `Genre` enum('F','M') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `participant`
--

INSERT INTO `participant` (`IdParticipant`, `Mail`, `Mdp`, `Genre`) VALUES
(1, 'ahmed@gmail.com', '123456', 'M'),
(2, 'salma@yahoo.fr', '123456', 'F');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `NumQ` int(11) NOT NULL,
  `NumS` int(11) NOT NULL,
  `Contenu` varchar(150) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`NumQ`, `NumS`, `Contenu`) VALUES
(1, 1, 'Les informations partagées sur les réseaux sociaux sont fiables'),
(2, 1, 'L\'usage des réseaux sociaux pour les enfants doit etre sous le controle parentale'),
(3, 1, 'Les réseaux sociaux deviennent une nécessité pour les citoyens');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE `reponse` (
  `numq` int(11) NOT NULL,
  `nums` int(11) NOT NULL,
  `idparticipant` int(11) NOT NULL,
  `rep` varchar(2) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`numq`, `nums`, `idparticipant`, `rep`) VALUES
(1, 1, 1, 'N'),
(2, 1, 1, 'O'),
(3, 1, 1, 'O');

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

CREATE TABLE `sondage` (
  `NumS` int(11) NOT NULL,
  `Theme` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DateDebut` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sondage`
--

INSERT INTO `sondage` (`NumS`, `Theme`, `DateDebut`) VALUES
(1, 'Les réseaux sociaux', '2023-02-01'),
(2, 'Les jeux video', '2023-02-05');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `participant`
--
ALTER TABLE `participant`
  ADD PRIMARY KEY (`IdParticipant`);

--
-- Index pour la table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`NumQ`,`NumS`),
  ADD KEY `NumS` (`NumS`);

--
-- Index pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD PRIMARY KEY (`numq`,`nums`,`idparticipant`),
  ADD KEY `idparticipant` (`idparticipant`),
  ADD KEY `nums` (`nums`);

--
-- Index pour la table `sondage`
--
ALTER TABLE `sondage`
  ADD PRIMARY KEY (`NumS`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `participant`
--
ALTER TABLE `participant`
  MODIFY `IdParticipant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sondage`
--
ALTER TABLE `sondage`
  MODIFY `NumS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`NumS`) REFERENCES `sondage` (`NumS`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`numq`) REFERENCES `question` (`NumQ`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`idparticipant`) REFERENCES `participant` (`IdParticipant`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponse_ibfk_3` FOREIGN KEY (`nums`) REFERENCES `sondage` (`NumS`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
