-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Mer 29 Novembre 2017 à 21:48
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `project_esi`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `id_compte` int(25) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `passwd` varchar(60) NOT NULL,
  `identity` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`id_compte`, `mail`, `passwd`, `identity`) VALUES
(26, 'dior@gmail.com', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', 'eleve'),
(25, 'monsieur@gmail.com', '482f7629a2511d23ef4e958b13a5ba54bdba06f2', 'enseignant');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id_eleve` int(25) NOT NULL,
  `nom_eleve` varchar(25) NOT NULL,
  `prenom_eleve` varchar(25) NOT NULL,
  `id_compte` int(25) DEFAULT NULL,
  `id_groupe` int(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id_eleve`, `nom_eleve`, `prenom_eleve`, `id_compte`, `id_groupe`) VALUES
(8, 'Tall', 'Dior', 26, 8);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id_ensei` int(25) NOT NULL,
  `nom_ensei` varchar(25) NOT NULL,
  `prenom_ensei` varchar(25) NOT NULL,
  `id_compte` int(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `enseignant`
--

INSERT INTO `enseignant` (`id_ensei`, `nom_ensei`, `prenom_ensei`, `id_compte`) VALUES
(13, 'Fall', 'Monsieur', 25);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

CREATE TABLE `groupe` (
  `id_groupe` int(25) NOT NULL,
  `id_soutenance` int(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `groupe`
--

INSERT INTO `groupe` (`id_groupe`, `id_soutenance`) VALUES
(5, 1),
(8, 2),
(8, 3),
(7, 4);

-- --------------------------------------------------------

--
-- Structure de la table `positionnement`
--

CREATE TABLE `positionnement` (
  `id_eleve` int(11) NOT NULL,
  `id_soutenance` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `positionnement`
--

INSERT INTO `positionnement` (`id_eleve`, `id_soutenance`) VALUES
(8, 2),
(8, 3);

-- --------------------------------------------------------

--
-- Structure de la table `soutenance`
--

CREATE TABLE `soutenance` (
  `id_soutenance` int(25) NOT NULL,
  `nom_soute` varchar(25) DEFAULT NULL,
  `date_soute` datetime DEFAULT NULL,
  `status_soute` varchar(25) DEFAULT NULL,
  `numsalle_soute` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `soutenance`
--

INSERT INTO `soutenance` (`id_soutenance`, `nom_soute`, `date_soute`, `status_soute`, `numsalle_soute`) VALUES
(1, 'math', '2017-10-26 15:00:00', 'disponible', 'b233'),
(2, 'english', '2017-10-26 16:00:00', 'disponible', 'b256'),
(3, 'Programmation Web', '2017-11-30 15:00:00', 'disponible', 'B1191'),
(4, 'Big Data', '2017-12-01 10:00:00', 'disponible', 'B258');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`id_compte`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id_eleve`),
  ADD KEY `id_compte` (`id_compte`),
  ADD KEY `id_groupe` (`id_groupe`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id_ensei`),
  ADD KEY `id_compte` (`id_compte`);

--
-- Index pour la table `groupe`
--
ALTER TABLE `groupe`
  ADD KEY `id_soutenance` (`id_soutenance`);

--
-- Index pour la table `positionnement`
--
ALTER TABLE `positionnement`
  ADD PRIMARY KEY (`id_eleve`,`id_soutenance`);

--
-- Index pour la table `soutenance`
--
ALTER TABLE `soutenance`
  ADD PRIMARY KEY (`id_soutenance`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `compte`
--
ALTER TABLE `compte`
  MODIFY `id_compte` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id_eleve` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id_ensei` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `soutenance`
--
ALTER TABLE `soutenance`
  MODIFY `id_soutenance` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
